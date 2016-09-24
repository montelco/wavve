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

    <title>Wavvve</title>

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
</head>
<body id="app-layout">
    
    @include('layouts.pagelets.navigation')

	<header class="parabox">
		<div class="container">
			<div class="row-fluid">
				<div class="col-md-4 col-md-offset-4 logo">
					So Why Us?
				</div>
			</div>
		</div>
	</header>

	<section id="intro">
		<div class="container">
			<div class="page-header">
				<h1 class="admiral-header">We get it...</h1>
				<em class="admiral-slug">...because we've been there.</em>	
			</div>
			<section class="row-fluid">
				<div class="span6 offset3">
					<!-- {{-- @yield('intro') --}} -->
					<p class="admiral-focus">You've got a business to run and having to spend valuable time and money on social media and internet marketing is pretty frustrating. You shouldn't need to be stuck on your computer or phone 24/7 to bring in new customers or bring back old ones. We know the frustration because we've had to deal with it as well.</p>
					<p class="admiral-focus">We were stuck with either expensive print ads that (let's face it) aren't part of a growing market or social media ads that cost far too much for far too little results. In the spirit of never accepting the status quo we set out to make something that was fun, simple, and could consistently deliver results.</p>
				</div>
			</section>
		</div>
	</section>
	<section id="about" class="module parallax para-1">
		<div class="container">
		<h1 class="paratit">Our Promise to Customer Service</h1>
		</div>
	</section>
	<section class="pagelet">
		<div class="container">
			<div class="page-header">
				<h1>Our Commitment...</h1>
				<em>...always there for you.</em>	
			</div>
			<section class="row-fluid">
				<div class="span6 offset3">
					<!-- {{-- @yield('aboutus') --}} -->
					<p class="admiral-focus">The magic of the Wavvve platform is its easy to use interface combined with its unrivaled customer service. You'll always have a real person on the other end making sure that you've got exactly the right solution. No more robo-directories, awful hold music...and no more foreign call centers. Just real people there to help you succeed.</p>
					<p class="admiral-focus">Our platform is constantly evolving and getting better by the day, but as a pledge to our customers we want your input. If you think that something should be easier or we should add features, rest assured that you'll always have someone to which you can speak. We're believe that the best change comes from the bottom up, so we're always listening to feedback in the pursuit of making the absolute best.</p>
				</div>
			</section>
		</div>
	</section>
	<section id="contact" class="module parallax para-3">
		<div class="container">
		<h1 class="paratit">Contact Us</h1>
		</div>
	</section>
	<section class="pagelet">
		<div class="container">
			<div class="page-header">
				<h1>Keep in Touch</h1>	
			</div>
			<section class="row-fluid">
			<!-- {{-- @yield('contactus') --}} -->
				<div class="col-md-6">
					<h3>Hit us up on social media:</h3>
					<div class="row-fluid">
			  		<div class="col-md-6">
			  			<a href="#">Facebook</a>
			  		</div>
			  		<div class="col-md-6">
			  			<a href="#">Instagram</a>
			  		</div>
					</div>
				</div>
				<div class="col-md-6">
				 	<h3>Or stay in touch the more traditional ways:</h3>
				  	<div class="row-fluid">
				  		<div class="col-md-6">
				  			<a href="mailto:steven.spinelli@atmtllc.com">Email Us</a>
				  		</div>
				  		<div class="col-md-6">
				  			<a href="#">Call Us</a>
				  		</div>
				  	</div>
				</div>
			</section>
		</div>
	</section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.22/vue.min.js"></script>

</body>
</html>