<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <!-- <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"> -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{asset('project_gca/font/stylesheet.css')}}">
  <link href="{{asset('project_gca/css/datepicker.css')}}" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="{{asset('project_gca/css/jquery.fancybox.min.css')}}">
  <link rel="stylesheet" href="{{asset('project_gca/css/bootstrap.min.css')}}">
 {{--  <link rel="stylesheet" href="{{asset('project_gca/css/swiper.min.css')}}"> --}}
 <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css" />
 <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <link rel="stylesheet" href="{{asset('project_gca/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('project_gca/css/media.css')}}">
  <script src="{{asset('project_gca/js/vue.js')}}"></script>
  <script src="{{asset('project_gca/js/axios.min.js')}}"></script>
  @yield('stylesheets') 
  <title>GCA</title>
  <style>
    header {
      background-repeat: no-repeat;
      background-position-x: right;
      background-size: 240px;
      background-image: url({{asset('assets/img/Ornament.png')}});
    }
  </style>
</head>

<body>
  <header>
    @include('gca.blocks.top-navbar')
    @include('gca.blocks.menu')
  </header>
  @yield('main_top_layout')
  @yield('content')
  @include('gca.blocks.footer')

  <script src="{{asset('project_gca/js/jquery.min.js')}}"></script>
  {{-- <script src="{{asset('project_gca/js/swiper.min.js')}}"></script> --}}
  <script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <script src="{{asset('project_gca/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('project_gca/js/bootstrap-datepicker.js')}}"></script>
  <script src="{{asset('project_gca/js/jquery.fancybox.min.js')}}"></script>
  <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
  <script src="https://cdn.amcharts.com/lib/4/maps.js"></script>
  <script src="https://cdn.amcharts.com/lib/4/geodata/worldLow.js"></script>
  <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
  <script src="{{asset('project_gca/js/main.js')}}"></script>

  @yield('scripts')
  @stack('scripts')
</body>

</html>