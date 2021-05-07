<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Smarthr - Bootstrap Admin Template">
    <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>Artisan HMS</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    @if(App::isLocale('fa'))

    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-rtl/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style_fa.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/farsi_fonts.css')}}">


   
    @else
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/farsi_fonts.css')}}">
    @endif

    <link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">
    
    <link href="{{asset('/css/buttons.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}">
    
    <!-- Lineawesome CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/line-awesome.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}">
    
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css"> -->

    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/vue-multiselect.min.css')}}">
    
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.10/css/bootstrap-select.css" rel="stylesheet" /> -->

    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-select.css')}}">
    
    <link rel="stylesheet" href="{{asset('assets/css/selectall.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('assets/css/material.css')}}"> --}}

    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->

    <link rel="stylesheet" href="{{asset('assets/css/font-awesome2.min.css')}}">
    
    <link rel="stylesheet" href="{{asset('dist/css/dropify.css')}}">

    <!-- <link rel="stylesheet" href="{{asset('/css/app.css')}}"> -->

    <link rel="stylesheet" href="{{asset('/css/custom.css')}}">

    <script src="{{asset('assets/js/Chart.min.js')}}"></script>



    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script> -->

</head>