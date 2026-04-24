<x-app-layout>
  @push('css')
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
  @endpush
  {{-- ẢNH BÌA & TOP NẠP THÁNG --}}
  <section style="margin-bottom: 40px">

    @php $bconfig = Helper::getConfig('theme_custom'); @endphp
    @if (theme_config('show_banner', true))
      <div class="grid gap-3 sm:grid-cols-1 lg:grid-cols-3">
        <div class="lg:col-span-2">
          <div class="cursor-pointer shadow-lg-lg">
            @isset($bconfig['youtube'])
              <iframe width="100%" height="350" class="rounded-lg" src="https://www.youtube.com/embed/{{ $bconfig['youtube'] }}" title="Video Intro" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            @else
              @isset($bconfig['banner'])
                <img src="{{ $bconfig['banner'] }}" class="w-full rounded-lg sm:h-auto sm:object-contain lg:h-[360px] lg:object-fill" alt="" />
              @else
                <img src="{{ asset('/images/svg/spinner.svg') }}" class="w-full rounded-lg sm:h-auto sm:object-contain lg:h-[350px] lg:object-fill" alt="">
              @endisset
            @endisset
          </div>
        </div>
        <div>
          <div class="rounded-lg">
            <div class="card shadow-lg">
              <ul class="nav nav-tabs mb-4 flex list-none flex-col flex-wrap justify-center border-b-0 rounded-t-lg pt-2 pl-0 md:flex-row " style="background-color: var(--primary-color)" id="tabs-tab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a href="#tabs-home-withIcon"
                    class="flex justify-center !text-[#fff] text-[20px] nav-link active my-2 w-full items-center px-4 pb-2 font-semibold capitalize leading-tight hover:border-transparent focus:border-transparent dark:text-slate-300"
                    id="tabs-home-withIcon-tab" data-bs-toggle="pill" data-bs-target="#tabs-home-withIcon" role="tab" aria-controls="tabs-home-withIcon" aria-selected="true">
                    <iconify-icon class="mr-1" icon="hugeicons:ranking"></iconify-icon>
                    @if (currentLang() === 'en')
                      {{ date('M') }} {{ __t('TOP Nạp Tháng') }}
                    @else
                      {{ __t('TOP Nạp Tháng') }} {{ date('m') }}
                    @endif
                  </a>
                </li>
              </ul>
              <div class="card-body flex flex-col p-6">

                <div class="card-text h-full">
                  <div class="tab-content" id="tabs-tabContent">
                    <div class="tab-pane fade show active" id="tabs-home-withIcon" role="tabpanel" aria-labelledby="tabs-home-withIcon-tab">
                      <ul class="space-y-2">
                        @if (!count($top10UserDeposit))
                          <div class="text-center mb-[40px]">
                            <h6>{{ __t('Chưa có dữ liệu') }}</h6>
                          </div>
                        @endif
                        @foreach ($top10UserDeposit as $deposit)
                          <li class="transition-all hover:scale-105">
                            <button class="btn btn-outline-primary btn-sm w-full">
                              <div class="flex justify-between font-bold">
                                <span>{{ $loop->iteration }}. {{ Helper::hideUsername($deposit->username) }}</span>
                                <span class="text-danger-600">{{ $deposit->prefix }}{{ Helper::formatCurrency($deposit->total) }}</span>
                              </div>
                            </button>
                          </li>
                        @endforeach
                        <li class="transition-all hover:scale-105">
                          <button onclick="location.href='{{ currentLang() === 'vn' ? route('account.deposits.index') : route('account.deposits.paypal') }}'" class="btn btn-primary btn-sm w-full">
                            <div class="text-center font-bold">
                              👉 {{ __t('NẠP TIỀN NGAY') }} 👈
                            </div>
                          </button>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endif
    @if ($homeNotice = Helper::getNotice('home_dashboard'))
      <div class="bg-white border border-primary p-3 mt-3 rounded-lg">
        {!! $homeNotice !!}
      </div>
    @endif
    @if (theme_config('show_thongbao', true))
      <div class="mt-4 flex items-center rounded-lg bg-white px-3 py-3 shadow-lg">
        <i class="fa-regular fa-bell text-primary me-2"></i>
        <marquee>
          <span class="text-danger-600 font-bold">[{{ strtoupper(Helper::getDomain()) }}]</span> {{ Helper::getConfig('shop_info')['dashboard_text_1'] ?? '-' }}
        </marquee>
      </div>
    @endif
    @if (theme_config('show_lsmua', true))
      <div class="mt-4 flex items-center rounded-lg bg-white px-3 py-3 shadow-lg">
        <i class="fas fa-shopping-cart text-green-600 me-2"></i>
        <marquee>
          {!! $listAccountBuy !!}
        </marquee>
      </div>
    @endif
  </section>

  @if ($pin_groups->count() > 0)
    @if (theme_config('pin_type', 'slide') === 'slide')
      <div class="slick-responsive">
        @foreach ($pin_groups as $pin)
          <div class="py-2 col-span-4 md:col-span-3 lg:col-span-2 hover:bg-white hover:text-red-500 transition duration-200 rounded-lg">
            <a href="{{ $pin->link }}" target="{{ $pin->open_type }}" class="flex items-center flex-col justify-center text-center">
              <img style="border-radius:15px;" class="inline-block h-16 lg:h-18" alt="{{ $pin->name }}" src="{{ $pin->image }}">
              <span class="mt-2 font-semibold text-sm lg:text-base whitespace-normal">{{ $pin->name }}</span>
            </a>
          </div>
        @endforeach
      </div>
    @elseif(theme_config('pin_type') === 'grid')
      <section class="section-product">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
          @foreach ($pin_groups as $pin)
            <div>
              <div class="py-2 col-span-4 md:col-span-3 lg:col-span-2 hover:bg-white hover:text-red-500 transition duration-200 rounded-lg">
                <a href="{{ $pin->link }}" target="{{ $pin->open_type }}" class="flex items-center flex-col justify-center text-center">
                  <img style="border-radius:15px;" class="inline-block h-16 lg:h-18" alt="{{ $pin->name }}" src="{{ $pin->image }}">
                  <span class="mt-2 font-semibold text-sm lg:text-base whitespace-normal">{{ $pin->name }}</span>
                </a>
              </div>
            </div>
          @endforeach
        </div>
      </section>
    @endif
  @endif

  @if (theme_config('minigame_pos') === 'top')
    <section class="section-product space-y-3" style="margin-bottom: 40px">
      <div class="text-center mb-5">
        <h1 class="text-[20px] md:text-[30px] mb-1 text-primary category-name"> <i class="fas fa-shield"></i> {{ __t('Trò Chơi - Mini Game') }} <i class="fas fa-shield"></i></h1>
        <div class="h-[3px] bg-primary w-[170px] mx-auto"></div>
      </div>

      <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
        @foreach (\App\Models\SpinQuest::whereNull('category_id')->where('status', true)->get() as $spinQuest)
          <div class="rounded-lg bg-white dark:bg-black-500 border border-primary hover:shadow-sm hover:shadow-primary-400 ">
            <div class="card-body">
              <a href="{{ route('games.spin-quest', ['id' => $spinQuest->id]) }}" class="block">
                <img src="{{ asset('/images/svg/spinner.svg') }}" data-src="{{ $spinQuest->cover }}" class="lazyload w-full h-28 md:h-44 lg:h-48 rounded-t-lg object-fit" alt="{{ $spinQuest->name }}" />
              </a>
              <div class="p-3 cursor-pointer dark:text-gray">
                <div class="text-center">
                  <h2 class="text-lg font-bold text-truncate hover:whitespace-normal mb-2 ">
                    {{ $spinQuest->name }}
                  </h2>
                </div>
                <h4 class="text-[12px] md:text-[15px] font-bold text-center lg:flex lg:justify-around mb-2">
                  <div>
                    <i class="fas fa-credit-card me-1"></i>{{ __t('Giá') }} : <span class="text-green-500">{{ Helper::formatCurrency($spinQuest->price) }}</span>
                  </div>
                  <div>
                    <i class="fas fa-play me-1"></i> {{ __t('Đã chơi') }} : <span class="text-red-500">{{ number_format($spinQuest->play_times) }}</span> lần
                  </div>
                </h4>
                <div class="flex justify-center">
                  <a href="{{ route('games.spin-quest', ['id' => $spinQuest->id]) }}" class="btn btn-sm btn-primary"> <i class="fas fa-gift"></i> Chơi Ngay <i class="fas fa-gift"></i></a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </section>
  @endif

  {{-- DANH MỤC SẢN PHẨM --}}
  @if ($accountV2Categories->count() > 0)
    <section class="section-product">
      <x-category-list :categories="$accountV2Categories" :bconfig="$bconfig" type="account_v2" />
    </section>
  @endif

  {{-- DANH MỤC SẢN PHẨM --}}
  @if ($accountCategories->count() > 0)
    <section class="section-product">
      <x-category-list :categories="$accountCategories" :bconfig="$bconfig" />
    </section>
  @endif

  {{-- DANH MỤC VẬT PHẨM --}}
  @if ($itemCategories->count() > 0)
    <section class="section-product">
      <x-category-list :categories="$itemCategories" :bconfig="$bconfig" type="item" />
    </section>
  @endif

  {{-- DANH MỤC CÀY THUÊ --}}
  @if ($boostingCategories->count() > 0)
    <section class="section-product">
      <x-category-list :categories="$boostingCategories" :bconfig="$bconfig" type="boosting" />
    </section>
  @endif

  @if (theme_config('minigame_pos') === 'bottom')
    <section class="section-product space-y-3" style="margin-bottom: 40px">
      <div class="text-center mb-5">
        <h1 class="text-[20px] md:text-[30px] mb-1 text-primary category-name"> <i class="fas fa-shield"></i> {{ __t('Trò Chơi - Mini Game') }} <i class="fas fa-shield"></i></h1>
        <div class="h-[3px] bg-primary w-[170px] mx-auto"></div>
      </div>

      <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
        @foreach (\App\Models\SpinQuest::whereNull('category_id')->where('status', true)->get() as $spinQuest)
          <div class="rounded-lg bg-white dark:bg-black-500 border border-primary hover:shadow-sm hover:shadow-primary-400 ">
            <div class="card-body">
              <a href="{{ route('games.spin-quest', ['id' => $spinQuest->id]) }}" class="block">
                <img src="{{ asset('/images/svg/spinner.svg') }}" data-src="{{ $spinQuest->cover }}" class="lazyload w-full h-28 md:h-44 lg:h-48 rounded-t-lg object-fit" alt="{{ $spinQuest->name }}" />
              </a>
              <div class="p-3 cursor-pointer dark:text-gray">
                <div class="text-center">
                  <h2 class="text-lg font-bold text-truncate hover:whitespace-normal mb-2 ">
                    {{ $spinQuest->name }}
                  </h2>
                </div>
                <h4 class="text-[12px] md:text-[15px] font-bold text-center lg:flex lg:justify-around mb-2">
                  <div>
                    <i class="fas fa-credit-card me-1"></i>{{ __t('Giá') }} : <span class="text-green-500">{{ Helper::formatCurrency($spinQuest->price) }}</span>
                  </div>
                  <div>
                    <i class="fas fa-play me-1"></i> {{ __t('Đã chơi') }} : <span class="text-red-500">{{ number_format($spinQuest->play_times) }}</span> lần
                  </div>
                </h4>
                <div class="flex justify-center">
                  <a href="{{ route('games.spin-quest', ['id' => $spinQuest->id]) }}" class="btn btn-sm btn-primary"> <i class="fas fa-gift"></i> Chơi Ngay <i class="fas fa-gift"></i></a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </section>
  @endif

  @if (Helper::getNotice('modal_dashboard'))
    @push('scripts')
      <script type="module">
        $(document).ready(() => {
          Swal.fire({
            position: "top",
            title: '<div style="font-size: 20px"><i class="fas fa-bell text-primary me-2"></i> {{ __t('Thông Báo Mới') }} <i class="fas fa-bell text-primary ml-2"></i></div>',
            html: `{!! Helper::getNotice('modal_dashboard') !!}`,
          })
        })
      </script>
    @endpush
  @endif

  @section('scripts')
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
      $('.slick-responsive').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        prevArrow: '',
        nextArrow: '',
        responsive: [{
          breakpoint: 768, // kích thước màn hình nhỏ hơn hoặc bằng 768px
          settings: {
            slidesToShow: 3
          }
        }]
      });
    </script>
  @endsection
</x-app-layout>
