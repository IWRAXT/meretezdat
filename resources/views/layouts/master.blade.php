<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Méretezd át! - Kép átméretezés programok nélkül</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    {{--CSRF Token--}}
    <meta name="csrf-token" content="{{csrf_token()}}">
    {{--Syles--}}
    <link rel="stylesheet" href="{{asset("css/app.css")}}">
    <link rel="stylesheet" href="{{asset("css/photo.css")}}">
    {{--    <link href="{{ asset('../css/bootstrap.min.css') }}" rel="stylesheet">--}}
    {{--Dropzone--}}
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css">--}}
</head>
<body>
@include('layouts.header')

@if (session('success'))
    <div class="col-mg-6 alert alert-success">
        {{session('success')}}
    </div>
@endif
<div class="container flex-center">
    <div class="row">
        @yield('content')
    </div>
</div>

@include('layouts.footer')
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>--}}
<!-- Include all compiled plugins (below), or include individual files as needed -->
{{--<script src="{{asset('../js/app.js')}}"></script>--}}
{{--<script src="{{ asset('../js/bootstrap.min.js') }}"></script>--}}
{{--DropZone--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>--}}
</body>
</html>