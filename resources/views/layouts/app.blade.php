<!DOCTYPE html>
<html lang="en">
<head>
    <meta property="og:title" content="Wavvve: A Better Way of Business">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.wavvve.io/">
    <meta property="og:image" content="https://www.wavvve.io/ogfblg.jpg">
    <meta property="og:description" content="Wavvve is an easy-to-use platform designed to make businesses of any size better at marketing.">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="#415d6c">
    <link rel="icon" type="image/png" href="/favicons/favicon-96x96.png" sizes="512x512">
    <link rel="mask-icon" href="/favicons/safari-pinned-tab.svg" color="#518089">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <title>Wavvve</title>

    <!-- Styles -->
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ URL::to('/css/master.css') }}">
</head>
<body id="app-layout">
    
    @include('layouts.pagelets.navigation')

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.22/vue.min.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
