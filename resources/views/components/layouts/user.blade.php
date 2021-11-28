<html>
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible"
          content="ie=edge">
    <link href="{{ asset('css/app.css') }}"
          rel="stylesheet">
    <title>{{$title}}</title>
</head>
<body>
<x-navbar.top></x-navbar.top>
<div id="app" class="container mx-auto">
    {{$slot}}
</div>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
