@extends('employee.employee')

@section('title')
    <title>Gọi món | Healthy Food</title>
@endsection

@section('content')
    <div class="main-content">
        <div class="page-header">
            <div class="header-sub-title">
                <nav class="breadcrumb breadcrumb-dash">
                    <a href="/employee" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Dashboard</a>
                    <span class="breadcrumb-item active">Gọi món</span>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="card">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        @foreach ($menus as $menu)
                            <li class="nav-item">
                                <a class="nav-link <?= $menu->id == $menus[0]->id ? 'active' : '' ?>" data-toggle="tab"
                                    href="#menu-{{ $menu->id }}-tab">{{ $menu->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="card-body">
                        <div class="tab-content m-t-15">
                            @foreach ($menus as $menu)
                                <div class="tab-pane fade  <?= $menu->id == $menus[0]->id ? 'show active' : '' ?>"
                                    id="menu-{{ $menu->id }}-tab">
                                    <div class="row">
                                        @foreach ($menu->items as $item)
                                            <div class="col-lg-4 mb-4 mb-lg-0">
                                                <a href="#" class="" data-toggle="modal"
                                                    data-target="#addToCartModal-{{ $item->id }}">
                                                    <div class="bg-image rounded-6"
                                                        style="
                                                        height: 200px;
                                                        background-size: cover;
                                                        background-position: center center;
                                                        background-image: url('{{ $item->img_path }}');
                                                        ">
                                                        <div class="
                                                            bottom-0
                                                            d-flex
                                                            align-items-end
                                                            h-100
                                                            text-center
                                                            justify-content-center
                                                        "
                                                            style="background: linear-gradient(to top, rgba(0, 0, 0, 0.7), rgba(255, 255, 255, 0));">
                                                            <div>
                                                                <span
                                                                    class="fw-bold text-white"><?= number_format($item->price, 0, '', ',') ?>
                                                                    VND</span>
                                                                <h5 class="fw-bold text-white mb-4 pr-1 pl-1">
                                                                    {{ $item->name }}
                                                                </h5>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>


                                            {{-- Add To Cart Modal --}}
                                            <div class="modal fade" id="addToCartModal-{{ $item->id }}" tabindex="-1"
                                                role="dialog" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="delete">{{ $item->name }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="post"
                                                            action="{{ route('employee.table.order', ['table' => $table]) }}">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <input type="hidden" name="item_id"
                                                                        value="{{ $item->id }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="quantity">Số lượng</label>
                                                                    <input type="number" class="form-control"
                                                                        id="quantity" name="quantity"
                                                                        placeholder="Nhập số lượng">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="quantity">Số lượng</label>
                                                                    <textarea class="form-control" id="note" name="note"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default m-r-10"
                                                                    data-dismiss="modal">Huỷ</button>
                                                                <button type="submit" class="btn btn-primary"
                                                                    onclick="addToCart()">Thêm</button>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                    <div class="notification-toast top-middle" id="notification-toast"></div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="card" style="min-height: 500px;">
                    <div class="card-body">
                        <h4>ĐƠN HÀNG</h4>
                        @if ($orderDetails)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Món</th>
                                        <th scope="col">Số lượng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($orderDetails as $order_detail)
                                        <tr>
                                            <td>
                                                <?php
                                                echo $i;
                                                $i += 1;
                                                ?>
                                            </td>
                                            <td>{{ $order_detail->item->name }}</td>
                                            <td>x {{ $order_detail->total_quantity }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="modal-body">
                                <div class="modal-footer">
                                    <a href="{{ route('employee.table.payment', ['table' => $table]) }}" class="btn btn-primary">THANH TOÁN</a>
                                </div>
                            </div>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
