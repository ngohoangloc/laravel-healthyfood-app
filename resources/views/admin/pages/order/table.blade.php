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
        <div class="card">
            <div class="card-body">
                <h4>CHỌN BÀN</h4>
                <ul class="icons-list m-b-50">
                    @foreach ($tables as $table)
                        <li>
                            @if ($table->status)
                                <a href="{{ route('admin.table.order', ['table' => $table->id]) }}">
                                    <div class="icon-wrap"><i class="fa-regular fa-couch"></i></div><span class="icon-text">
                                        {{ $table->name }} </span>
                                </a>
                            @else
                                <a href="{{ route('admin.table.order', ['table' => $table->id]) }}">
                                    <div class="icon-wrap"><i class="fa-solid fa-couch"></i></div><span class="icon-text">
                                        {{ $table->name }} </span>
                                </a>
                            @endif

                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
