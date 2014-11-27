<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{$title}}</title>

    @section('meta')
        <base href="{{URL::to('/')}}/" />

        <link rel="shortcut icon" href="{{URL::asset('img/favicon.ico')}}" />
        <link rel="stylesheet" href="{{URL::asset('css/normalize.css')}}" />
        <link rel="stylesheet" href="{{URL::asset('css/foundation.min.css')}}" />
        <link rel="stylesheet" href="{{URL::asset('css/style.css')}}" />
        <link rel="stylesheet" href="{{URL::asset('css/ion.rangeSlider.css')}}" />
        <link rel="stylesheet" href="{{URL::asset('css/ion.rangeSlider.skinFlat.css')}}" />
        <link rel="stylesheet" href="{{URL::asset('css/font-awesome.min.css')}}" />

        <link rel="stylesheet" href="{{URL::asset('css/app.css')}}" />
        <script src="{{URL::asset('js/jquery-1.11.0.min.js')}}"></script>

        <script src="{{URL::asset('js/ion.rangeSlider.min.js')}}"></script>

        <script src="{{URL::asset('js/jquery.form.min.js')}}"></script>

        <script src="{{URL::asset('js/foundation.min.js')}}"></script>

        @if(Auth::check() && Auth::user()->admin)
            <script src="{{URL::asset('js/ckeditor/ckeditor.js')}}"></script>
            <script>
                CKEDITOR.disableAutoInline = true;
            </script>
        @endif

    @show
</head>
<body>
<div id="global-container">
    @section('header')
        {{$header}}
    @show
    <div id="content-container">
        @section('content')
            {{$content}}
        @show
    </div>
    @section('footer')
        {{$footer}}
    @show
</div>

<script src="{{URL::asset('js/app.js')}}"></script>

</body>
</html>