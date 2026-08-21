# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project overview

Laravel 10 (PHP 8.1) e-commerce site for selling game-related products: pre-made game accounts ("tài khoản"), in-game items/top-up cards ("vật phẩm"), and boosting services ("cày thuê"), plus a spin-quest mini-game, card top-up ("thẻ cào"), an affiliate/collaborator program, and multiple deposit/withdraw payment integrations. Blade + Vue 3 (via Vite) on the frontend, no SPA/API-only frontend.

No `package.json` is currently checked into this working tree even though `vite.config.js`, `tailwind.config.cjs`, and `resources/js` assume an npm toolchain — check with the user before assuming `npm install`/`npm run dev` will work as-is.

## Common commands

Run from the `shop/` directory (this is the Laravel app root; deployment nests it inside a project folder with `public_html` as the doc root — see `README_DEPLOY.md`).

```bash
# PHP dependencies
composer install

# Run the app locally
php artisan serve

# Frontend build (Vite + Laravel Vue plugin)
npm run dev      # dev server
npm run build     # production build

# Database
php artisan migrate
php artisan db:seed

# Tests (PHPUnit, config in phpunit.xml)
php artisan test
php artisan test --filter=TestName
vendor/bin/phpunit tests/Feature/SomeTest.php

# Code style (Laravel Pint)
vendor/bin/pint

# Clear/rebuild caches (also exposed as an HTTP route, see below)
php artisan optimize:clear
```

Only the default Laravel skeleton tests exist (`tests/Unit/ExampleTest.php`, `tests/Feature/ExampleTest.php`) — there is no real automated test suite covering business logic yet.

## Architecture

### Product catalog: repeated Category → Group → Item hierarchy

The three sellable product types each follow the same three-level structure, duplicated as parallel model/controller/view trees rather than shared through a common abstraction:

- **Accounts** ("tài khoản"): `Category` → `Group` → `ListItem` (there is also a fully parallel **v2** stack: `CategoryV2` → `GroupV2` → `ListItemV2`, used by `.../accountsv2` admin routes and `/tai-khoan-v2` storefront routes — v1 and v2 are independent, not a migration path currently in progress, and both are actively routed).
- **Items** ("vật phẩm", in-game currency/items): `ItemCategory` → `ItemGroup` → `ItemData`, purchased via `ItemOrder`.
- **Boosting** ("cày thuê", pay-someone-to-play service): its own `Category`/`Group`/`Package` set under `Admin\Boosting\*` and `Api\Store\BoostingGameController`.

When changing one of these flows, check whether the same change is needed in the parallel v1/v2 or Account/Item/Boosting stack — they are not DRY by design.

### Controller layering by audience, not by resource

Controllers are split by *who* is acting, then by feature, rather than one controller per model:

- `Http/Controllers/Store/*` — public storefront pages (browsing accounts/items/boosting).
- `Http/Controllers/Account/*` — logged-in customer self-service (profile, deposits, withdraws, order history).
- `Http/Controllers/Admin/*` — full admin panel, deeply nested by feature (`Admin/Account`, `Admin/AccountV2`, `Admin/Item`, `Admin/Boosting`, `Admin/Game`, `Admin/Inventory`, `Admin/Settings`, `Admin/Staff`).
- `Http/Controllers/Staff/*` — a restricted "collaborator" (CTV) panel for fulfilling orders and withdraws; separate from `Admin`.
- `Http/Controllers/Api/*` — JSON endpoints, mirrored by audience again (`Api/Store`, `Api/Account`, `Api/Admin`, `Api/User`, `Api/Deposit`, `Api/Game`, `Api/Tools`).
- `Http/Controllers/Cron/*` — endpoints hit by external cron / payment-gateway webhooks (not console commands — see below).

Access to `Admin/*` and `Staff/*` routes is not just an auth check: `App\Http\Middleware\Admin` gates on `user->role` (`admin` full access; `accounting`/`partner` are restricted to `admin.dashboard` only), and `App\Http\Middleware\Staff` gates on `user->colla_type` (`account`, `boosting`, or `items` — a staff member is scoped to one product type). Both also short-circuit POST requests when `APP_DEMO=true` in `.env`. When adding a privileged route, register it under the matching `Route::middleware([...])->prefix(...)` group in `routes/web.php` rather than checking roles ad hoc in the controller.

### Cron/webhooks are HTTP routes, not artisan commands

There is no custom scheduling in `app/Console` — `routes/console.php` only has the stock `inspire` command. Recurring jobs (payment status polling, backups, spin-quest data generation) and payment-gateway callbacks are plain HTTP GET/POST routes under the `/cron` prefix in `routes/web.php`, meant to be triggered by an external cron job or the gateway itself. There's also a `/cron/artisan/init-setup` route that runs `cache:clear`, `config:clear`, `migrate --force`, etc. over HTTP, and `/cron/artisan/fix-update` which runs `App\Helpers\Update::runUpdate()` — treat these as sensitive, unauthenticated deploy/maintenance endpoints.

### Global helpers loaded via Composer `files` autoload

`composer.json`'s `autoload.files` loads `app/Helpers/Helper.php` and `app/Helpers/Helper2.php` on every request, so their contents are available everywhere without an import:

- `Helper::*` (in `Helper.php`) is a static-method utility class: config/notice/API-config lookups (`Helper::getConfig`, `getNotice`, `getApiConfig`), formatting (`formatPrice`, `formatCurrency`, `formatTimeAgo`, `formatStatus`), file uploads across multiple providers (`uploadPublic`, `uploadDOSpaces`, `uploadChevereto`, `uploadImgbb`, `uploadImgur`), Telegram notifications (`sendMessageTelegram`), mail, and license checking.
- `Helper2.php` (`getSettings()`, `checkLicenseKey()`, `domain()`, etc.) defines plain global functions, not a class.

Prefer using these existing helpers over re-implementing formatting/upload/notification logic in a controller.

### Payments

Multiple deposit channels coexist: card top-up (with a callback at `/cron/deposit/card-callback`), PayPal, Perfect Money, crypto, and RaksmeyPay (a dedicated service with its own `RaksmeypPayService`, `RaksmeypPayServiceProvider`, and `config/raksmeypay.php`). Withdraws similarly have a v1 and v2 flow (`WithdrawController` vs `WithdrawV2Controller`) for both customer accounts and the in-game "withdraw data" flow under `Admin/Inventory`.

### Social login

`laravel/socialite` handles Google/Facebook/GitHub login via `Auth\SocialController` and the `/login/{provider}` and `/login/{provider}/callback` routes; each provider is toggled independently via `*_ACTIVE` env flags.

### Localization

`vn` (Vietnamese, primary) and `en` translation JSON files exist in both `lang/` and `resources/lang/` — check which one Laravel is actually reading from before editing translations, since both directories exist simultaneously. Locale is switched via `/set-locale/{locale}` (`SetLocaleController`) and the `SetLocale` middleware.
