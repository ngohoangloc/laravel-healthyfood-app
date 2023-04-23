@extends('admin.admin')

@section('title')
    <title>Thực đơn | Healthy Food</title>
@endsection

@section('content')
    <div class="main-content">
        <div class="page-header">
            <div class="header-sub-title">
                <nav class="breadcrumb breadcrumb-dash">
                    <a href="/admin/dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Dashboard</a>
                    <span class="breadcrumb-item active">Thực đơn</span>
                </nav>
            </div>
            <div class=" d-flex justify-content-end text-white">
                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#createMenuModal">Thêm mới</button>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4>THỰC ĐƠN</h4>
                <?php $i = 1; ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="col-md-1">
                                    #
                                </th>
                                <th scope="col" class="col-md-2">
                                    Tên thực đơn
                                </th>
                                <th scope="col" class="col-md-7">
                                    Mô tả
                                </th>
                                <th scope="col" class="col-md-2">
                                    Tác vụ
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($menus as $menu)
                                <tr>
                                    <td>
                                        <?php
                                        echo $i;
                                        $i += 1;
                                        ?>
                                    </td>
                                    <td>{{ $menu->name }}</td>
                                    <td>{{ $menu->description }}</td>
                                    <td>
                                        <a href="#"class="btn btn-sm btn-primary" data-toggle="modal"
                                            data-target="#editModal{{ $menu->id }}"><i
                                                class="anticon anticon-edit"></i></a>
                                        <a href="#" class="btn btn-sm btn-danger" data-toggle="modal"
                                            data-target="#deleteModal{{ $menu->id }}"><i
                                                class="anticon anticon-delete"></i></a>
                                    </td>
                                </tr>
                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $menu->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="delete" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="delete">{{ $menu->name }}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('admin.menu.delete', ['id' => $menu->id]) }}"
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
                                <div class="modal fade" id="editModal{{ $menu->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="delete" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Chỉnh sửa vai trò</h5>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <i class="anticon anticon-close"></i>
                                                </button>
                                            </div>
                                            <form action="{{ route('admin.menu.update', ['id' => $menu->id]) }}"
                                                method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">

                                                    <div class="form-group">
                                                        <label for="name">Tên thực đơn</label>
                                                        <input type="text" class="form-control" id="menu-name"
                                                            name="name" value="{{ $menu->name }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="description">Mô tả</label>
                                                        <textarea class="form-control" id="menu-description" name="description">{{ $menu->description }}</textarea>
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
    <div class="modal fade" id="createMenuModal" tabindex="-1" role="dialog" aria-labelledby="create"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm thực đơn</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="anticon anticon-close"></i>
                    </button>
                </div>
                <form action="{{ route('admin.menu.create') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="menu-name">Tên thực đơn</label>
                            <input type="text" class="form-control" id="menu-name" name="name"
                                placeholder="Nhập tên thực đơn" required>
                        </div>
                        <div class="form-group">
                            <label for="menu-description">Mô tả</label>
                            <textarea class="form-control" id="menu-description" name="description"></textarea>
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
