<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Psychothetary</title>
    <!-- plugins:css -->
    <link href="{{ asset('/assets/vendors/mdi/css/materialdesignicons.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('/assets/vendors/css/vendor.bundle.base.css') }}" rel="stylesheet">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link href="{{ asset('/assets/css/style.css') }}" rel="stylesheet">
    <!-- End layout styles -->
    <link href="{{ asset('/assets/images/favicon.ico') }}" rel="stylesheet">
    @yield('custom_css')
    <!-- chart -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" /> -->
</head>

<body>
    <div class="container-scroller">
        @include('admin.headerMenu.index')
        <div class="container-fluid page-body-wrapper">
            @include('admin.leftMenu.index')
            @yield('content')
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('/assets/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('/assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('/assets/js/hoverable-collapse.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/assets/js/misc.js') }}"></script>
    <script src="{{ asset('/assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('/assets/js/todolist.js') }}"></script>
    <script src="{{ asset('/../../assets/js/file-upload.js') }}"></script>
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <!-- endinject -->
    <!-- Custom js for this page -->
    @yield('custom_js')
</body>

</html>