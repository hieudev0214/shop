@section('title', $pageTitle)

@section('css')
  <style>
    @media (max-width: 768px) {
      .v-luckywheel .wheel-wrapper {
        width: 300px;
        height: 300px;
      }

      .v-luckywheel .spin-center-btn {
        width: 95px !important;
        height: 95px !important;
      }
    }

    @media (min-width: 769px) {
      .v-luckywheel .wheel-wrapper {
        width: 750px;
        height: 750px;
      }

      .v-luckywheel .spin-center-btn {
        width: 170px !important;
        height: 170px !important;
      }
    }

    .v-luckywheel .wheel-wrapper {
      position: relative;
      margin: auto;
    }

    #spin {
      width: 100%;
      height: 100%;
      display: block;
      position: relative;
      z-index: 1;
      border-radius: unset;
    }

    .v-luckywheel .spin-center-btn {
      position: absolute !important;
      left: 50% !important;
      top: 50% !important;
      transform: translate(-50%, -50%) !important;
      z-index: 10 !important;
      cursor: pointer;
      object-fit: contain;
      opacity: 1 !important;
      border-radius: 0 !important;
      transition: 0.2s;
    }

    .v-luckywheel .spin-center-btn:hover {
      transform: translate(-50%, -50%) scale(1.06) !important;
    }

    .spin-disabled {
      opacity: 0.6 !important;
      pointer-events: none !important;
      cursor: not-allowed !important;
    }
  </style>
@endsection

<x-app-layout meta-seo="ocean">
  <section>
    <div class="mb-5 text-center">
      <h1 class="mb-1 text-[20px] md:text-[30px] category-name text-primary">
        <i class="fa-solid fa-dharmachakra text-primary"></i>
        {{ $pageTitle }}
        <i class="fa-solid fa-dharmachakra text-primary"></i>
      </h1>
      <div class="bg-primary mx-auto h-[3px] w-[170px]"></div>
    </div>

    <div class="mt-4 flex items-center rounded-lg bg-white dark:bg-[#201E43] dark:text-white px-3 py-3 shadow-lg mb-3">
      {!! $spinQuest->descr !!}
    </div>

    <div>
      <div class="grid grid-cols-1 gap-2 sm:grid-cols-3">
        <div class="border-primary shadow-primary col-span-1 gap-4 rounded-xl border border-b p-4 text-center bg-white dark:bg-[#201E43] shadow-xl sm:col-span-2">
          <div class="v-luckywheel relative flex justify-center">
            <div class="wheel-wrapper">
              <img alt="Play" src="{{ $spinQuest->image }}" id="spin">

              @if (!empty($spinQuest->button_image))
                <img
                  src="{{ $spinQuest->button_image }}"
                  alt="Quay"
                  class="spin-center-btn start-spin"
                  id="start"
                >
              @endif
            </div>
          </div>
        </div>

        <div>
          <div class="shadow-primary border-primary col-span-1 gap-4 rounded-xl border border-b bg-white dark:bg-[#201E43] p-4 text-center shadow-xl sm:col-span-2 max-h-[790px]">
            <div class="mb-2">
              <button class="btn btn-sm btn-primary w-full mb-2 start-spin">
                <i class="fas fa-credit-card me-1"></i>
                Giá {{ Helper::formatCurrency($spinQuest->price) }} / Lượt
              </button>

              <div class="flex gap-3">
                @if (!in_array(domain(), ['shopbiloi.com']))
                  <button class="btn btn-sm btn-danger w-full" id="play_test">
                    <i class="fas fa-play me-1"></i> Chơi Thử
                  </button>
                @endif

                <a href="{{ route('account.withdraws-v2.index') }}" class="btn btn-sm btn-success w-full">
                  <i class="fas fa-gift me-1"></i> Rút Thưởng
                </a>
              </div>
            </div>

            <div class="border border-b-black-200"></div>

            <marquee direction="down" class="p-3" height="700" onmouseover="this.stop();" onmouseout="this.start();" scrolldelay="1" behavior="scroll">
              @foreach (\App\Models\SpinQuestLog::where('spin_quest_id', $spinQuest->id)->orderBy('id', 'desc')->limit(15)->get() as $log)
                <button class="btn btn-sm btn-outline-primary w-full mb-2">
                  @if (theme_config('minigame_show_value', false))
                    <span class="text-info-600">
                      {{ Helper::hideUsername($log->username, 3) }}
                    </span>
                    quay được
                    <span class="text-red-600">{{ $log->prize }} {{ $log->unit }}</span>
                    vào
                    <span class="text-blue-600">{{ Helper::getTimeAgo($log->created_at) }}</span>
                  @else
                    <span class="text-info-600">
                      {{ Helper::hideUsername($log->username, 3) }}
                    </span>
                    đã chơi game vào
                    <span class="text-green-500">{{ Helper::getTimeAgo($log->created_at) }}</span>
                  @endif
                </button>
              @endforeach
            </marquee>
          </div>
        </div>
      </div>
    </div>
  </section>

  @push('scripts')
    <script src="/plugins/rotate/rotate.js"></script>
    <script>
      $(document).ready(function() {
        var bRotate = false;

        function setSpinDisabled(disabled) {
          $('.start-spin, #play_test').prop('disabled', disabled);

          if (disabled) {
            $('.start-spin, #play_test').addClass('spin-disabled');
          } else {
            $('.start-spin, #play_test').removeClass('spin-disabled');
          }
        }

        function rotateFn(angles, txt) {
          bRotate = true;
          setSpinDisabled(true);

          $('#spin').stopRotate();

          $('#spin').rotate({
            angle: 0,
            animateTo: angles + 1800,
            duration: 4000,
            callback: function() {
              Swal.fire('Thành công !', txt, 'success').then(() => {
                location.reload();
              });

              bRotate = false;
              setSpinDisabled(false);
            }
          });
        }

        $('.start-spin').click(function() {
          if (bRotate) return;

          bRotate = true;
          setSpinDisabled(true);

          axios.post('/api/games/spin-quest/turn', {
            id: {{ $spinQuest->id }}
          }).then(({ data: r }) => {
            rotateFn(r.location, r.message);
          }).catch(e => {
            bRotate = false;
            setSpinDisabled(false);
            Swal.fire('Oops ...', $catchMessage(e), 'error');
          });
        });

        $('#play_test').click(function(e) {
          if (bRotate) return;

          bRotate = true;
          setSpinDisabled(true);
          $setLoading(e.target);

          axios.post('/api/games/spin-quest/turn-test', {
            id: {{ $spinQuest->id }},
            test: true
          }).then(({ data: r }) => {
            rotateFn(r.location, r.message);
          }).catch(e => {
            bRotate = false;
            setSpinDisabled(false);
            Swal.fire('Oops ...', $catchMessage(e), 'error');
          }).finally(() => {
            $removeLoading(e.target);
          });
        });
      });
    </script>
  @endpush
</x-app-layout>