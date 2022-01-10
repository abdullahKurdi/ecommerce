<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <!--  backend template static meta head  -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Ecommerce Application">
    <meta name="author" content="potato-media">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon-->
    <link rel="shortcut icon" href="{{asset('favicon-32x32.png')}}">

    <title>{{ config('app.name', 'Laravel') }} Dashboard</title>


    <!-- Fonts -->
    <!--  backend template static head  -->
    <!-- Custom fonts for this template-->
    <link href="{{asset('backend/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!--  backend template static head  -->
    <!-- Custom styles for this template-->
    <link href="{{asset('backend/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <!-- Css file for file input js plugins  -->
    <link rel="stylesheet" href="{{asset('backend/vendor/bootstrap-fileinput/css/fileinput.min.css')}}">

    <!-- Css file for summernote js plugins  -->
    <link rel="stylesheet" href="{{asset('backend/vendor/summernote/summernote-bs4.min.css')}}">

    @yield('style')

</head>
<body id="page-top">
    <div id="app">
        <div id="wrapper">
            <!--  backend template navbar in pages  -->
            @include('partial.backend.sidebar')
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
                <!-- Main Content -->
                <div id="content">
                @include('partial.backend.navbar')
                <!-- Begin Page Content -->
                    <div class="container-fluid">
                        @include('partial.backend.flash')
                        @yield('content')
                    </div>
                </div>
                @include('partial.backend.footer')
            </div>
        </div>
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        @include('partial.backend.model')
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>


    <!--  backend template static in pages  -->
    <!-- JavaScript files-->
    <!-- Bootstrap core JavaScript-->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    <script src="{{asset('backend/vendor/jquery/jquery.min.js')}}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{asset('backend/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{asset('backend/js/sb-admin-2.min.js')}}"></script>
    <!-- Custom scripts for all pages from me-->
    <script src="{{asset('backend/js/custom-js.js')}}"></script>


{{--    <!--  backend template static in pages  -->--}}
{{--    <!-- JavaScript files-->--}}
{{--    <!-- Bootstrap core JavaScript-->--}}
{{--    <script src="{{asset('backend/vendor/jquery/jquery.min.js')}}"></script>--}}
{{--    <!-- Core plugin JavaScript-->--}}
{{--    <script src="{{asset('backend/vendor/jquery-easing/jquery.easing.min.js')}}"></script>--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>--}}
{{--    <!-- Custom scripts for all pages-->--}}
{{--    <script src="{{asset('backend/js/sb-admin-2.min.js')}}"></script>--}}

    <!-- js file for file input js plugins  -->
    <script src="{{asset('backend/vendor/bootstrap-fileinput/js/plugins/piexif.min.js')}}"></script>
    <script src="{{asset('backend/vendor/bootstrap-fileinput/js/plugins/sortable.min.js')}}"></script>
    <script src="{{asset('backend/vendor/bootstrap-fileinput/js/fileinput.min.js')}}"></script>
    <script src="{{asset('backend/vendor/bootstrap-fileinput/themes/fas/theme.min.js')}}"></script>

    <!-- js file for file summernote js plugins  -->
    <script src="{{asset('backend/vendor/summernote/summernote-bs4.min.js')}}"></script>


    @yield('script')

</body>
</html>
