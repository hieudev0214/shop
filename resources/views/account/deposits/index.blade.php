@section('title', __t($pageTitle))

<x-app-layout>
  @php
    $defaultBank = $banks->first();
  @endphp

  <section>
    <div class="container">
      <div class="row g-3">

        {{-- Notice --}}
        <div class="col-12">
          <div class="card">
            <div class="card-body p-4">
              <div class="card-text">
                {!! Helper::getNotice('page_deposit') !!}
              </div>
            </div>
          </div>
        </div>

        {{-- Top Tabs --}}
        <div class="col-12">
          <div class="row g-3 justify-content-center mb-1">
            @if ($cardOn)
              <div class="col-12 col-md-6">
                <button
                  type="button"
                  class="deposit-tab-btn active w-100"
                  data-tab="card"
                  style="
                    border:2px solid #4f6df5;
                    background:#fff;
                    border-radius:14px;
                    padding:18px 20px;
                    text-align:left;
                    box-shadow:0 2px 10px rgba(0,0,0,.04);
                  "
                >
                  <div class="d-flex align-items-center">
                    <div
                      style="
                        width:46px;
                        height:46px;
                        border-radius:12px;
                        background:linear-gradient(135deg,#4f6df5,#5f7cff);
                        color:#fff;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        margin-right:14px;
                        flex-shrink:0;
                      "
                    >
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="6" width="18" height="12" rx="2"></rect>
                        <path d="M7 10h10"></path>
                        <path d="M7 14h4"></path>
                      </svg>
                    </div>
                    <div>
                      <div style="font-weight:700;font-size:18px;color:#111827;">{{ __t('Thẻ cào') }}</div>
                      <div style="font-size:13px;color:#6b7280;">{{ __t('Nạp nhanh bằng thẻ cào') }}</div>
                    </div>
                  </div>
                </button>
              </div>
            @endif

            <div class="col-12 col-md-6">
              <button
                type="button"
                class="deposit-tab-btn w-100 {{ !$cardOn ? 'active' : '' }}"
                data-tab="bank"
                style="
                  border:2px solid {{ !$cardOn ? '#19b37d' : '#e5e7eb' }};
                  background:#fff;
                  border-radius:14px;
                  padding:18px 20px;
                  text-align:left;
                  box-shadow:0 2px 10px rgba(0,0,0,.04);
                "
              >
                <div class="d-flex align-items-center">
                  <div
                    style="
                      width:46px;
                      height:46px;
                      border-radius:12px;
                      background:#19b37d;
                      color:#fff;
                      display:flex;
                      align-items:center;
                      justify-content:center;
                      margin-right:14px;
                      flex-shrink:0;
                    "
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <path d="M3 10l9-5 9 5"></path>
                      <path d="M5 10v8h14v-8"></path>
                      <path d="M9 14v4"></path>
                      <path d="M15 14v4"></path>
                    </svg>
                  </div>
                  <div>
                    <div style="font-weight:700;font-size:18px;color:#111827;">{{ __t('Ngân hàng') }}</div>
                    <div style="font-size:13px;color:#6b7280;">{{ __t('Chuyển khoản ngân hàng') }}</div>
                  </div>
                </div>
              </button>
            </div>
          </div>
        </div>

        {{-- CARD TAB --}}
        @if ($cardOn)
          <div class="col-12 tab-pane-deposit" id="deposit-tab-card">
            <div class="card border-0" style="border-radius:18px;box-shadow:0 4px 18px rgba(0,0,0,.05);">
              <div class="card-body p-4 p-md-5">

                <div class="text-center mb-4">
                  <div
                    style="
                      width:72px;
                      height:72px;
                      border-radius:50%;
                      background:linear-gradient(135deg,#4f6df5,#5f7cff);
                      color:#fff;
                      display:inline-flex;
                      align-items:center;
                      justify-content:center;
                      margin-bottom:14px;
                    "
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <rect x="3" y="6" width="18" height="12" rx="2"></rect>
                      <path d="M7 10h10"></path>
                      <path d="M7 14h4"></path>
                    </svg>
                  </div>

                  <h3 style="font-size:32px;font-weight:800;color:#111827;margin-bottom:6px;">
                    {{ __t('Nạp tiền bằng thẻ cào') }}
                  </h3>
                  <div style="font-size:16px;color:#6b7280;">
                    {{ __t('Nạp tiền nhanh chóng và an toàn') }}
                  </div>
                </div>

                <form id="form-sendcard" class="mx-auto" style="max-width:900px;">
                  <div class="row g-3">
                    <div class="col-12 col-md-6">
                      <div class="input-area">
                        <label for="telco" class="form-label">{{ __t('Loại thẻ') }}</label>
                        <select class="form-control" id="telco" name="telco" required>
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
                    </div>

                    <div class="col-12 col-md-6">
                      <div class="input-area">
                        <label for="amount" class="form-label">{{ __t('Mệnh giá') }}</label>
                        <select class="form-control" id="amount" name="amount" required>
                          <option value="">{{ __t('Chọn mệnh giá') }}</option>
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
                    </div>

                    <div class="col-12 col-md-6">
                      <div class="input-area">
                        <label for="serial" class="form-label">{{ __t('Số Serial') }}</label>
                        <input
                          type="text"
                          class="form-control"
                          id="serial"
                          name="serial"
                          placeholder="{{ __t('Nhập số serial') }}"
                          required
                        >
                      </div>
                    </div>

                    <div class="col-12 col-md-6">
                      <div class="input-area">
                        <label for="code" class="form-label">{{ __t('Mã thẻ') }}</label>
                        <input
                          type="text"
                          class="form-control"
                          name="code"
                          id="code"
                          placeholder="{{ __t('Nhập mã thẻ') }}"
                          required
                        >
                      </div>
                    </div>

                    <div class="col-12">
                      <div
                        style="
                          border:1px solid #f6c453;
                          background:#fff8e8;
                          border-radius:12px;
                          padding:16px 18px;
                          color:#b96b00;
                        "
                      >
                        <div style="font-weight:700;font-size:18px;margin-bottom:4px;">
                          {{ __t('Lưu ý quan trọng') }}
                        </div>
                        <div style="font-size:15px;">
                          {{ __t('Nếu Chọn Sai Mệnh Giá Sẽ Bị Mất Thẻ!') }}
                        </div>
                      </div>
                    </div>

                    <div class="col-12 text-center">
                      <button
                        class="btn text-white"
                        type="submit"
                        style="
                          min-width:280px;
                          max-width:460px;
                          width:100%;
                          border-radius:10px;
                          border:0;
                          background:linear-gradient(90deg,#2d5be3,#5b3df5);
                          padding:12px 20px;
                          font-weight:700;
                        "
                      >
                        {{ __t('Gửi Để Nhận') }} <span class="real_amount">0đ</span>
                      </button>
                    </div>
                  </div>
                </form>

              </div>
            </div>
          </div>
        @endif

        {{-- BANK TAB --}}
        <div class="col-12 tab-pane-deposit" id="deposit-tab-bank" style="{{ $cardOn ? 'display:none;' : '' }}">
          <div class="text-center mb-4">
            <h3 style="font-size:34px;font-weight:800;color:#111827;margin-bottom:0;">
              {{ __t('Chuyển khoản ngân hàng') }}
            </h3>
          </div>

          @if ($defaultBank)
            <div class="row justify-content-center">
              <div class="col-12 col-lg-7 col-xl-5">

                {{-- Amount box --}}
                <div class="card border-0 mb-4" style="border-radius:14px;box-shadow:0 4px 16px rgba(0,0,0,.06);">
                  <div class="card-body p-3 p-md-4">
                    <div class="input-area mb-0">
                      <label for="bank_amount" class="form-label">{{ __t('Số tiền cần nạp (VND)') }}</label>
                      <div style="position:relative;">
                        <input
                          type="number"
                          class="form-control"
                          id="bank_amount"
                          name="bank_amount"
                          value="0"
                          min="0"
                          placeholder="0"
                          style="padding-right:42px;"
                        >
                        <span
                          style="
                            position:absolute;
                            right:14px;
                            top:50%;
                            transform:translateY(-50%);
                            color:#6b7280;
                            font-weight:700;
                          "
                        >đ</span>
                      </div>
                      <div style="font-size:13px;color:#6b7280;margin-top:8px;">
                        {{ __t('Nhập số tiền cần nạp để tạo mã QR tương ứng') }}
                      </div>
                    </div>
                  </div>
                </div>

                {{-- Bank card --}}
                <div class="card border-0 overflow-hidden" style="border-radius:18px;box-shadow:0 6px 18px rgba(0,0,0,.06);">
                  <div style="background:#1137f3;padding:18px 20px;">
                    <div class="d-flex align-items-center justify-content-center">
                      <div
                        style="
                          width:48px;
                          height:48px;
                          border-radius:10px;
                          background:rgba(255,255,255,.15);
                          display:flex;
                          align-items:center;
                          justify-content:center;
                          margin-right:12px;
                          overflow:hidden;
                        "
                      >
                        <img
                          id="bank-display-image"
                          src="{{ asset($defaultBank->image) }}"
                          alt="{{ $defaultBank->name }}"
                          style="max-width:30px;max-height:30px;object-fit:contain;"
                        >
                      </div>
                      <div id="bank-display-name" style="font-size:22px;font-weight:800;color:#fff;">
                        {{ ucfirst($defaultBank->name) }}
                      </div>
                    </div>
                  </div>

                  <div class="card-body p-3 p-md-4">
                    <div class="text-center mb-3">
                      @if (str_contains(strtolower($defaultBank->name), 'momo'))
                        <img
                          id="bank-display-qr"
                          data-bank-type="momo"
                          data-bank-name="{{ $defaultBank->name }}"
                          data-bank-number="{{ $defaultBank->number }}"
                          data-bank-owner="{{ $defaultBank->owner }}"
                          src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=2|99|{{ $defaultBank->number }}|||0|0|0|{{ $deposit_prefix }}|transfer_myqr"
                          class="img-fluid rounded"
                          style="width:230px;max-width:100%;object-fit:fill;"
                          alt="{{ $defaultBank->name }}"
                        >
                      @else
                        <img
                          id="bank-display-qr"
                          data-bank-type="bank"
                          data-bank-name="{{ $defaultBank->name }}"
                          data-bank-number="{{ $defaultBank->number }}"
                          data-bank-owner="{{ $defaultBank->owner }}"
                          src="https://api.vietqr.io/{{ strtolower($defaultBank->name) }}/{{ $defaultBank->number }}/0/{{ $deposit_prefix }}/qronly2.jpg?accountName={{ $defaultBank->owner }}&bankName={{ $defaultBank->name }}"
                          class="img-fluid rounded"
                          style="width:230px;max-width:100%;object-fit:fill;"
                          alt="{{ $defaultBank->name }}"
                        >
                      @endif

                      <div style="margin-top:10px;color:#1f2937;font-weight:600;">
                        {{ __t('Quét mã QR để thanh toán nhanh') }}
                      </div>
                    </div>

                    <div
                      style="
                        background:#f3f6fb;
                        border:1px solid #e5edf7;
                        border-radius:12px;
                        padding:14px 16px;
                        margin-bottom:12px;
                      "
                    >
                      <div style="font-size:12px;font-weight:700;color:#5b6b86;text-transform:uppercase;margin-bottom:5px;">
                        {{ __t('Số tài khoản') }}
                      </div>
                      <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                        <div id="bank-display-number" style="font-size:28px;font-weight:800;color:#2453ff;line-height:1.2;">
                          {{ $defaultBank->number }}
                        </div>
                        <button
                          type="button"
                          class="copy btn btn-light btn-sm"
                          id="copy-bank-number"
                          data-clipboard-text="{{ $defaultBank->number }}"
                        >
                          {{ __t('Copy') }}
                        </button>
                      </div>
                    </div>

                    <div
                      style="
                        background:#f8fafc;
                        border:1px solid #e9eef5;
                        border-radius:12px;
                        padding:14px 16px;
                        margin-bottom:12px;
                      "
                    >
                      <div style="font-size:12px;font-weight:700;color:#6b7280;text-transform:uppercase;margin-bottom:5px;">
                        {{ __t('Chủ tài khoản') }}
                      </div>
                      <div id="bank-display-owner" style="font-size:22px;font-weight:700;color:#111827;">
                        {{ $defaultBank->owner }}
                      </div>
                    </div>

                    <div
                      style="
                        background:#eefcf4;
                        border:1px solid #c8f0d8;
                        border-radius:12px;
                        padding:14px 16px;
                      "
                    >
                      <div style="font-size:12px;font-weight:700;color:#16a34a;text-transform:uppercase;margin-bottom:5px;">
                        {{ __t('Nội dung chuyển') }}
                      </div>
                      <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                        <div id="bank-display-prefix" style="font-size:28px;font-weight:800;color:#15803d;line-height:1.2;">
                          {{ $deposit_prefix }}
                        </div>
                        <button
                          type="button"
                          class="copy btn btn-light btn-sm"
                          id="copy-bank-prefix"
                          data-clipboard-text="{{ $deposit_prefix }}"
                        >
                          {{ __t('Copy') }}
                        </button>
                      </div>
                    </div>
                  </div>

                  <div
                    style="
                      background:linear-gradient(90deg,#2d5be3,#5b3df5);
                      color:#fff;
                      padding:12px 16px;
                      text-align:center;
                      font-weight:700;
                      font-size:14px;
                    "
                  >
                    {{ __t('Kiểm tra kỹ nội dung nạp tiền') }}
                  </div>
                </div>

              </div>
            </div>
          @endif
        </div>

      </div>
    </div>
  </section>

  @push('scripts')
    <script type="module">
      const CARD_FEES = @json($fees);
      const DEPOSIT_PREFIX = @json($deposit_prefix);

      $(document).ready(function () {
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

        const buildQrUrl = (bankType, bankName, bankNumber, bankOwner, amount) => {
          const realAmount = Number(amount || 0);

          if (bankType === "momo") {
            return `https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=2|99|${bankNumber}|||${realAmount}|0|0|${DEPOSIT_PREFIX}|transfer_myqr`;
          }

          return `https://api.vietqr.io/${String(bankName).toLowerCase()}/${bankNumber}/${realAmount}/${DEPOSIT_PREFIX}/qronly2.jpg?accountName=${encodeURIComponent(bankOwner)}&bankName=${encodeURIComponent(bankName)}`;
        };

        $(".deposit-tab-btn").on("click", function () {
          const tab = $(this).data("tab");

          $(".deposit-tab-btn").css({
            borderColor: "#e5e7eb"
          });

          $(this).css({
            borderColor: tab === "bank" ? "#19b37d" : "#4f6df5"
          });

          $(".tab-pane-deposit").hide();

          if (tab === "card") {
            $("#deposit-tab-card").show();
          }

          if (tab === "bank") {
            $("#deposit-tab-bank").show();
          }
        });

        $("#form-sendcard #amount").on("change", function () {
          sumAmount();
        });

        $("#form-sendcard #telco").on("change", function () {
          sumAmount();
        });

        $("#bank_amount").on("input change keyup", function () {
          const amount = $(this).val();
          const qr = $("#bank-display-qr");

          const bankType = qr.data("bank-type");
          const bankName = qr.data("bank-name");
          const bankNumber = qr.data("bank-number");
          const bankOwner = qr.data("bank-owner");

          const qrUrl = buildQrUrl(bankType, bankName, bankNumber, bankOwner, amount);
          qr.attr("src", qrUrl);
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
  @endpush
</x-app-layout>