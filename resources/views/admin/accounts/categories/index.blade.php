@extends('admin.layouts.master')
@section('title', 'Admin: Accounts Category')

@section('content')
  <div class="card custom-card">
    <div class="card-header justify-content-between">
      <div class="card-title">Quản lý chuyên mục</div>
    </div>

    <div class="card-body">
      <div class="table-responsive theme-scrollbar p-2">
        <table class="display table table-bordered table-stripped text-center datatable">
          <thead>
            <tr>
              <th>#</th>
              <th>Ưu tiên</th>
              <th>Thao tác</th>
              <th>Tên chuyên mục</th>
              <th>Số nhóm con</th>
              <th>Người tạo</th>
              <th>Trạng thái</th>
              <th>Thời gian</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($categories as $item)
              <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->priority }}</td>
                <td>
                  <div class="d-flex">
                    <a href="javascript:void(0)" class="badge bg-primary-gradient me-1" data-bs-toggle="modal" data-bs-target="#modal-edit-{{ $item->id }}">
                      <i class="fa fa-edit"></i> sửa
                    </a>

                    <a href="{{ route('admin.accounts.groups', ['id' => $item->id]) }}" class="badge bg-info-gradient me-1">
                      <i class="fa fa-eye"></i> xem
                    </a>

                    @if ($item->groups->count() > 0)
                      <a href="{{ route('admin.accounts.items', ['id' => $item->groups->first()->id]) }}" class="badge bg-success-gradient me-1">
                        <i class="fa fa-plus"></i> thêm sản phẩm
                      </a>
                    @endif

                    <a href="javascript:deleteRow({{ $item->id }})" class="badge bg-danger-gradient me-1">
                      <i class="fa fa-trash"></i> xoá
                    </a>
                  </div>
                </td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->groups->count() }} nhóm</td>
                <td>{{ $item->username }}</td>
                <td>
                  @if ($item->status == 1)
                    <span class="text-success">Hoạt động</span>
                  @else
                    <span class="text-danger">Tạm đóng</span>
                  @endif
                </td>
                <td>{{ $item->created_at }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <div class="card-footer">
      <button class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#modal-add-product">
        <i class="fa fa-plus"></i> Thêm sản phẩm
      </button>

      <button class="btn btn-primary-gradient" data-bs-toggle="modal" data-bs-target="#modal-create">
        <i class="fa fa-edit"></i> Thêm chuyên mục mới
      </button>
    </div>
  </div>

  @foreach ($categories as $item)
    <div class="modal fade" id="modal-edit-{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Cập nhật chuyên mục #{{ $item->id }}</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <form action="{{ route('admin.accounts.categories.update', ['id' => $item->id]) }}" method="POST" class="default-form">
              @csrf

              <div class="mb-3">
                <label class="form-label">Ưu tiên</label>
                <input type="number" class="form-control" name="priority" value="{{ $item->priority }}">
                <i>Số ưu tiên lớn thì nó hiện ở đầu</i>
              </div>

              <div class="mb-3">
                <label class="form-label">Tên chuyên mục</label>
                <input type="text" class="form-control" name="name" value="{{ $item->name }}" required>
              </div>

              <div class="mb-3">
                <label class="form-label">Trạng thái</label>
                <select class="form-control" name="status" required>
                  <option value="1" @if ($item->status == 1) selected @endif>Hoạt động</option>
                  <option value="0" @if ($item->status == 0) selected @endif>Tạm đóng</option>
                </select>
              </div>

              <button class="btn btn-primary-gradient w-100" type="submit">Cập nhật</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  @endforeach

  <div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Thêm chuyên mục mới</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <form action="{{ route('admin.accounts.categories.store') }}" method="POST" class="default-form">
            @csrf

            <div class="mb-3">
              <label class="form-label">Ưu tiên</label>
              <input type="number" class="form-control" name="priority" value="0">
            </div>

            <div class="mb-3">
              <label class="form-label">Tên chuyên mục</label>
              <input type="text" class="form-control" name="name" placeholder="Nhập tên chuyên mục" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Trạng thái</label>
              <select class="form-control" name="status" required>
                <option value="1">Hoạt động</option>
                <option value="0">Tạm đóng</option>
              </select>
            </div>

            <button class="btn btn-primary w-100" type="submit">Thêm mới</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal-add-product" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            <i class="fa fa-plus"></i> Thêm sản phẩm
          </h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label for="add_product_category" class="form-label">Danh mục</label>
            <select id="add_product_category" class="form-control">
              <option value="">Chọn danh mục</option>
              @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="add_product_group" class="form-label">Nhóm</label>
            <select id="add_product_group" class="form-control">
              <option value="">Chọn nhóm</option>
            </select>
          </div>

          <button type="button" class="btn btn-success w-100" onclick="goAddProduct()">
            Tiếp tục thêm sản phẩm
          </button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script>
    const categoryGroups = {
      @foreach ($categories as $category)
        "{{ $category->id }}": [
          @foreach ($category->groups as $group)
            {
              id: "{{ $group->id }}",
              name: @json($group->name)
            },
          @endforeach
        ],
      @endforeach
    };

    const categorySelect = document.getElementById('add_product_category');
    const groupSelect = document.getElementById('add_product_group');

    if (categorySelect) {
      categorySelect.addEventListener('change', function() {
        const categoryId = this.value;

        groupSelect.innerHTML = '<option value="">Chọn nhóm</option>';

        if (!categoryId || !categoryGroups[categoryId]) return;

        categoryGroups[categoryId].forEach(function(group) {
          groupSelect.innerHTML += `<option value="${group.id}">${group.name}</option>`;
        });
      });
    }

    const goAddProduct = () => {
      const groupId = groupSelect.value;

      if (!groupId) {
        Swal.fire('Thất bại', 'Vui lòng chọn nhóm cần thêm sản phẩm', 'error');
        return;
      }

      window.location.href = `/admin/accounts/items/${groupId}`;
    }

    @if (request()->get('open_add_product') == 1)
      document.addEventListener('DOMContentLoaded', function() {
        const modal = new bootstrap.Modal(document.getElementById('modal-add-product'));
        modal.show();
      });
    @endif

    const deleteRow = async (id) => {
      const confirmDelete = await Swal.fire({
        title: 'Bạn có chắc chắn muốn xóa?',
        text: "Bạn sẽ không thể khôi phục lại dữ liệu này!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Xóa',
        cancelButtonText: 'Hủy'
      });

      if (!confirmDelete.isConfirmed) return;

      $showLoading();

      try {
        const { data: result } = await axios.post('{{ route('admin.accounts.categories.delete') }}', { id });

        Swal.fire('Thành công', result.message, 'success').then(() => {
          window.location.reload();
        });
      } catch (error) {
        Swal.fire('Thất bại', $catchMessage(error), 'error');
      }
    }
  </script>
@endsection