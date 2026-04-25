@extends('admin.layouts.master')
@section('title', 'Admin: User Detail')

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

    .ctv-group-box {
      border: 1px solid #e5e7eb;
      background: #f8fafc;
      border-radius: 12px;
      padding: 14px;
    }

    .ctv-group-actions {
      display: flex;
      gap: 8px;
      margin-bottom: 12px;
      flex-wrap: wrap;
    }

    .ctv-group-tag {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 8px 14px;
      border-radius: 999px;
      border: 1px solid #d9d9d9;
      background: #fff;
      color: #333;
      font-weight: 600;
      cursor: pointer;
      user-select: none;
      transition: all .2s ease;
      margin: 4px;
    }

    .ctv-group-tag:hover {
      background: #eef2ff;
      border-color: #845adf;
    }

    .ctv-group-tag.active {
      background: linear-gradient(45deg, #845adf, #6a3fd1);
      border-color: #845adf;
      color: #fff;
      box-shadow: 0 2px 8px rgba(132, 90, 223, 0.3);
    }

    .ctv-group-tag .check-icon {
      display: none;
    }

    .ctv-group-tag.active .check-icon {
      display: inline;
    }
  </style>

  @php
    $affiliate = $user->affiliate;

    $collaborators = [
        'items' => 'Vật phẩm',
        'account' => 'Tài khoản',
        'boosting' => 'Cày thuê',
    ];

    $staffGroups = \App\Models\Group::where('status', true)->orderBy('id', 'desc')->get();
    $selectedStaffGroups = $user->staff_group_ids ?? [];
  @endphp

  <div class="card custom-card">
    <div class="card-header justify-content-between">
      <div class="card-title">Thông Tin Chung</div>
    </div>

    <div class="card-body">
      <form action="{{ route('admin.users.update', ['id' => $user->id]) }}" method="POST" class="default-form">
        @csrf

        <div class="form-group row mb-3">
          <div class="col-lg-6">
            <label class="form-label">Tài khoản</label>
            <input type="text" class="form-control" value="{{ $user->username }}" readonly>
          </div>

          <div class="col-lg-6">
            <label class="form-label">Access Token (API)</label>
            <input type="text" class="form-control" value="{{ $user->access_token }}" readonly>
          </div>
        </div>

        <div class="form-group row mb-3">
          <div class="col-lg-6">
            <label class="form-label">Ngày đăng ký</label>
            <input type="text" class="form-control" value="{{ $user->created_at }}" readonly>
          </div>

          <div class="col-lg-6">
            <label class="form-label">Địa chỉ IP</label>
            <input type="text" class="form-control" value="{{ $user->ip_address }}" readonly>
          </div>
        </div>

        <div class="form-group row mb-3">
          <div class="col-lg-6">
            <label class="form-label">Số tiền hiện tại</label>
            <input type="text" class="form-control" value="{{ Helper::formatCurrency($user->balance) }}" readonly>
          </div>

          <div class="col-lg-6">
            <label class="form-label">Tổng tiền đã nạp</label>
            <input type="text" class="form-control" value="{{ Helper::formatCurrency($user->total_deposit) }}" readonly>
          </div>
        </div>

        <div class="form-group row mb-3">
          <div class="col-md-3">
            <label class="form-label">Loại tài khoản</label>
            <select class="form-control" name="role" required>
              <option value="member" @selected($user->role == 'member')>Thành viên</option>
              <option value="partner" @selected($user->role == 'partner')>Đối tác</option>
              <option value="collaborator" @selected($user->role == 'collaborator')>Cộng tác viên</option>
              <option value="accounting" @selected($user->role == 'accounting')>Kế toán</option>
              <option value="admin" @selected($user->role == 'admin')>Quản trị viên</option>
            </select>
          </div>

          <div class="col-md-3">
            <label class="form-label">Cộng tác viên</label>
            <select name="colla_type" id="colla_type" class="form-control">
              <option value="">Không có</option>
              @foreach ($collaborators as $key => $collaborator)
                <option value="{{ $key }}" @selected($user->colla_type == $key)>
                  {{ $collaborator }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="col-md-3">
            <label class="form-label">% Hoa hồng mỗi đơn</label>
            <input type="number" class="form-control" name="colla_percent" value="{{ $user->colla_percent ?? 0 }}" min="0" max="100">
          </div>

          <div class="col-md-3">
            <label class="form-label">Tài khoản CTV</label>
            <input type="text" class="form-control"
              value="DƯ: {{ Helper::formatCurrency($user->colla_balance) }}; GIỮ: {{ Helper::formatCurrency($user->colla_pending) }}; RÚT: {{ Helper::formatCurrency($user->colla_withdraw) }}"
              readonly>
          </div>
        </div>

        <div class="form-group mb-3" id="ctv-group-wrapper">
          <label class="form-label fw-bold">Nhóm tài khoản CTV được phép quản lý</label>

          <div class="ctv-group-box">
            <div class="ctv-group-actions">
              <button type="button" class="btn btn-sm btn-primary" onclick="selectAllCtvGroups()">Chọn tất cả</button>
              <button type="button" class="btn btn-sm btn-danger" onclick="clearAllCtvGroups()">Bỏ chọn</button>
            </div>

            <div class="d-flex flex-wrap">
              @foreach ($staffGroups as $group)
                @php
                  $checked = in_array($group->id, $selectedStaffGroups);
                @endphp

                <label class="ctv-group-tag {{ $checked ? 'active' : '' }}">
                  <input
                    type="checkbox"
                    name="staff_group_ids[]"
                    value="{{ $group->id }}"
                    {{ $checked ? 'checked' : '' }}
                    hidden
                  >
                  <span class="check-icon">✓</span>
                  <span>ID {{ $group->id }}: {{ $group->name }}</span>
                </label>
              @endforeach
            </div>
          </div>
        </div>

        <div class="form-group row mb-3">
          <div class="col-md-6">
            <label class="form-label">Số dư cộng tác viên</label>
            <input type="text" class="form-control" value="{{ Helper::formatCurrency($user->colla_balance) }}" readonly>
          </div>

          <div class="col-md-6">
            <label class="form-label">Link Cron Duyệt Tiền</label>
            <input type="text" class="form-control" value="{{ route('cron.check-payment-staff') }}" readonly>
          </div>
        </div>

        <div class="form-group row mb-3">
          <div class="col-lg-6">
            <label class="form-label">Trạng thái</label>
            <select class="form-control" name="status" required>
              <option value="active" @selected($user->status == 'active')>Active</option>
              <option value="locked" @selected($user->status == 'locked')>Locked</option>
            </select>
          </div>

          <div class="col-lg-6">
            <label class="form-label">Địa chỉ e-mail</label>
            <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
          </div>
        </div>

        <div class="form-group mb-3">
          <label class="form-label">Đặt lại mật khẩu</label>
          <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu nếu muốn đổi">
        </div>

        <div class="form-group row mb-3">
          <div class="col-md-6">
            <label class="form-label">Số dư hoa hồng</label>
            <input type="number" class="form-control" name="balance_1" value="{{ $user->balance_1 }}" required>
          </div>

          <div class="col-md-6">
            <label class="form-label">Người giới thiệu</label>
            <input type="text" class="form-control" value="{{ $user->referrer?->username ?? 'Không có' }}" readonly>
          </div>
        </div>

        <div class="form-group">
          <button class="btn btn-primary-gradient w-100" type="submit" name="action" value="update-info">
            Cập nhật
          </button>
        </div>
      </form>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-6">
      <div class="card custom-card">
        <div class="card-header">
          <div class="card-title">Cộng tiền</div>
        </div>

        <div class="card-body">
          <form action="{{ route('admin.users.update', ['id' => $user->id]) }}" method="POST" class="default-form">
            @csrf

            <div class="form-group mb-3">
              <label class="form-label">Số tiền</label>
              <input type="number" class="form-control" name="amount" min="0" required>
            </div>

            <div class="form-group mb-3">
              <label class="form-label">Lý do</label>
              <input type="text" class="form-control" name="reason" placeholder="Nhập lý do">
            </div>

            <button type="submit" name="action" value="plus-money" class="btn btn-success w-100">
              Cộng tiền
            </button>
          </form>
        </div>
      </div>
    </div>

    <div class="col-lg-6">
      <div class="card custom-card">
        <div class="card-header">
          <div class="card-title">Trừ tiền</div>
        </div>

        <div class="card-body">
          <form action="{{ route('admin.users.update', ['id' => $user->id]) }}" method="POST" class="default-form">
            @csrf

            <div class="form-group mb-3">
              <label class="form-label">Số tiền</label>
              <input type="number" class="form-control" name="amount" min="0" required>
            </div>

            <div class="form-group mb-3">
              <label class="form-label">Lý do</label>
              <input type="text" class="form-control" name="reason" placeholder="Nhập lý do">
            </div>

            <button type="submit" name="action" value="sub-money" class="btn btn-danger w-100">
              Trừ tiền
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-6">
      <div class="card custom-card">
        <div class="card-header">
          <div class="card-title">Cộng hoa hồng CTV</div>
        </div>

        <div class="card-body">
          <form action="{{ route('admin.users.update', ['id' => $user->id]) }}" method="POST" class="default-form">
            @csrf

            <div class="form-group mb-3">
              <label class="form-label">Số tiền</label>
              <input type="number" class="form-control" name="amount" min="0" required>
            </div>

            <div class="form-group mb-3">
              <label class="form-label">Lý do</label>
              <input type="text" class="form-control" name="reason" placeholder="Nhập lý do">
            </div>

            <button type="submit" name="action" value="plus-commision" class="btn btn-success w-100">
              Cộng hoa hồng
            </button>
          </form>
        </div>
      </div>
    </div>

    <div class="col-lg-6">
      <div class="card custom-card">
        <div class="card-header">
          <div class="card-title">Trừ hoa hồng CTV</div>
        </div>

        <div class="card-body">
          <form action="{{ route('admin.users.update', ['id' => $user->id]) }}" method="POST" class="default-form">
            @csrf

            <div class="form-group mb-3">
              <label class="form-label">Số tiền</label>
              <input type="number" class="form-control" name="amount" min="0" required>
            </div>

            <div class="form-group mb-3">
              <label class="form-label">Lý do</label>
              <input type="text" class="form-control" name="reason" placeholder="Nhập lý do">
            </div>

            <button type="submit" name="action" value="sub-commision" class="btn btn-danger w-100">
              Trừ hoa hồng
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script>
    document.querySelectorAll('.ctv-group-tag').forEach(function(tag) {
      tag.addEventListener('click', function(e) {
        e.preventDefault();

        const input = tag.querySelector('input');
        input.checked = !input.checked;
        tag.classList.toggle('active', input.checked);
      });
    });

    function selectAllCtvGroups() {
      document.querySelectorAll('.ctv-group-tag').forEach(function(tag) {
        const input = tag.querySelector('input');
        input.checked = true;
        tag.classList.add('active');
      });
    }

    function clearAllCtvGroups() {
      document.querySelectorAll('.ctv-group-tag').forEach(function(tag) {
        const input = tag.querySelector('input');
        input.checked = false;
        tag.classList.remove('active');
      });
    }
  </script>
@endsection