@section('title', __t('Tiếp thị liên kết'))
<x-app-layout>
  <div id="app-wrap">
    <div class="tf-container">
      <div class="tf-spacing-16"></div>
      <div class="card">
        <div class="card-body">
          {!! Helper::getNotice('page_affiliate') !!}

          {{-- {{ json_encode($user->referrer->affiliate->update(['clicks' => 1000])) }} --}}
        </div>
      </div>
      <div class="tf-spacing-16"></div>
      <div class="grid grid-cols-3 gap-3 mb-3">
        <div class="mb-3">
          <div class="card border-0 zoom-in bg-light-danger shadow-none pb-2">
            <div class="card-body">
              <div class="text-center">
                <img src="/images/svg-icons/bank-card.svg" style="width: 50px" class="mb-3" alt="" />
                <p class="fw-semibold fs-5 text-red-500 mb-1">{{ __t('Số Dư Hoa Hồng') }}</p>
                <h5 class="fw-semibold text-danger mb-0">{{ Helper::formatCurrency(Auth::user()->balance_1 ?? 0) }}</h5>
              </div>
            </div>
          </div>
        </div>
        <div class="mb-3">
          <div class="card border-0 zoom-in bg-light-primary shadow-none pb-2">
            <div class="card-body">
              <div class="text-center">
                <img src="/images/svg-icons/bank-card.svg" style="width: 50px" class="mb-3" alt="" />
                <p class="fw-semibold fs-5 text-primary-500 mb-1">{{ __t('Hoa Hồng Đã Rút') }}</p>
                <h5 class="fw-semibold text-primary mb-0">{{ Helper::formatCurrency(Auth::user()->total_withdraw ?? 0) }}</h5>
              </div>
            </div>
          </div>
        </div>
        <div class="mb-3">
          <div class="card border-0 zoom-in bg-light-success shadow-none pb-2">
            <div class="card-body">
              <div class="text-center">
                <img src="/images/svg-icons/bank-card.svg" style="width: 50px" class="mb-3" alt="" />
                <p class="fw-semibold fs-5 text-success-600 mb-1">{{ __t('Đã Giới Thiệu') }}</p>
                <h5 class="fw-semibold text-success mb-0">{{ Auth::user()->referrals()->count() ?? 0 }}</h5>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-3 gap-3 mb-3">
        <div class="mb-3">
          <div class="card border-0 zoom-in bg-light-danger shadow-none pb-2">
            <div class="card-body">
              <div class="text-center">
                <img src="/images/svg-icons/bank-card.svg" style="width: 50px" class="mb-3" alt="" />
                <p class="fw-semibold fs-5 text-success-500 mb-1">{{ __t('Lượt Clicks') }}</p>
                <h5 class="fw-semibold text-danger mb-0">{{ number_format($affiliate->clicks) }}</h5>
              </div>
            </div>
          </div>
        </div>
        <div class="mb-3">
          <div class="card border-0 zoom-in bg-light-danger shadow-none pb-2">
            <div class="card-body">
              <div class="text-center">
                <img src="/images/svg-icons/bank-card.svg" style="width: 50px" class="mb-3" alt="" />
                <p class="fw-semibold fs-5 text-primary-500 mb-1">{{ __t('Lượt Đăng Ký') }}</p>
                <h5 class="fw-semibold text-danger mb-0">{{ number_format($affiliate->signups) }}</h5>
              </div>
            </div>
          </div>
        </div>
        <div class="mb-3">
          <div class="card border-0 zoom-in bg-light-danger shadow-none pb-2">
            <div class="card-body">
              <div class="text-center">
                <img src="/images/svg-icons/bank-card.svg" style="width: 50px" class="mb-3" alt="" />
                <p class="fw-semibold fs-5 text-info-500 mb-1">{{ __t('Số Tiền Nạp') }}</p>
                <h5 class="fw-semibold text-danger mb-0">{{ number_format($affiliate->total_deposit) }}</h5>
              </div>
            </div>
          </div>
        </div>
        <div class="mb-3">
          <div class="card border-0 zoom-in bg-light-danger shadow-none pb-2">
            <div class="card-body">
              <div class="text-center">
                <img src="/images/svg-icons/bank-card.svg" style="width: 50px" class="mb-3" alt="" />
                <p class="fw-semibold fs-5 text-warning-500 mb-1">{{ __t('Số Account Đã Mua') }}</p>
                <h5 class="fw-semibold text-danger mb-0">{{ number_format($affiliate->total_account_buy) }}</h5>
              </div>
            </div>
          </div>
        </div>
        <div class="mb-3">
          <div class="card border-0 zoom-in bg-light-danger shadow-none pb-2">
            <div class="card-body">
              <div class="text-center">
                <img src="/images/svg-icons/bank-card.svg" style="width: 50px" class="mb-3" alt="" />
                <p class="fw-semibold fs-5 text-primary-500 mb-1">{{ __t('Số Item Đã Mua') }}</p>
                <h5 class="fw-semibold text-danger mb-0">{{ number_format($affiliate->total_item_buy) }}</h5>
              </div>
            </div>
          </div>
        </div>
        <div class="mb-3">
          <div class="card border-0 zoom-in bg-light-danger shadow-none pb-2">
            <div class="card-body">
              <div class="text-center">
                <img src="/images/svg-icons/bank-card.svg" style="width: 50px" class="mb-3" alt="" />
                <p class="fw-semibold fs-5 text-green-500 mb-1">{{ __t('Số Lượt Cày Thuê') }}</p>
                <h5 class="fw-semibold text-danger mb-0">{{ number_format($affiliate->total_boost_buy) }}</h5>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 mb-3">
          <div class="card p-5">
            <div class="card-body">
              <div class="mb-3">
                <h6 class="card-title mb-0">{{ __t('Thông Tin Giới Thiệu') }}</h6>
                <div class="my-3 border-top"></div>
              </div>
              <div>
                <div class="text-danger fw-bold mb-3">{{ __t('Bạn sẽ nhận được') }} {{ setting('comm_percent', 10) }}% {{ __t('hoa hồng khi người dùng bạn giới thiệu nạp tiền vào tài khoản') }}.</div>
                <div>
                  <label for="referral_code" class="form-label">{{ __t('Liên Kết Giới Thiệu') }}:</label>
                  <div style="display: flex">
                    <input type="text" id="referral_code" name="referral_code" class="form-control st1" value="{{ route('ref', ['ref' => $affiliate->code]) }}" style="border-radius: 5px 0 0 5px" readonly>
                    <div>
                      <button class="btn btn-lg btn-primary input-group-text copy" data-clipboard-target="#referral_code" style="border-radius: 0 5px 5px 0" type="button"><i class="fas fa-copy"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12 mb-3">
          <div class="card p-5">
            <div class="card-body">
              <div class="mb-3">
                <h6 class="card-title mb-0">{{ __t('Yêu Cầu Rút Tiền') }}</h6>
                <div class="my-3 border-top"></div>
              </div>
              <div>
                <form action="/api/users/affiliates/withdraw" id="form-withdraw" method="POST">
                  <div class="mb-5">
                    <div class="text-danger fw-bold">
                      <i>
                        {{ __t('Số tiền có thể rút') }}: {{ __t('từ') }}
                        <span class="text-primary">{{ Helper::formatCurrency($config['min_withdraw'] ?? 0) }}</span> {{ __t('đến') }} <span
                          class="text-success">{{ Helper::formatCurrency($config['max_withdraw'] ?? 0) }}</span>
                      </i>
                    </div>
                  </div>
                  <div class="mb-4">
                    <label for="amount" class="form-label">{{ __t('Số Tiền Rút') }}</label>
                    <input type="number" class="form-control" id="amount" name="amount" value="{{ old('amount', $config['min_withdraw'] ?? 0) }}" required>
                  </div>
                  <div class="mb-4">
                    <label for="withdraw_to" class="form-label">{{ __t('Rút Về') }}</label>
                    <select name="withdraw_to" id="withdraw_to" class="form-control">
                      <option value="bank" selected>{{ __t('Ngân Hàng') }}</option>
                      <option value="wallet">{{ __t('Ví Tài Khoản') }}</option>
                    </select>
                  </div>
                  <div class="mb-4 group_banking d-none">
                    <label for="bank_name" class="form-label">{{ __t('Ngân Hàng') }}</label>
                    <select name="bank_name" id="bank_name" class="form-control">
                      <option value="">{{ __t('Chọn Ngân Hàng Rút') }}</option>
                      @foreach (Helper::getListBank() as $bank)
                        <option value="{{ $bank['code'] }}">{{ $bank['shortName'] }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="grid grid-cols-2 gap-3 mb-4 group_banking d-none">
                    <div class="col-md-6">
                      <label for="account_number" class="form-label">{{ __t('Số Tài Khoản') }}</label>
                      <input type="text" class="form-control" id="account_number" name="account_number" value="{{ old('account_number') }}" placeholder="{{ __t('Nhập số tài khoản') }}">
                    </div>
                    <div class="col-md-6">
                      <label for="account_name" class="form-label">{{ __t('Chủ Tài Khoản') }}</label>
                      <input type="text" class="form-control" id="account_name" name="account_name" value="{{ old('account_name') }}" placeholder="{{ __t('Nhập tên chủ tài khoản') }}">
                    </div>
                  </div>
                  <div class="mb-4 group_banking d-none">
                    <label for="user_note" class="form-label">{{ __t('Ghi Chú') }}</label>
                    <textarea name="user_note" id="user_note" class="form-control" rows="3" placeholder="{{ __t('Nhập ghi chú cho admin nếu có') }}">{{ old('user_note') }}</textarea>
                  </div>
                  <div class="mb-3">
                    <button class="btn btn-primary w-full large w-100" type="submit">{{ __t('Rút Tiền Ngay') }}</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12 mb-3">
          <div class="card p-5">
            <div class="card-body">
              <div class="mb-3">
                <h6 class="card-title">{{ __t('Danh Sách Người Được Giới Thiệu') }}</h6>
                <div class="my-3 border-top"></div>
              </div>
              <div class="table-responsive df-example demo-table">
                <table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700" id="datatable">
                  <thead class=" border-t border-slate-100 dark:border-slate-800">
                    <tr>
                      <th class="table-th">#</th>
                      <th class="table-th">{{ __t('Tài khoản') }}</th>
                      <th class="table-th">{{ __t('Tổng Tiền Nạp') }}</th>
                      <th class="table-th">{{ __t('Tiền Hoa Hồng') }}</th>
                      <th class="table-th">{{ __t('Thời Gian Tạo') }}</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                    @foreach ($user->referrals()->orderBy('created_at', 'desc')->get() as $value)
                      <tr>
                        <td class="table-td">{{ $loop->iteration }}</td>
                        <td class="table-td">{{ Helper::hideUsername($value->username) }}</td>
                        <td class="table-td">{{ Helper::formatCurrency($value->total_deposit) }}</td>
                        <td class="table-td">{{ Helper::formatCurrency(Helper::getTotalComm($user->username, $value->username)) }}</td>
                        <td class="table-td">{{ $value->created_at }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12 mb-3">
          <div class="card p-5">
            <div class="card-body">
              <div class="mb-3">
                <h6 class="card-title">{{ __t('Lịch Sử Giao Dịch Ví') }}</h6>
                <div class="my-3 border-top"></div>
              </div>
              <div class="table-responsive df-example demo-table overflow-auto">
                <table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700 whitespace-nowrap" id="datatable">
                  <thead>
                    <tr>
                      <th class="table-th">#</th>
                      <th class="table-th">{{ __t('Mã Giao Dịch') }}</th>
                      <th class="table-th">{{ __t('Số Tiền') }}</th>
                      <th class="table-th">{{ __t('Số Dư Trước') }}</th>
                      <th class="table-th">{{ __t('Số Dư Sau') }}</th>
                      <th class="table-th">{{ __t('Giao Dịch') }}</th>
                      <th class="table-th">{{ __t('Trạng Thái') }}</th>
                      <th class="table-th">{{ __t('Tài Khoản') }}</th>
                      <th class="table-th">{{ __t('Ghi Chú') }}</th>
                      <th class="table-th">{{ __t('Hệ Thống') }}</th>
                      <th class="table-th">{{ __t('Thời Gian') }}</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                    @foreach ($histories as $value)
                      <tr>
                        <td class="table-td">{{ $value->id }}</td>
                        <td class="table-td">{{ $value->order_id }}</td>
                        <td class="table-td">{{ Helper::formatCurrency($value->amount) }}</td>
                        <td class="table-td">{{ Helper::formatCurrency($value->balance_before) }}</td>
                        <td class="table-td">{{ Helper::formatCurrency($value->balance_after) }}</td>
                        <td class="table-td">{{ $value->prefix === '+' ? __t('Cộng Tiền') : __t('Trừ Tiền') }}</td>
                        <td class="table-td">{!! $value->status_html !!}</td>
                        <td class="table-td">{{ $value->username }}</td>
                        <td class="table-td">{{ $value->user_note }}</td>
                        <td class="table-td">{{ $value->sys_note }}</td>
                        <td class="table-td">{{ $value->created_at }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @push('scripts')
    <script>
      $(document).ready(() => {
        $('#withdraw_to').change(function() {
          if ($(this).val() == 'bank') {
            $('.group_banking').removeClass('hidden');
          } else {
            $('.group_banking').addClass('hidden');
          }
        })
        // $("#withdraw_to").trigger()

        $("#form-withdraw").submit(async e => {
          e.preventDefault();

          const action = $(e.target).attr('action'),
            button = $(e.target).find('button[type="submit"]')
          payload = $formDataToPayload(new FormData(e.target));

          const confirm = await Swal.fire({
            title: 'Xác Nhận',
            html: `Bạn muốn rút <b>${$formatNumber(payload.amount)} VNĐ</b> về <b>${payload.withdraw_to === 'bank' ? 'ngân hàng' : 'website'}</b> đúng không?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Xác Nhận',
            cancelButtonText: 'Hủy',
          })

          if (!confirm.isConfirmed) return

          if (payload.amount < {{ $config['min_withdraw'] ?? 0 }}) {
            return Swal.fire('Thất Bại', `Số tiền rút tối thiểu là {{ number_format($config['min_withdraw'] ?? 0) }} VNĐ`, 'error')
          }

          if (payload.amount > {{ $config['max_withdraw'] ?? 0 }}) {
            return Swal.fire('Thất Bại', `Số tiền rút tối đa là {{ number_format($config['max_withdraw'] ?? 0) }} VNĐ`, 'error')
          }

          $setLoading(button)

          axios.post(action, payload).then(({
            data: result
          }) => {
            Swal.fire('Thành Công', result.message, 'success').then(() => location.reload())
          }).catch(e => {
            Swal.fire('Thất Bại', $catchMessage(e), 'error')
          }).finally(() => {
            $removeLoading(button)
          })
        })
      })
    </script>
  @endpush
</x-app-layout>
