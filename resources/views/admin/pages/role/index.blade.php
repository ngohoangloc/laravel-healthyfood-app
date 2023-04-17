@extends('admin.admin')

@section('title')
    <title>Vai trò | Healthy Food</title>
@endsection

@section('content')
    <div class="main-content">
        <div class="page-header">
            <div class="header-sub-title">
                <nav class="breadcrumb breadcrumb-dash">
                    <a href="/admin/dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Dashboard</a>
                    <span class="breadcrumb-item active">Vai trò</span>
                </nav>
            </div>
            <div class=" d-flex justify-content-end text-white">
                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#createModal">Thêm mới</button>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h4>VAI TRÒ</h4>
                <?php $i = 1; ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">
                                    #
                                </th>
                                <th scope="col">
                                    Tên vai trò
                                </th>
                                <th scope="col">
                                    Tác vụ
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>
                                        <?php
                                        echo $i;
                                        $i += 1;
                                        ?>
                                    </td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-success" data-toggle="modal"
                                            data-target="#detailModal{{ $role->id }}"><i
                                                class="anticon anticon-info-circle"></i></a>
                                        <a href="#"class="btn btn-sm btn-primary" data-toggle="modal"
                                            data-target="#editModal{{ $role->id }}"><i
                                                class="anticon anticon-edit"></i></a>
                                        <a href="#" class="btn btn-sm btn-danger" data-toggle="modal"
                                            data-target="#deleteModal{{ $role->id }}"><i
                                                class="anticon anticon-delete"></i></a>
                                    </td>
                                </tr>
                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $role->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="delete" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="delete">{{ $role->name }}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Bạn muốn xoá ?
                                            </div>
                                            <div class="modal-footer">
                                                <a class="btn btn-danger"
                                                    href="{{ route('admin.role.delete', ['id' => $role->id]) }}"
                                                    role="button">Xoá</a>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End delete modal -->

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal{{ $role->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="delete" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Chỉnh sửa vai trò</h5>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <i class="anticon anticon-close"></i>
                                                </button>
                                            </div>
                                            <form action="{{ route('admin.role.edit', ['id' => $role->id]) }}"
                                                method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">

                                                    <div class="form-group">
                                                        <label for="name">Tên vai trò</label>
                                                        <input type="text" class="form-control" id="role-name"
                                                            name="name" value="{{ $role->name }}">
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default m-r-10"
                                                        data-dismiss="modal">Đóng</button>
                                                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End edit modal -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm vai trò</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="anticon anticon-close"></i>
                    </button>
                </div>
                <form action="{{ route('admin.role.create') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="formGroupExampleInput">Tên vai trò</label>
                            <input type="text" class="form-control" id="role-name" name="name"
                                placeholder="Nhập tên vai trò">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default m-r-10" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
