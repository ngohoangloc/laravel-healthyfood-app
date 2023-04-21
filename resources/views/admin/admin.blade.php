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

    <link href={{ asset('vendors/fontawesome/css/all.css') }} rel="stylesheet">

    <link rel="stylesheet" href={{ asset('vendors/mdb-ui/css/mdb.min.css') }}>


    <!-- Core css -->
    <link href={{ asset('css/app.min.css') }} rel="stylesheet">

</head>

<body>
    <div class="app">
        <div class="layout">
            <!-- Header START -->
            @include('admin.layouts.header')
            <!-- Header END -->

            <!-- Side Nav START -->
            @include('admin.layouts.sidebar')
            <!-- Side Nav END -->

            <!-- Page Container START -->
            <div class="page-container">

                <!-- Content Wrapper START -->
                @yield('content')
                <!-- Content Wrapper END -->

                <!-- Footer START -->
                @include('admin.layouts.footer')
                <!-- Footer END -->

            </div>
            <!-- Page Container END -->

            <!-- Search Start-->
            @include('admin.layouts.search')
            <!-- Search End-->
        </div>
    </div>
    <!-- Core Vendors JS -->
    <script src={{ asset('js/vendors.min.js') }}></script>

    <!-- page js -->
    <script src={{ asset('vendors/chartjs/Chart.min.js') }}></script>
    <script src={{ asset('vendors/mdb-ui/js/mdb.min.js') }}></script>
    <script src={{ asset('js/pages/dashboard-e-commerce.js') }}></script>

    <!-- Core JS -->
    <script src={{ asset('js/app.min.js') }}></script>

    @yield('js')
</body>

</html>
