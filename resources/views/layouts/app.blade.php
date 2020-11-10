<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'QinBlog') - {{ $siteConfigs['name'] }} - 测试标题跟新</title>

    <meta name="description" content="@yield('description', $siteConfigs['seo_description'] ?? '')" />
    <meta name="keyword" content="@yield('keyword', $siteConfigs['seo_keyword'] ?? '')" />

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <script src="{{ $siteConfigs['iconfont_url'] ?? '' }}"></script>

    <!-- 特殊时期网站设置成灰色 -->
    {{--<style type="text/css">--}}
        {{--html {--}}
            {{--filter: grayscale(100%);--}}
            {{---webkit-filter: grayscale(100%);--}}
            {{---moz-filter: grayscale(100%);--}}
            {{---ms-filter: grayscale(100%);--}}
            {{---o-filter: grayscale(100%);--}}
        {{--}--}}
    {{--</style>--}}
    <!-- 特殊时期网站设置成灰色 -->
</head>

<body>
<div id="app" class="{{ route_class() }}-page">

    @include('layouts._header')

    <div class="container">

        @include('shared._messages')

        @yield('content')

    </div>

    @include('layouts._footer')
</div>

<!-- Scripts -->
<script src="{{ mix('js/app.js') }}"></script>

@yield('script')
</body>

</html>
