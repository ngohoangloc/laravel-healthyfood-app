@extends('admin.admin')

@section('title')
    <title>Nhân viên | Healthy Food</title>
@endsection

@section('content')
    <div class="main-content">
        <div class="page-header">
            <div class="header-sub-title">
                <nav class="breadcrumb breadcrumb-dash">
                    <a href="/admin" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Dashboard</a>
                    <span class="breadcrumb-item active">Nhân viên</span>
                </nav>
            </div>
            <div class=" d-flex justify-content-end text-white">
                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#createModal">Thêm mới</button>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4>NHÂN VIÊN</h4>
                </h4>
                <?php $i = 1; ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">
                                    #
                                </th>
                                <th scope="col">
                                    Họ tên
                                </th>
                                <th scope="col">
                                    Địa chỉ
                                </th>
                                <th scope="col">
                                    Số điện thoại
                                </th>
                                <th scope="col">
                                    Vị trí làm việc
                                </th>
                                <th scope="col">
                                    Tác vụ
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                                <tr>
                                    <td>
                                        <?php
                                        echo $i;
                                        $i += 1;
                                        ?>
                                    </td>
                                    <td>{{ $employee->name }}</td>
                                    <td>{{ $employee->address }}</td>
                                    <td>{{ $employee->phone }}</td>
                                    <td>{{ $employee->role->name }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-success" data-toggle="modal"
                                            data-target="#detailModal{{ $employee->id }}"><i
                                                class="anticon anticon-info-circle"></i></a>
                                        <a href="#"class="btn btn-sm btn-primary" data-toggle="modal"
                                            data-target="#editModal{{ $employee->id }}"><i
                                                class="anticon anticon-edit"></i></a>
                                        <a href="#" class="btn btn-sm btn-danger" data-toggle="modal"
                                            data-target="#deleteModal{{ $employee->id }}"><i
                                                class="anticon anticon-delete"></i></a>
                                    </td>
                                </tr>
                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $employee->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="delete" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="delete">{{ $employee->name }}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('admin.employee.delete', ['id' => $employee->id]) }}"
                                                method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="modal-body">
                                                        Bạn muốn xoá ?
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default m-r-10"
                                                        data-dismiss="modal">Huỷ</button>
                                                    <button type="submit" class="btn btn-danger">Xoá</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End delete modal -->

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal{{ $employee->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="edit" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Chỉnh sửa</h5>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <i class="anticon anticon-close"></i>
                                                </button>
                                            </div>
                                            <form action="{{ route('admin.employee.update', ['id' => $employee->id]) }}"
                                                method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">

                                                    <div class="form-group">
                                                        <label for="name">Họ tên</label>
                                                        <input type="text" class="form-control" id="employee-name"
                                                            name="name" value="{{ $employee->name }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Địa chỉ</label>
                                                        <input type="text" class="form-control" id="employee-address"
                                                            name="address" value="{{ $employee->address }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="phone">Số điện thoại</label>
                                                        <input type="text" class="form-control" id="employee-phone"
                                                            name="phone" value="{{ $employee->phone }}" required>
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
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="create"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm nhân viên</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="anticon anticon-close"></i>
                    </button>
                </div>
                <form action="{{ route('admin.employee.create') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="employee-name">Họ tên</label>
                            <input type="text" class="form-control" id="employee-name" name="name"
                                placeholder="Nhập tên Nhân viên..." required>
                        </div>
                        <div class="form-group">
                            <label for="employee-name">Địa chỉ</label>
                            <input type="text" class="form-control" id="employee-address" name="address"
                                placeholder="Nhập địa chỉ..." required>
                        </div>
                        <div class="form-group">
                            <label for="employee-phone">Số điện thoại</label>
                            <input type="text" class="form-control" id="employee-phone" name="phone"
                                placeholder="Nhập số điện thoại..." required>
                        </div>
                        <div class="form-group">
                            <label for="item-name">Vị trí làm việc</label>
                            <select class="select form-control" name="role_id">
                                <option value="0">Lựa chọn...</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="employee-name">Tên đăng nhập</label>
                            <input type="text" class="form-control" id="employee-username" name="username"
                                placeholder="Nhập tên đăng nhập..." required>
                        </div>
                        <div class="form-group">
                            <label for="employee-name">Mật khẩu</label>
                            <input type="password" class="form-control" id="employee-password" name="password"
                                placeholder="Nhập mật khẩu..." required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default m-r-10" data-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
