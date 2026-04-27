<x-app-layout>
  @push('css')
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />

    <style>
      .home-deposit-tab {
        background: #e5e5e5;
        color: #111;
        border-radius: 6px;
        padding: 10px;
        font-weight: 700;
        width: 100%;
      }

      .home-deposit-tab.active {
        background: #210000;
        color: #fff;
      }
    </style>
  @endpush

  <section style="margin-bottom: 40px">
    @php
  $bconfig = Helper::getConfig('theme_custom');
  $fees = $fees ?? [];
  $cardOn = $cardOn ?? true;
@endphp

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

        {{-- NẠP THẺ + TOP NẠP --}}
        <div>
          <div class="rounded-lg bg-white p-4 shadow-lg">
            <div class="mb-4 grid grid-cols-2 gap-2">
              @if ($cardOn)
                <button type="button" class="home-deposit-tab active" data-tab="card">
                  Nạp thẻ
                </button>
              @endif

              <button type="button" class="home-deposit-tab {{ !$cardOn ? 'active' : '' }}" data-tab="top">
                Top nạp tiền
              </button>
            </div>

            {{-- TAB NẠP THẺ --}}
            @if ($cardOn)
              <div id="home-tab-card">
                <form id="form-sendcard">
                  <div class="mb-3">
                 <select class="form-control w-full rounded border px-3 py-2" id="telco" name="telco" required>
  <option value="">{{ __t('Chọn loại thẻ') }}</option>
  <option value="VIETTEL">Viettel - {{ __t('Phí') }} {{ $fees['VIETTEL'] ?? 20 }}%</option>
  <option value="VINAPHONE">Vinaphone - {{ __t('Phí') }} {{ $fees['VINAPHONE'] ?? 20 }}%</option>
  <option value="MOBIFONE">Mobifone - {{ __t('Phí') }} {{ $fees['MOBIFONE'] ?? 20 }}%</option>
  <option value="ZING">Zing Card - {{ __t('Phí') }} {{ $fees['ZING'] ?? 20 }}%</option>

  @if (isset($fees['GARENA2']) && $fees['GARENA2'] != -1)
    <option value="GARENA2">Garena - {{ __t('Phí') }} {{ $fees['GARENA2'] ?? 20 }}%</option>
  @endif

  @if (isset($fees['GARENA']) && $fees['GARENA'] != -1)
    <option value="GARENA">Garena - {{ __t('Phí') }} {{ $fees['GARENA'] ?? 20 }}%</option>
  @endif

  <option value="VNMOBI">Vietnamobile - {{ __t('Phí') }} {{ $fees['VNMOBI'] ?? 20 }}%</option>
</select>
                  </div>

                  <div class="mb-3">
                    <select class="form-control w-full rounded border px-3 py-2" id="amount" name="amount" required>
                      <option value="">-- Mệnh giá --</option>
                      <option value="10000">10.000 đ</option>
                      <option value="20000">20.000 đ</option>
                      <option value="30000">30.000 đ</option>
                      <option value="50000">50.000 đ</option>
                      <option value="100000">100.000 đ</option>
                      <option value="200000">200.000 đ</option>
                      <option value="300000">300.000 đ</option>
                      <option value="500000">500.000 đ</option>
                      <option value="1000000">1.000.000 đ</option>
                    </select>
                  </div>

                  <div class="mb-3">
                    <input type="text" class="form-control w-full rounded border px-3 py-2" id="code" name="code" placeholder="Mã nạp" required>
                  </div>

                  <div class="mb-3">
                    <input type="text" class="form-control w-full rounded border px-3 py-2" id="serial" name="serial" placeholder="Serial" required>
                  </div>

                  <div class="mb-3 rounded border border-yellow-300 bg-yellow-50 px-3 py-2 text-sm font-semibold text-yellow-700">
                    Nếu chọn sai mệnh giá sẽ bị mất thẻ!
                  </div>

                  <div class="text-center">
                    <button type="submit"  style="
                          min-width:280px;
                          max-width:460px;
                          width:100%;
                          border-radius:10px;
                          border:0;
                          background:#D31A1A;
                          padding:12px 20px;
                          font-weight:700;
                        "
                        class="text-white"
                        >
                      <i class="fas fa-upload"></i>
                      Gửi Thẻ Cào
                    </button>
                  </div>
                </form>
              </div>
            @endif

            {{-- TAB TOP NẠP --}}
            <div id="home-tab-top" style="{{ $cardOn ? 'display:none;' : '' }}">
              <div class="mb-4 rounded bg-primary py-3 text-center text-lg font-bold text-white">
                <iconify-icon class="mr-1" icon="hugeicons:ranking"></iconify-icon>
                @if (currentLang() === 'en')
                  {{ date('M') }} {{ __t('TOP Nạp Tháng') }}
                @else
                  {{ __t('TOP Nạp Tháng') }} {{ date('m') }}
                @endif
              </div>

              <ul class="space-y-2">
                @if (!count($top10UserDeposit))
                  <div class="mb-[40px] text-center">
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

  {{-- PHẦN DƯỚI GIỮ NGUYÊN CODE CŨ CỦA BẠN --}}
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
        <h1 class="text-[20px] md:text-[30px] mb-1 text-primary category-name">
          <i class="fas fa-shield"></i> {{ __t('Trò Chơi - Mini Game') }} <i class="fas fa-shield"></i>
        </h1>
        <div class="h-[3px] bg-primary w-[170px] mx-auto"></div>
      </div>

      <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
        @foreach (\App\Models\SpinQuest::whereNull('category_id')->where('status', true)->get() as $spinQuest)
          <div class="rounded-lg bg-white dark:bg-black-500 border border-primary hover:shadow-sm hover:shadow-primary-400">
            <div class="card-body">
              <a href="{{ route('games.spin-quest', ['id' => $spinQuest->id]) }}" class="block">
                <img src="{{ asset('/images/svg/spinner.svg') }}" data-src="{{ $spinQuest->cover }}" class="lazyload w-full h-28 md:h-44 lg:h-48 rounded-t-lg object-fit" alt="{{ $spinQuest->name }}" />
              </a>
              <div class="p-3 cursor-pointer dark:text-gray">
                <div class="text-center">
                  <h2 class="text-lg font-bold text-truncate hover:whitespace-normal mb-2">{{ $spinQuest->name }}</h2>
                </div>
                <h4 class="text-[12px] md:text-[15px] font-bold text-center lg:flex lg:justify-around mb-2">
                  <div>
                    <i class="fas fa-credit-card me-1"></i>{{ __t('Giá') }} :
                    <span class="text-green-500">{{ Helper::formatCurrency($spinQuest->price) }}</span>
                  </div>
                  <div>
                    <i class="fas fa-play me-1"></i> {{ __t('Đã chơi') }} :
                    <span class="text-red-500">{{ number_format($spinQuest->play_times) }}</span> lần
                  </div>
                </h4>
                <div class="flex justify-center">
                  <a href="{{ route('games.spin-quest', ['id' => $spinQuest->id]) }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-gift"></i> Chơi Ngay <i class="fas fa-gift"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </section>
  @endif

  @if ($accountV2Categories->count() > 0)
    <section class="section-product">
      <x-category-list :categories="$accountV2Categories" :bconfig="$bconfig" type="account_v2" />
    </section>
  @endif

  @if ($accountCategories->count() > 0)
    <section class="section-product">
      <x-category-list :categories="$accountCategories" :bconfig="$bconfig" />
    </section>
  @endif

  @if ($itemCategories->count() > 0)
    <section class="section-product">
      <x-category-list :categories="$itemCategories" :bconfig="$bconfig" type="item" />
    </section>
  @endif

  @if ($boostingCategories->count() > 0)
    <section class="section-product">
      <x-category-list :categories="$boostingCategories" :bconfig="$bconfig" type="boosting" />
    </section>
  @endif

  @if (theme_config('minigame_pos') === 'bottom')
    <section class="section-product space-y-3" style="margin-bottom: 40px">
      <div class="text-center mb-5">
        <h1 class="text-[20px] md:text-[30px] mb-1 text-primary category-name">
          <i class="fas fa-shield"></i> {{ __t('Trò Chơi - Mini Game') }} <i class="fas fa-shield"></i>
        </h1>
        <div class="h-[3px] bg-primary w-[170px] mx-auto"></div>
      </div>

      <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
        @foreach (\App\Models\SpinQuest::whereNull('category_id')->where('status', true)->get() as $spinQuest)
          <div class="rounded-lg bg-white dark:bg-black-500 border border-primary hover:shadow-sm hover:shadow-primary-400">
            <div class="card-body">
              <a href="{{ route('games.spin-quest', ['id' => $spinQuest->id]) }}" class="block">
                <img src="{{ asset('/images/svg/spinner.svg') }}" data-src="{{ $spinQuest->cover }}" class="lazyload w-full h-28 md:h-44 lg:h-48 rounded-t-lg object-fit" alt="{{ $spinQuest->name }}" />
              </a>
              <div class="p-3 cursor-pointer dark:text-gray">
                <div class="text-center">
                  <h2 class="text-lg font-bold text-truncate hover:whitespace-normal mb-2">{{ $spinQuest->name }}</h2>
                </div>
                <h4 class="text-[12px] md:text-[15px] font-bold text-center lg:flex lg:justify-around mb-2">
                  <div>
                    <i class="fas fa-credit-card me-1"></i>{{ __t('Giá') }} :
                    <span class="text-green-500">{{ Helper::formatCurrency($spinQuest->price) }}</span>
                  </div>
                  <div>
                    <i class="fas fa-play me-1"></i> {{ __t('Đã chơi') }} :
                    <span class="text-red-500">{{ number_format($spinQuest->play_times) }}</span> lần
                  </div>
                </h4>
                <div class="flex justify-center">
                  <a href="{{ route('games.spin-quest', ['id' => $spinQuest->id]) }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-gift"></i> Chơi Ngay <i class="fas fa-gift"></i>
                  </a>
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

    <script type="module">
      const CARD_FEES = @json($fees);

      $(document).ready(function () {
        $('.slick-responsive').slick({
          slidesToShow: 6,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 3000,
          prevArrow: '',
          nextArrow: '',
          responsive: [{
            breakpoint: 768,
            settings: {
              slidesToShow: 3
            }
          }]
        });

        const sumAmount = () => {
          const telco = $("#form-sendcard #telco").val();
          const amount = $("#form-sendcard #amount").val();

          if (amount && telco && CARD_FEES[telco] !== undefined) {
            const real_amount = amount - (amount * CARD_FEES[telco] / 100);
            $("#form-sendcard .real_amount").text($formatCurrency(real_amount));
          } else {
            $("#form-sendcard .real_amount").text($formatCurrency(0));
          }
        };

        $(".home-deposit-tab").on("click", function () {
          const tab = $(this).data("tab");

          $(".home-deposit-tab").removeClass("active");
          $(this).addClass("active");

          if (tab === "card") {
            $("#home-tab-card").show();
            $("#home-tab-top").hide();
          }

          if (tab === "top") {
            $("#home-tab-card").hide();
            $("#home-tab-top").show();
          }
        });

        $("#form-sendcard #amount").on("change", function () {
          sumAmount();
        });

        $("#form-sendcard #telco").on("change", function () {
          sumAmount();
        });

        $("#form-sendcard").on("submit", async function (e) {
          e.preventDefault();

          const payload = $formDataToPayload(new FormData(e.target));

          $showLoading();

          try {
            const { data: result } = await axios.post('/api/accounts/send-card', payload);

            Swal.fire('Thành công', result.message, 'success').then(() => {
              e.target.reset();
              $("#form-sendcard .real_amount").text($formatCurrency(0));
            });
          } catch (error) {
            Swal.fire('Thất bại', error.response?.data?.message || 'Có lỗi xảy ra', 'error');
          }
        });
      });
    </script>
  @endsection
</x-app-layout>