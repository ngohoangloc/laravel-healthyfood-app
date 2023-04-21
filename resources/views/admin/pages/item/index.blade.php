@extends('admin.admin')

@section('title')
    <title>Đồ ăn - Thức uống | Healthy Food</title>
@endsection

@section('content')
    <div class="main-content">
        <div class="page-header">
            <div class="header-sub-title">
                <nav class="breadcrumb breadcrumb-dash">
                    <a href="/admin" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Dashboard</a>
                    <span class="breadcrumb-item active">Đồ ăn - Thức uống</span>
                </nav>
            </div>
            <div class=" d-flex justify-content-end text-white">
                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#createModal">Thêm mới</button>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4>ĐỒ ĂN - THỨC UỐNG</h4>
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
                                    Tên món
                                </th>
                                <th scope="col">
                                    Giá
                                </th>
                                <th scope="col">
                                    Hình ảnh
                                </th>
                                <th scope="col">
                                    Thực đơn
                                </th>
                                <th scope="col">
                                    Tác vụ
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>
                                        <?php
                                        echo $i;
                                        $i += 1;
                                        ?>
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td><?= number_format($item->price, 0, '', ',') ?> đ</td>
                                    <td><img src="{{ $item->img_path }}" alt="" style="width: 50px"></td>
                                    <td>{{ $item->menu->name }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-success" data-toggle="modal"
                                            data-target="#detailModal{{ $item->id }}"><i
                                                class="anticon anticon-info-circle"></i></a>
                                        <a href="#"class="btn btn-sm btn-primary" data-toggle="modal"
                                            data-target="#editModal{{ $item->id }}"><i
                                                class="anticon anticon-edit"></i></a>
                                        <a href="#" class="btn btn-sm btn-danger" data-toggle="modal"
                                            data-target="#deleteModal{{ $item->id }}"><i
                                                class="anticon anticon-delete"></i></a>
                                    </td>
                                </tr>
                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="delete" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="delete">{{ $item->name }}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('admin.item.delete', ['id' => $item->id]) }}"
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
                                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="delete" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Chỉnh sửa</h5>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <i class="anticon anticon-close"></i>
                                                </button>
                                            </div>
                                            <form action="{{ route('admin.item.update', ['id' => $item->id]) }}"
                                                method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">

                                                    <div class="form-group">
                                                        <label for="name">Tên thực đơn</label>
                                                        <input type="text" class="form-control" id="item-name"
                                                            name="name" value="{{ $item->name }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="description">Mô tả</label>
                                                        <textarea class="form-control" id="item-description" name="description">{{ $item->description }}</textarea>
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
                    <h5 class="modal-title">Thêm món</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="anticon anticon-close"></i>
                    </button>
                </div>
                <form action="{{ route('admin.item.create') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="item-name">Tên thực đơn</label>
                            <input type="text" class="form-control" id="item-name" name="name"
                                placeholder="Nhập tên thực đơn..." required>
                        </div>
                        <div class="form-group">
                            <label for="item-description">Mô tả</label>
                            <textarea class="form-control" id="item-description" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="item-name">Giá</label>
                            <input type="number" class="form-control" id="item-price" name="price"
                                placeholder="Nhập vào giá bán..." required>
                        </div>
                        <div class="form-group">
                            <label for="item-name">Hình ảnh</label>
                            <input type="file" class="form-control" id="item-img_path" name="img_path" required>
                        </div>
                        <div class="form-group">
                            <label for="item-name">Thực đơn</label>
                            <select class="select form-control" name="menu_id">
                                <option value="0">Lựa chọn...</option>
                                @foreach ($menus as $menu)
                                    <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                @endforeach
                            </select>
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
