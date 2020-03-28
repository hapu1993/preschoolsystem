<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="{{asset('css/mdb.min.css')}}" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="{{asset('css/style.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(rgba(0,0,0,0.3),rgba(0,0,0,0.3)),url('./img/m687_1kx5_180307.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
    </style>

</head>






<body class="fixed-sn white-skin" style="background-color: #90caf9 blue lighten-3">

<!--Double navigation-->
@include('includes.header')
<!--/.Double navigation-->

<!--Main layout-->
@yield('content')
<!--/Main layout-->


<!--Footer-->
@include('includes.footer')
<!--/.Footer-->
<!-- SCRIPTS -->
<!-- JQuery -->
<script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="{{asset('js/bootstrap.js')}}"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="{{asset('js/mdb.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<!-- Custom scripts -->
<script>
    $(document).ready(() => {
        // SideNav Initialization
        $(".button-collapse").sideNav();

    new WOW().init();
    });
</script>


<script src="{{asset('js/custom.js')}}"></script>

</body>

</html>
