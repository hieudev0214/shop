@section('title', __t($pageTitle))

<x-app-layout>
  @php
    $defaultBank = $banks->first();
  @endphp

  @push('css')
    <style>
      .deposit-page {
        max-width: 1180px;
        margin: 0 auto;
      }

      .deposit-hero {
        background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%);
        border-radius: 22px;
        padding: 26px;
        color: #fff;
        box-shadow: 0 16px 40px rgba(37, 99, 235, .22);
        margin-bottom: 18px;
      }

      .deposit-hero h2 {
        font-size: 30px;
        font-weight: 900;
        margin: 0 0 6px;
      }

      .deposit-hero p {
        margin: 0;
        opacity: .9;
        font-size: 15px;
      }

      .deposit-notice {
        background: #fff;
        border: 1px solid #eef2f7;
        border-radius: 18px;
        box-shadow: 0 8px 28px rgba(15, 23, 42, .05);
        overflow: hidden;
      }

      .deposit-tabs {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
        margin: 18px 0;
      }

      .deposit-tab-btn {
        border: 2px solid #e5e7eb;
        background: #fff;
        border-radius: 18px;
        padding: 18px;
        text-align: left;
        transition: .2s ease;
        box-shadow: 0 8px 24px rgba(15, 23, 42, .05);
        cursor: pointer;
      }

      .deposit-tab-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 34px rgba(15, 23, 42, .08);
      }

      .deposit-tab-btn.active-card {
        border-color: #4f46e5;
        background: linear-gradient(180deg, #ffffff 0%, #f5f7ff 100%);
      }

      .deposit-tab-btn.active-bank {
        border-color: #16a34a;
        background: linear-gradient(180deg, #ffffff 0%, #f2fff7 100%);
      }

      .deposit-tab-icon {
        width: 50px;
        height: 50px;
        border-radius: 15px;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 14px;
        flex-shrink: 0;
      }

      .icon-card {
        background: linear-gradient(135deg, #4f46e5, #2563eb);
      }

      .icon-bank {
        background: linear-gradient(135deg, #16a34a, #059669);
      }

      .deposit-tab-title {
        font-size: 18px;
        font-weight: 900;
        color: #111827;
        margin-bottom: 2px;
      }

      .deposit-tab-desc {
        font-size: 13px;
        color: #6b7280;
      }

      .deposit-panel {
        background: #fff;
        border: 1px solid #eef2f7;
        border-radius: 22px;
        box-shadow: 0 12px 36px rgba(15, 23, 42, .06);
        overflow: hidden;
      }

      .deposit-panel-header {
        padding: 26px 26px 16px;
        text-align: center;
      }

      .deposit-panel-header h3 {
        font-size: 28px;
        font-weight: 900;
        color: #111827;
        margin-bottom: 6px;
      }

      .deposit-panel-header p {
        color: #6b7280;
        margin: 0;
      }

      .deposit-panel-body {
        padding: 22px 26px 30px;
      }

      .deposit-input label {
        font-weight: 800;
        color: #374151;
        margin-bottom: 8px;
      }

      .deposit-input .form-control {
        height: 48px;
        border-radius: 13px;
        border: 1px solid #dbe3ef;
        padding: 10px 14px;
        font-weight: 600;
      }

      .deposit-input .form-control:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, .12);
      }

      .deposit-alert {
        border: 1px solid #fbbf24;
        background: #fffbeb;
        color: #92400e;
        border-radius: 15px;
        padding: 15px 17px;
      }

      .deposit-submit {
        width: 100%;
        max-width: 430px;
        min-height: 50px;
        border: 0;
        border-radius: 15px;
        background: linear-gradient(90deg, #2563eb, #7c3aed);
        color: #fff;
        font-weight: 900;
        box-shadow: 0 12px 26px rgba(37, 99, 235, .24);
      }

      .bank-layout {
        display: grid;
        grid-template-columns: 390px 1fr;
        gap: 22px;
        align-items: start;
      }

      .bank-qr-card {
        background: #fff;
        border: 1px solid #eef2f7;
        border-radius: 22px;
        box-shadow: 0 12px 36px rgba(15, 23, 42, .06);
        overflow: hidden;
      }

      .bank-top {
        background: linear-gradient(135deg, #0f46ff, #6d28d9);
        color: #fff;
        padding: 18px;
        text-align: center;
      }

      .bank-logo-box {
        width: 54px;
        height: 54px;
        border-radius: 16px;
        background: rgba(255, 255, 255, .16);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 8px;
      }

      .bank-logo-box img {
        max-width: 34px;
        max-height: 34px;
        object-fit: contain;
      }

      .bank-name {
        font-size: 23px;
        font-weight: 900;
      }

      .qr-wrap {
        padding: 22px;
        text-align: center;
      }

      .qr-box {
        display: inline-block;
        background: #fff;
        padding: 12px;
        border-radius: 20px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 8px 24px rgba(15, 23, 42, .08);
      }

      .qr-box img {
        width: 245px;
        max-width: 100%;
        border-radius: 14px;
      }

      .bank-info-card {
        background: #fff;
        border: 1px solid #eef2f7;
        border-radius: 22px;
        box-shadow: 0 12px 36px rgba(15, 23, 42, .06);
        padding: 22px;
      }

      .quick-amounts {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 10px;
        margin-top: 12px;
      }

      .quick-amount {
        border: 1px solid #dbe3ef;
        background: #f8fafc;
        border-radius: 12px;
        padding: 10px;
        font-weight: 800;
        color: #334155;
        cursor: pointer;
      }

      .quick-amount:hover {
        border-color: #2563eb;
        color: #2563eb;
        background: #eff6ff;
      }

      .info-row {
        border: 1px solid #e5eaf2;
        border-radius: 16px;
        padding: 15px;
        margin-top: 14px;
        background: #f8fafc;
      }

      .info-row.green {
        background: #f0fdf4;
        border-color: #bbf7d0;
      }

      .info-label {
        font-size: 12px;
        text-transform: uppercase;
        color: #64748b;
        font-weight: 900;
        margin-bottom: 6px;
      }

      .info-value {
        font-size: 24px;
        font-weight: 900;
        color: #111827;
        word-break: break-word;
        line-height: 1.2;
      }

      .info-value.blue {
        color: #2563eb;
      }

      .info-value.green {
        color: #16a34a;
      }

      .copy {
        border-radius: 10px !important;
        font-weight: 800 !important;
      }

      .bank-warning {
        margin-top: 16px;
        border-radius: 15px;
        padding: 14px;
        background: linear-gradient(90deg, #2563eb, #7c3aed);
        color: #fff;
        text-align: center;
        font-weight: 800;
      }

      @media (max-width: 991px) {
        .bank-layout {
          grid-template-columns: 1fr;
        }
      }

      @media (max-width: 768px) {
        .deposit-hero {
          padding: 22px;
          border-radius: 18px;
        }

        .deposit-hero h2 {
          font-size: 24px;
        }

        .deposit-tabs {
          grid-template-columns: 1fr;
        }

        .deposit-panel-header h3 {
          font-size: 23px;
        }

        .deposit-panel-body,
        .deposit-panel-header {
          padding-left: 18px;
          padding-right: 18px;
        }

        .quick-amounts {
          grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .info-value {
          font-size: 21px;
        }
      }
    </style>
  @endpush

  <section class="deposit-page">
    <div class="deposit-hero">
      <h2>{{ __t('Nạp Tiền Tài Khoản') }}</h2>
      <p>{{ __t('Chọn hình thức nạp tiền phù hợp và kiểm tra kỹ thông tin trước khi thanh toán.') }}</p>
    </div>

    <div class="row g-3">
      <div class="col-12">
        <div class="deposit-notice">
          <div class="card-body p-4">
            {!! Helper::getNotice('page_deposit') !!}
          </div>
        </div>
      </div>

      <div class="col-12">
        <div class="deposit-tabs">
          @if ($cardOn)
            <button type="button" class="deposit-tab-btn active-card" data-tab="card">
              <div class="d-flex align-items-center">
                <div class="deposit-tab-icon icon-card">
                  <i class="fa-solid fa-credit-card"></i>
                </div>
                <div>
                  <div class="deposit-tab-title">{{ __t('Thẻ cào') }}</div>
                  <div class="deposit-tab-desc">{{ __t('Nạp nhanh bằng mã thẻ') }}</div>
                </div>
              </div>
            </button>
          @endif

          <button type="button" class="deposit-tab-btn {{ !$cardOn ? 'active-bank' : '' }}" data-tab="bank">
            <div class="d-flex align-items-center">
              <div class="deposit-tab-icon icon-bank">
                <i class="fa-solid fa-building-columns"></i>
              </div>
              <div>
                <div class="deposit-tab-title">{{ __t('Ngân hàng') }}</div>
                <div class="deposit-tab-desc">{{ __t('Chuyển khoản / quét QR') }}</div>
              </div>
            </div>
          </button>
        </div>
      </div>

      @if ($cardOn)
        <div class="col-12 tab-pane-deposit" id="deposit-tab-card">
          <div class="deposit-panel">
            <div class="deposit-panel-header">
              <h3>{{ __t('Nạp tiền bằng thẻ cào') }}</h3>
              <p>{{ __t('Điền chính xác loại thẻ, mệnh giá, serial và mã thẻ.') }}</p>
            </div>

            <div class="deposit-panel-body">
              <form id="form-sendcard" class="mx-auto" style="max-width: 900px;">
                <div class="row g-3">
                  <div class="col-12 col-md-6">
                    <div class="deposit-input">
                      <label for="telco" class="form-label">{{ __t('Loại thẻ') }}</label>
                      <select class="form-control" id="telco" name="telco" required>
                            <option value="">{{ __t('Chọn loại thẻ') }}</option>

                            <option value="VIETTEL">Viettel - {{ __t('Phí') }} {{ $fees['VIETTEL'] ?? 20 }}%</option>
                            <option value="VINAPHONE">Vinaphone - {{ __t('Phí') }} {{ $fees['VINAPHONE'] ?? 20 }}%</option>
                            <option value="MOBIFONE">Mobifone - {{ __t('Phí') }} {{ $fees['MOBIFONE'] ?? 20 }}%</option>
                            <option value="ZING">Zing Card - {{ __t('Phí') }} {{ $fees['ZING'] ?? 20 }}%</option>

                            {{-- Garena chỉ hiện 1 --}}
                            @php
                              $garenaFee = $fees['GARENA'] ?? $fees['GARENA2'] ?? null;
                            @endphp

                            @if ($garenaFee !== null && $garenaFee != -1)
                              <option value="GARENA">Garena - {{ __t('Phí') }} {{ $garenaFee }}%</option>
                            @endif

                            <option value="VNMOBI">Vietnamobile - {{ __t('Phí') }} {{ $fees['VNMOBI'] ?? 20 }}%</option>
                       </select>
                    </div>
                  </div>

                  <div class="col-12 col-md-6">
                    <div class="deposit-input">
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
                    <div class="deposit-input">
                      <label for="serial" class="form-label">{{ __t('Số Serial') }}</label>
                      <input type="text" class="form-control" id="serial" name="serial" placeholder="{{ __t('Nhập số serial') }}" required>
                    </div>
                  </div>

                  <div class="col-12 col-md-6">
                    <div class="deposit-input">
                      <label for="code" class="form-label">{{ __t('Mã thẻ') }}</label>
                      <input type="text" class="form-control" id="code" name="code" placeholder="{{ __t('Nhập mã thẻ') }}" required>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="deposit-alert">
                      <div style="font-weight: 900; font-size: 17px;">
                        <i class="fa-solid fa-triangle-exclamation me-1"></i>
                        {{ __t('Lưu ý quan trọng') }}
                      </div>
                      <div style="font-size: 15px; margin-top: 3px;">
                        {{ __t('Nếu chọn sai mệnh giá sẽ bị mất thẻ, vui lòng kiểm tra kỹ trước khi gửi.') }}
                      </div>
                    </div>
                  </div>

                  <div class="col-12 text-center mt-2">
                    <button class="deposit-submit" type="submit">
                      {{ __t('Gửi thẻ nhận') }} <span class="real_amount">0đ</span>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      @endif

      <div class="col-12 tab-pane-deposit" id="deposit-tab-bank" style="{{ $cardOn ? 'display:none;' : '' }}">
        @if ($defaultBank)
          <div class="bank-layout">
            <div class="bank-qr-card">
              <div class="bank-top">
                <div class="bank-logo-box">
                  <img id="bank-display-image" src="{{ asset($defaultBank->image) }}" alt="{{ $defaultBank->name }}">
                </div>
                <div id="bank-display-name" class="bank-name">
                  {{ ucfirst($defaultBank->name) }}
                </div>
                <div style="font-size: 13px; opacity: .9;">
                  {{ __t('Quét mã QR để thanh toán') }}
                </div>
              </div>

              <div class="qr-wrap">
                <div class="qr-box">
                  @if (str_contains(strtolower($defaultBank->name), 'momo'))
                    <img
                      id="bank-display-qr"
                      data-bank-type="momo"
                      data-bank-name="{{ $defaultBank->name }}"
                      data-bank-number="{{ $defaultBank->number }}"
                      data-bank-owner="{{ $defaultBank->owner }}"
                      src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=2|99|{{ $defaultBank->number }}|||0|0|0|{{ $deposit_prefix }}|transfer_myqr"
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
                      alt="{{ $defaultBank->name }}"
                    >
                  @endif
                </div>

                <div style="font-weight: 800; color: #334155; margin-top: 13px;">
                  {{ __t('QR tự cập nhật theo số tiền bạn nhập') }}
                </div>
              </div>
            </div>

            <div class="bank-info-card">
              <div class="deposit-panel-header p-0 text-start">
                <h3 style="font-size: 26px;">{{ __t('Chuyển khoản ngân hàng') }}</h3>
                <p>{{ __t('Nhập số tiền, sau đó chuyển khoản đúng nội dung bên dưới.') }}</p>
              </div>

              <div class="deposit-input mt-3">
                <label for="bank_amount" class="form-label">{{ __t('Số tiền cần nạp') }}</label>
                <div style="position: relative;">
                  <input
                    type="number"
                    class="form-control"
                    id="bank_amount"
                    name="bank_amount"
                    value="0"
                    min="0"
                    placeholder="0"
                    style="padding-right: 45px;"
                  >
                  <span style="position:absolute; right:15px; top:50%; transform:translateY(-50%); font-weight:900; color:#64748b;">đ</span>
                </div>

                <div class="quick-amounts">
                  <button type="button" class="quick-amount" data-amount="10000">10K</button>
                  <button type="button" class="quick-amount" data-amount="50000">50K</button>
                  <button type="button" class="quick-amount" data-amount="100000">100K</button>
                  <button type="button" class="quick-amount" data-amount="200000">200K</button>
                  <button type="button" class="quick-amount" data-amount="500000">500K</button>
                  <button type="button" class="quick-amount" data-amount="1000000">1M</button>
                  <button type="button" class="quick-amount" data-amount="2000000">2M</button>
                  <button type="button" class="quick-amount" data-amount="5000000">5M</button>
                </div>
              </div>

              <div class="info-row">
                <div class="info-label">{{ __t('Số tài khoản') }}</div>
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                  <div id="bank-display-number" class="info-value blue">{{ $defaultBank->number }}</div>
                  <button type="button" class="copy btn btn-light btn-sm" id="copy-bank-number" data-clipboard-text="{{ $defaultBank->number }}">
                    <i class="fa-regular fa-copy me-1"></i>{{ __t('Copy') }}
                  </button>
                </div>
              </div>

              <div class="info-row">
                <div class="info-label">{{ __t('Chủ tài khoản') }}</div>
                <div id="bank-display-owner" class="info-value">{{ $defaultBank->owner }}</div>
              </div>

              <div class="info-row green">
                <div class="info-label" style="color:#16a34a;">{{ __t('Nội dung chuyển khoản') }}</div>
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                  <div id="bank-display-prefix" class="info-value green">{{ $deposit_prefix }}</div>
                  <button type="button" class="copy btn btn-light btn-sm" id="copy-bank-prefix" data-clipboard-text="{{ $deposit_prefix }}">
                    <i class="fa-regular fa-copy me-1"></i>{{ __t('Copy') }}
                  </button>
                </div>
              </div>

              <div class="bank-warning">
               <i class="fa-solid fa-circle-info me-1"></i><br>
                Chuyển đúng nội dung để hệ thống cộng tiền tự động.<br>
                 NẠP 2 PHÚT KHÔNG VÔ VUI LÒNG LIÊN HỆ QUẢN TRỊ VIÊN.<br>
                  Zalo: 0369.679.388
              </div>
            </div>
          </div>
        @else
          <div class="deposit-panel">
            <div class="deposit-panel-body text-center">
              <h4 style="font-weight:900;">{{ __t('Chưa có tài khoản ngân hàng') }}</h4>
              <p class="mb-0 text-muted">{{ __t('Vui lòng liên hệ quản trị viên để được hỗ trợ.') }}</p>
            </div>
          </div>
        @endif
      </div>
    </div>
  </section>

  @push('scripts')
    <script type="module">
      const CARD_FEES = @json($fees);
      const DEPOSIT_PREFIX = @json($deposit_prefix);

      $(document).ready(function () {
        new ClipboardJS('.copy');

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

        const updateQr = () => {
          const amount = $("#bank_amount").val();
          const qr = $("#bank-display-qr");

          if (!qr.length) return;

          const bankType = qr.data("bank-type");
          const bankName = qr.data("bank-name");
          const bankNumber = qr.data("bank-number");
          const bankOwner = qr.data("bank-owner");

          const qrUrl = buildQrUrl(bankType, bankName, bankNumber, bankOwner, amount);
          qr.attr("src", qrUrl);
        };

        $(".deposit-tab-btn").on("click", function () {
          const tab = $(this).data("tab");

          $(".deposit-tab-btn").removeClass("active-card active-bank");

          if (tab === "card") {
            $(this).addClass("active-card");
            $("#deposit-tab-card").show();
            $("#deposit-tab-bank").hide();
          }

          if (tab === "bank") {
            $(this).addClass("active-bank");
            $("#deposit-tab-bank").show();
            $("#deposit-tab-card").hide();
          }
        });

        $(".quick-amount").on("click", function () {
          $("#bank_amount").val($(this).data("amount"));
          updateQr();
        });

        $("#form-sendcard #amount, #form-sendcard #telco").on("change", function () {
          sumAmount();
        });

        $("#bank_amount").on("input change keyup", function () {
          updateQr();
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