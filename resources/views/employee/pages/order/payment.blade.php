@extends('employee.employee')

@section('title')
    <title>Thanh toán | Healthy Food</title>
@endsection

@section('content')
    <div class="main-content">
        <div class="page-header">
            <div class="header-sub-title">
                <nav class="breadcrumb breadcrumb-dash">
                    <a href="/employee" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Dashboard</a>
                    <span class="breadcrumb-item active">Thanh toán</span>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        HOÁ ĐƠN
                        <strong>#{{ $bill->id }}</strong>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive-sm">
                            <table class="table ">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Món</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php $i = 1; ?>
                                @foreach($orderDetails as $order_detail)
                                    <tr>
                                        <td><?php echo $i; $i += 1; ?></td>
                                        <td>{{ $order_detail->item->name }}</td>
                                        <td>{{ $order_detail->item->price }}</td>

                                        <td>{{ $order_detail->quantity }}</td>
                                        <td>{{ $order_detail->item->price * $order_detail->quantity }}</td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-sm-5 ml-auto">
                                <table class="table table-clear">
                                    <tbody>
                                    <tr>
                                        <td class="left">
                                            <strong>Subtotal</strong>
                                        </td>
                                        <td class="right">{{ $amount }}</td>
                                    </tr>
                                    <tr>
                                        <td class="left">
                                            <strong>VAT (10%)</strong>
                                        </td>
                                        <td class="right">{{ $amount * 0.1 }}</td>
                                    </tr>
                                    <tr>
                                        <td class="left">
                                            <strong>Tổng</strong>
                                        </td>
                                        <td class="right">
                                            <strong>{{$amount + $amount * 0.1 }}</strong>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-4 col-sm-5">
                                <form action="{{ route('employee.table.payment', ['table' => $table]) }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="customer-name">Họ tên</label>
                                            <input type="text" class="form-control" id="customer-name" name="name"
                                                   placeholder="Nhập tên khách hàng..." required>
                                        </div>
                                        <div class="form-group">
                                            <label for="customer-phone">Số điện thoại</label>
                                            <input type="text" class="form-control" id="customer-phone" name="phone"
                                                   placeholder="Nhập số điện thoại..." required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">XÁC NHẬN</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
