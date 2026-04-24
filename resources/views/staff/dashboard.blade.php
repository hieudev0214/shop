@extends('staff.layouts.app')
@section('content')
  <style>
    .card-stats h3 {
      color: #9A3B3B;
      font-size: 36px;
    }

    .card-stats h6 {
      color: #9A3B3B;
      font-size: 18px;
    }
  </style>
  <div>
    <h3>Thống Kê Tài Khoản CTV</h3>
    <div class="row">
      @foreach ($stats['users'] as $key => $value)
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <div class="text-center card-stats">
                <h3>{{ Helper::formatCurrency($value) }}</h3>
                <h5>{{ $key }}</h5>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
    <h3>Thống Kê Đơn Tài Khoản</h3>
    <div class="row">
      @foreach ($stats['accounts'] as $key => $value)
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <div class="text-center card-stats">
                <h3>{{ number_format($value) }}</h3>
                <h5>{{ $key }}</h5>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
    <h3>Thống Kê Đơn Vật Phẩm</h3>
    <div class="row">
      @foreach ($stats['items'] as $key => $value)
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <div class="text-center card-stats">
                <h3>{{ number_format($value) }}</h3>
                <h5>{{ $key }}</h5>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
    <h3>Thống Kê Đơn Cày Thuê</h3>
    <div class="row">
      @foreach ($stats['boostings'] as $key => $value)
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <div class="text-center card-stats">
                <h3>{{ number_format($value) }}</h3>
                <h5>{{ $key }}</h5>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
    <h3>Thống Kê Doanh Thu</h3>
    <div class="row">
      @foreach ($stats['transactions'] as $key => $value)
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <div class="text-center card-stats">
                <h3>{{ Helper::formatCurrency($value) }}</h3>
                <h5>{{ $key }}</h5>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="card custom-card">
          <div class="card-header justify-content-between">
            <div class="card-title">Yêu cầu rút tiền</div>
          </div>
          <div class="card-body">
            <form action="{{ route('staff.withdraws.store') }}" method="POST" id="form-withdraw">
              <div class="mb-3">
                <label for="amount" class="form-label">Số tiền rút</label>
                <input type="number" class="form-control" id="amount" name="amount" value="10000" required>
              </div>
              <div class="mb-4">
                <label for="bank_name" class="form-label">{{ __t('Ngân Hàng') }}</label>
                <select name="bank_name" id="bank_name" class="form-control">
                  <option value="">{{ __t('Chọn Ngân Hàng Rút') }}</option>
                  @foreach (Helper::getListBank() as $bank)
                    <option value="{{ $bank['code'] }}">{{ $bank['name'] }}</option>
                  @endforeach
                </select>
              </div>
              <div class="row mb-4">
                <div class="col-md-6">
                  <label for="account_number" class="form-label">{{ __t('Số Tài Khoản') }}</label>
                  <input type="text" class="form-control" id="account_number" name="account_number" value="{{ old('account_number') }}" placeholder="{{ __t('Nhập số tài khoản') }}">
                </div>
                <div class="col-md-6">
                  <label for="account_name" class="form-label">{{ __t('Chủ Tài Khoản') }}</label>
                  <input type="text" class="form-control" id="account_name" name="account_name" value="{{ old('account_name') }}" placeholder="{{ __t('Nhập tên chủ tài khoản') }}">
                </div>
              </div>
              <div class="mb-4">
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
      <div class="col-md-6">
        <div class="card custom-card">
          <div class="card-header justify-content-between">
            <div class="card-title">Lịch sử yêu cầu</div>
          </div>
          <div class="card-body">
            <div class="table-responsive" style="padding: 5px">
              <table class="display table table-bordered table-stripped text-nowrap datatable" id="basic-1">
                <thead>
                  <tr>
                    <td>#</td>
                    <td>Số tiền</td>
                    <td>Ngân hàng</td>
                    <td>Số tài khoản</td>
                    <td>Trạng thái</td>
                    <td>Thời gian</td>
                    <td>Ghi chú</td>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($withdraws as $value)
                    <tr>
                      <td>{{ $value->id }}</td>
                      <td>{{ Helper::formatCurrency($value->amount) }}</td>
                      <td>{{ $value->payment_info['bank_name'] ?? '' }}</td>
                      <td>{{ $value->payment_info['account_name'] ?? '' }}</td>
                      <td>{!! Helper::formatStatus($value->status) !!}</td>
                      <td>{{ $value->created_at }}</td>
                      <td>{{ $value->user_note }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="card custom-card">
          <div class="card-header justify-content-between">
            <div class="card-title">Danh sách giao dịch</div>
          </div>
          <div class="card-body">
            <div class="table-responsive theme-scrollbar" style="padding: 10px">
              <table class="display table table-bordered table-stripped text-nowrap datatable" id="basic-1">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Tài khoản</th>
                    <th>Giao dịch</th>
                    <th>Mã giao dịch</th>
                    <th>Số dư trước</th>
                    <th>Số tiền</th>
                    <th>Số dư sau</th>
                    <th>Nội dung</th>
                    <th>Trạng thái</th>
                    <th>Thời gian</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($transactions as $value)
                    <tr>
                      <td>{{ $value->id }}</td>
                      <td>{{ $value->username }}</td>
                      <td>{{ $value->type }}</td>
                      <td>{{ $value->reference }}</td>
                      <td>{{ Helper::formatCurrency($value->balance_before) }}</td>
                      <td>{{ Helper::formatCurrency($value->amount) }}</td>
                      <td>{{ Helper::formatCurrency($value->balance_after) }}</td>
                      <td>{{ $value->description }}</td>
                      <td>{!! Helper::formatStatus($value->status) !!}</td>
                      <td>{{ $value->created_at }}</td>
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
@endsection
@section('scripts')
  <script>
    $("#form-withdraw").submit(async e => {
      e.preventDefault();

      const action = $(e.target).attr('action'),
        button = $(e.target).find('button[type="submit"]')
      payload = $formDataToPayload(new FormData(e.target));

      const confirm = await Swal.fire({
        title: 'Xác Nhận',
        html: `Bạn muốn rút <b>${$formatNumber(payload.amount)} VNĐ</b> về <b>ngân hàng</b> đúng không?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Xác Nhận',
        cancelButtonText: 'Hủy',
      })

      if (!confirm.isConfirmed) return

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
  </script>
@endsection
