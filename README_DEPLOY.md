# DEPLOY LARAVEL LEN HOSTINGER - SHOPTQ4.COM

## MUC TIEU

- Source Laravel nam trong `shop`
- Web public nam trong `public_html`
- Khong de lo `.env`, `vendor`, `app`, `config` ra ngoai web

---

## CAU TRUC DUNG CHUNG

```text
/home/u692177358/domains/shoptq4.com/
│
├── shop/                 # source Laravel that
│   ├── app/
│   ├── bootstrap/
│   ├── config/
│   ├── database/
│   ├── public/
│   ├── resources/
│   ├── routes/
│   ├── storage/
│   ├── vendor/
│   ├── .env
│   └── artisan
│
└── public_html/          # chi chua file public
    ├── index.php
    ├── .htaccess
    ├── build/
    ├── images/
    ├── plugins/
    ├── static/
    ├── uploads/
    └── cac asset khac


##

- Đẩy code lên và đặt tên vd: shop, vào public copy code sang public_html/
1. Sửa public_html/index.php

<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

if (file_exists($maintenance = __DIR__.'/../shop/storage/framework/maintenance.php')) {
    require $maintenance;
}

require __DIR__.'/../shop/vendor/autoload.php';

$app = require_once __DIR__.'/../shop/bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
)->send();

$kernel->terminate($request, $response);

// Nếu source thật không nằm trong (shop) thì sửa lại đường dẫn cho đúng.

2. Sửa shop/bootstrap/app.php

Tìm đoạn: $app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);
Thêm vào dưới đoạn trên: $app->usePublicPath(dirname($app->basePath()).'/public_html');

3. Sửa .env

APP_NAME=Laravel
APP_ENV=production
APP_DEBUG=false
APP_URL=https://shoptq4.com
ASSET_URL=https://shoptq4.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=TEN_DB_THAT
DB_USERNAME=TEN_USER_THAT

GOOGLE_ACTIVE
FACEBOOK_ACTIVE
DB_PASSWORD=MAT_KHAU_DB_THAT

4. Sửa public_html/.htaccess

<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    RewriteRule (^|/)\. - [F,L]

    <FilesMatch "^(artisan|composer\.json|composer\.lock|package\.json|package-lock\.json|vite\.config\.js|gulpfile\.js|phpunit\.xml|database\.sql|error_log)$">
        Require all denied
    </FilesMatch>

    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>

<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/html text/plain text/xml text/css application/javascript application/json
</IfModule>

<IfModule mod_expires.c>
    ExpiresActive On
    ExpiresByType image/jpg "access 1 month"
    ExpiresByType image/jpeg "access 1 month"
    ExpiresByType image/png "access 1 month"
    ExpiresByType image/webp "access 1 month"
    ExpiresByType text/css "access 1 week"
    ExpiresByType application/javascript "access 1 week"
</IfModule>

5. Nếu chưa chạy được sửa thêm bootstrap/app.php

$app->usePublicPath(dirname($app->basePath()).'/public_html');

6. Thẻ cào bên Admin bị set cứng đổi ở: resources/views/admin/settings/apis.blade.php
- Tìm <input type="text" class="form-control" id="api_url" name="api_url" value="https://khothegame.com" placeholder="https://khothegame.com" readonly>
- Đổi: <input type="text" class="form-control" id="api_url" name="api_url" value="{{ $charging_card['api_url'] ?? '' }}" placeholder="https://thegiare.com">
```
