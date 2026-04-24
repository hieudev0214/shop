<nav class="main-menu" role="navigation" aria-label="Main navigation">
  <ul class="whitespace-nowrap">
    {{-- Hidden Account Purchase Item --}}
    <li class="menu-item-has-children !hidden" hidden>
      <a href="{{ route('home') }}" class="transition-all hover:scale-[105%]">
        <div class="flex flex-1 items-center space-x-[6px] rtl:space-x-reverse">
          <span class="icon-box">
            <iconify-icon icon="icon-park:dashboard-car"></iconify-icon>
          </span>
          <div class="text-box">{{ __t('Mua Tài Khoản') }}</div>
        </div>
      </a>
    </li>

    {{-- Home --}}
    <x-menu-item href="{{ route('home') }}" icon="ic:twotone-dashboard" :label="__t('Trang Chủ')" :isActive="request()->routeIs('home')" />

    {{-- Account Purchase History --}}
    <x-menu-item icon="ic:twotone-dashboard" :label="__t('Lịch Sử Mua Nick')" :hasSubmenu="true">

      <x-submenu-item href="{{ route('account.orders.accounts') }}" icon="healthicons:1" :label="__t('Tài Khoản Loại 1')" :isActive="request()->routeIs('account.orders.accounts')" />

      <x-submenu-item href="{{ route('account.orders.accounts-v2') }}" icon="healthicons:2" :label="__t('Tài Khoản Loại 2')" :isActive="request()->routeIs('account.orders.accounts-v2')" />

      @if ($menuData['features']['bulk_orders'])
        <x-submenu-item href="{{ route('account.orders.bulk-orders') }}" icon="healthicons:2" :label="__t('Đơn Hàng Nhóm')" :isActive="request()->routeIs('account.orders.bulk-orders')" />
      @endif
    </x-menu-item>

    {{-- Other Services --}}
    <x-menu-item icon="material-symbols:other-admission-outline-rounded" :label="__t('Dịch Vụ Khác')" :hasSubmenu="true">

      <x-submenu-item href="{{ route('pages.affiliates') }}" icon="carbon:share-knowledge" :label="__t('Tiếp Thị Liên Kết')" />

      <x-submenu-item href="{{ route('account.orders.boosting') }}" icon="arcticons:boost" :label="__t('Lịch Sử Cày Thuê')" />

      <x-submenu-item href="{{ route('account.withdraws.index') }}" icon="fluent-mdl2:game" :label="__t('Rút Thưởng (Kho Cũ)')" />

      <x-submenu-item href="{{ route('account.withdraws-v2.index') }}" icon="fluent-mdl2:game" :label="__t('Rút Thưởng Trò Chơi')" />

      <x-submenu-item href="{{ route('account.orders.items') }}" icon="tabler:lego" :label="__t('Lịch Sử Mua Vật Phẩm')" />
    </x-menu-item>

    {{-- Account Profile --}}
    <x-menu-item href="{{ route('account.profile.index') }}" icon="iconamoon:profile" :label="__t('Tài Khoản')" :isActive="request()->routeIs('account.profile.index')" />

    {{-- Deposit Menu --}}
    <x-menu-item icon="gg:credit-card" :label="__t('Nạp Tiền')" :hasSubmenu="true">

      @if ($menuData['depositPorts']['card'])
        <x-submenu-item href="{{ route('account.deposits.index', ['gateway' => 'card']) }}" icon="ion:card-outline" :label="__t('Thẻ Cào')" />
      @endif

      @if ($menuData['depositPorts']['invoice'])
        <x-submenu-item href="{{ route('account.deposits.invoice', ['session' => time()]) }}" icon="hugeicons:invoice" :label="__t('Hóa Đơn')" />
      @endif

      @if ($menuData['depositPorts']['banking'])
        <x-submenu-item href="{{ route('account.deposits.index', ['gateway' => 'banking']) }}" icon="clarity:bank-line" :label="__t('Ngân Hàng')" />
      @endif

     

      @if ($menuData['depositPorts']['raksmeypay'])
        <x-submenu-item href="{{ route('account.deposits.raksmeypay') }}" icon="simple-line-icons:paypal" :label="__t('Bakong Wallet')" />
      @endif

      @if ($menuData['depositPorts']['crypto'])
        <x-submenu-item href="{{ route('account.deposits.crypto') }}" icon="arcticons:cryptomator" :label="__t('Tiền Mã Hoá')" />
      @endif

      @if ($menuData['depositPorts']['perfect_money'])
        <x-submenu-item href="{{ route('account.deposits.perfect-money') }}" icon="arcticons:perfect-ear" :label="__t('Perfect Money')" />
      @endif
    </x-menu-item>

    {{-- Transactions --}}
    <x-menu-item href="{{ route('account.profile.transactions') }}" icon="grommet-icons:money" :label="__t('Dòng Tiền')" :isActive="request()->routeIs('account.profile.transactions')" />

    {{-- News --}}
    <x-menu-item href="{{ route('articles.index') }}" icon="wpf:news" :label="__t('Tin Tức')" :isActive="request()->routeIs('articles.index')" />

    {{-- Additional Menu (only if Google Auth is enabled) --}}
    @if ($menuData['authGoogle']['enabled'])
      <x-menu-item icon="mingcute:textbox-fill" :label="__t('Bổ Sung')" :hasSubmenu="true">

        <x-submenu-item href="{{ route('pages.privacy-policy') }}" icon="healthicons:1" :label="__t('Chính Sách')" />

        <x-submenu-item href="{{ route('pages.terms-of-service') }}" icon="healthicons:2" :label="__t('Điều Khoản')" />
      </x-menu-item>
    @endif
  </ul>
</nav>
<!-- end top menu -->
