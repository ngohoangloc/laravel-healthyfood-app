@extends('admin.admin')

@section('title')
    <title>Gọi món | Healthy Food</title>
@endsection

@section('content')
    <div class="main-content">
        <div class="page-header">
            <div class="header-sub-title">
                <nav class="breadcrumb breadcrumb-dash">
                    <a href="/admin/dashboard" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Dashboard</a>
                    <span class="breadcrumb-item active">Gọi món</span>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        @foreach ($menus as $menu)
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab"
                                    href="#menu-{{ $menu->id }}-tab">{{ $menu->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="card-body">
                        <div class="tab-content m-t-15">
                            @foreach ($menus as $menu)
                                <div class="tab-pane fade" id="menu-{{ $menu->id }}-tab">
                                    <div class="row">
                                        @foreach ($menu->items as $item)
                                            <div class="col-lg-4 mb-4 mb-lg-0">
                                                <div class="bg-image rounded-6" style="height: 150px;">
                                                    <img src="{{ $item->img_path }}" class="w-100"
                                                        alt="{{ $item->name }}" />
                                                    <!-- Mask -->
                                                    <div class="mask"
                                                        style="
                                                        background: linear-gradient(
                                                            to bottom,
                                                            hsla(0, 0%, 0%, 0),
                                                            hsla(263, 80%, 20%, 0.5)
                                                        );">
                                                        <div
                                                            class="
                                                        bottom-0
                                                        d-flex
                                                        align-items-end
                                                        h-100
                                                        text-center
                                                        justify-content-center
                                                    ">
                                                            <div>
                                                                <h6 class="fw-bold text-white mb-4">{{ $item->name }}</h6>
                                                            </div>
                                                        </div>
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
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h4>ĐƠN HÀNG</h4>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
