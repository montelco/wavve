<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="#91a9a9">
    <link rel="apple-touch-icon" sizes="57x57" href="/favicons/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/favicons/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/favicons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/favicons/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/favicons/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/favicons/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/favicons/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/favicons/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" href="/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicons/android-chrome-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="/favicons/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="/favicons/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/favicons/manifest.json">
    <link rel="mask-icon" href="/favicons/safari-pinned-tab.svg" color="#518089">
    <meta name="msapplication-TileColor" content="#518089">
    <meta name="msapplication-TileImage" content="/favicons/mstile-144x144.png">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <title>What is Wavvve?</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
    <link rel="stylesheet" href="{{ URL::to('/css/font.css') }}">
    <link rel="stylesheet" href="{{ URL::to('/css/master.css') }}">
    <link rel="stylesheet" href="{{ URL::to('/css/why-us.css') }}">
    <style type="text/css">
        .logo {
            font-size: 3.5em;
        }
    </style>
</head>
<body id="app-layout">
    
    @include('layouts.pagelets.navigation')

	<header class="parabox">
		<div class="container">
			<div class="row-fluid">
				<div class="col-md-4 col-md-offset-4 logo">
					What Is Wavvve Exactly?
				</div>
			</div>
		</div>
	</header>

	<section id="intro">
		<div class="container">
			<div class="page-header">
				<h1 class="admiral-header">Game Changing: That's What Wavvve Is.</h1>
				<em class="admiral-slug"></em>	
			</div>
			<section class="row-fluid">
				<div class="span6 offset3">
					<!-- {{-- @yield('intro') --}} -->
					<p class="admiral-focus">Wavvve is an all-in-one platform to reach new customers. While other companies may offer services or apps for iBeacon or Bluetooth Marketing, what they don't tell you is they sell a half-baked solution- often requiring you to already have an application or invest hundreds of thousands into developing one from scratch. And that's how we're different: We built the tools to reach as many people as possible: No. App. Required. Without needing an app, that means you can reach far more people than you ever could on any other service.</p>
					<p class="admiral-focus">With our patent pending technology we made marketing content creation a simple process. If you can make a post on social media, you have all the skills you need to make content on Wavvve. There's no coding involved, no expensive developers, no app updates, and no email chains back and forth to get changes approved. We made simple tools to make your business life free of any added stress. Schedule your posts ahead of time, create admin accounts for other staff members, and keep your customers engaged from wherever you are.</p>
				</div>
                <iframe class="centered" width="560" height="315" src="https://www.youtube.com/embed/Es3zrdthnTU" frameborder="0" allowfullscreen></iframe>
                <a href="mailto:michael.j.innaurato@atmtllc.com" class="cta">Order Now</a>
			</section>
		</div>
	</section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.22/vue.min.js"></script>

</body>
</html>