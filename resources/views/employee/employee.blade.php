<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @yield('title')

    <!-- Favicon -->
    <link rel="shortcut icon" href={{ asset('images/logo/favicon.png') }}>

    <!-- page css -->


    <link href={{ asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }} rel="stylesheet">

    <link href={{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }} rel="stylesheet">

    <link href={{ asset('vendors/fontawesome/css/all.css') }} rel="stylesheet">

    {{-- <link rel="stylesheet" href={{ asset('vendors/mdb-ui/css/mdb.min.css') }}> --}}

    <!-- Core css -->
    <link href={{ asset('css/app.min.css') }} rel="stylesheet">

    <script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>

</head>

<body>
    <div class="app">
        <div class="layout">
            <!-- Header START -->
            @include('employee.layouts.header')
            <!-- Header END -->

            <!-- Side Nav START -->
            @include('employee.layouts.sidebar')
            <!-- Side Nav END -->

            <!-- Page Container START -->
            <div class="page-container">

                <!-- Content Wrapper START -->
                @yield('content')
                <!-- Content Wrapper END -->

                <!-- Footer START -->
                @include('employee.layouts.footer')
                <!-- Footer END -->

            </div>
            <!-- Page Container END -->

            <!-- Search Start-->
            @include('employee.layouts.search')
            <!-- Search End-->
        </div>
    </div>
    <!-- Core Vendors JS -->
    <script src={{ asset('js/vendors.min.js') }}></script>

    <!-- page js -->
    <script src={{ asset('vendors/chartjs/Chart.min.js') }}></script>

    <script src={{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}></script>

    <script src={{ asset('js/pages/dashboard-e-commerce.js') }}></script>


    <!-- Core JS -->
    <script src={{ asset('js/app.min.js') }}></script>

    @yield('js')
</body>

</html>
