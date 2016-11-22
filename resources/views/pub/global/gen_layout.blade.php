<?php
	if(!isset($_COOKIE['wid'])) {
		setcookie('wid', str_random(36), time() + (60 * 60 * 24 * 365 * 5));
		header("Refresh:0");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>@yield('title')</title>
	<meta name="description" content=@yield('meta_description')/>
	
	<link rel="manifest" href="manifest.json">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="theme-color" content=@yield('theme-color')>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>
	<script src="https://code.jquery.com/jquery-latest.min.js"></script>
	<script src="https://www.jqueryscript.net/demo/Simple-jQuery-Based-Barcode-Generator-Barcode/jquery-barcode.js"></script>
	<script>
    	function generateBarcode(){
        var value = @yield('barcode_value')
        var btype = "datamatrix";
        var renderer = "svg";
        
    var quietZone = false;
        var settings = {
          output:renderer,
          bgColor: "#FFFFFF",
          color: "#000000",
          barWidth: "1",
          barHeight: "50",
          moduleSize: "10",
          posX: "0",
          posY: "0",
          addQuietZone: true
        };
          value = {code:value, rect: false};
          $("#bcRender").html("").show().barcode(value, btype, settings);
      }
      
      $(function(){
        generateBarcode();
      });
	</script>
	<style>
		p{
			padding-left: 1vw;
			padding-right: 1vw;
		}

		@media(min-width: 768px){
			#mainLayout{
				margin-left: auto;
				margin-right: auto;
				margin-top: 4vh;
				text-shadow: 0px 0px 3px rgba(0, 0, 0, 0.25);
				-webkit-border-radius: 5px;
				-moz-border-radius: 5px;
				border-radius: 5px;
				background: @yield('bg-defaults');
				overflow-x: hidden;
				height: 80vh;
				min-height: 575px;
				min-width: 440px;
				max-height: 575px;
				max-width: 475px;
				width: 35vw;
				-webkit-box-shadow: 0px 8px 21px 0px rgba(0,0,0,0.19);
				-moz-box-shadow: 0px 8px 21px 0px rgba(0,0,0,0.19);
				box-shadow: 0px 8px 21px 0px rgba(0,0,0,0.19);
			}
			p.field{
				color: white;
				font-size: 0.8em;
			}
		}
		@media(max-width: 767px){
			body{
				overflow-y: hidden;
			}
			#mainLayout{
				margin-left: auto;
				margin-right: auto;
				text-shadow: 0px 0px 3px rgba(0, 0, 0, 0.25);
				background: @yield('bg-defaults');
				overflow-x: hidden;
				height: 100vh;
				min-height: 470px;
				width: 100vw;
			}
			p.field{
				color: white;
				font-size: 1.1em;
			}
			.watermark{
				font-size: 0.6em;
				color: white;
				text-align: right;
				right: 2em;
				position: absolute;
				bottom: 2em;
				padding-right: 2em;
			}
		}
		h1,h2,h3{
			color: @yield('header-colour') !important;
			text-align: center;
		}
		p{
			padding-top: 0.5em;
			font-size: 1.1em;
		}
		.expiry{
			color: @yield('accent-colour');
		}
		#bcRender{
			margin-left: auto;
			margin-right: auto;
		}
		#helper-text{
			text-align: center;
			margin-left: auto;
			margin-right: auto;
			color: white !important;
			font-size: 0.8em !important;
		}

		.strip_bg{
			@if(isset($pass->strip_background_image))
			    background: url({{$pass->strip_background_image}}-/progressive/yes/-/scale_crop/600x800/center/-/blur/45/) center center no-repeat;
			    background-size: cover;
		    @endif
		}
		.secondary, .expiry{
			text-align: right;
		}

		.expiry{
			padding-right: 1em;
		}
		@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi){ 
		   #mainLayout{
			    height: 100%;
			    transition: all 0.5s ease;
			    -webkit-transition: all 0.5s ease;
			    -moz-transition: all 0.5s ease;
			    -o-transition: all 0.5s ease;
			    -ms-transition: all 0.5s ease;
			    height: 100%;
			    width: 100%;
			    @if(isset($pass->coupon_full_background_image))
			    background: url({{$pass->coupon_full_background_image}}-/progressive/yes/-/scale_crop/1200x1600/center/-/blur/45/) center center fixed no-repeat;
			    background-size: cover;
			    @endif
			    font-weight: 400;
			    padding-bottom: 100px;
			}
		}
		@media(max-width: 767px){
			#mainLayout{
			    height: 100vh;
			    transition: all 0.5s ease;
			    -webkit-transition: all 0.5s ease;
			    -moz-transition: all 0.5s ease;
			    -o-transition: all 0.5s ease;
			    -ms-transition: all 0.5s ease;
			    width: 100vw;
			    @if(isset($pass->coupon_full_background_image))
			    background: url({{$pass->coupon_full_background_image}}-/progressive/yes/-/scale_crop/750x1000/center/-/blur/60/) center center fixed no-repeat !important;
			    background-size: 100%;
			    @endif
			    font-weight: 400;
			    padding-bottom: 100px;
			}
		}
		@media(min-width: 768px){
			.row{
				position: relative;
			}
			#mainLayout{
			    height: 100%;
			    transition: all 0.5s ease;
			    -webkit-transition: all 0.5s ease;
			    -moz-transition: all 0.5s ease;
			    -o-transition: all 0.5s ease;
			    -ms-transition: all 0.5s ease;
			    @if(isset($pass->coupon_full_background_image))
			    background: url({{$pass->coupon_full_background_image}}-/progressive/yes/-/scale_crop/600x800/center/-/blur/45/) center center fixed no-repeat !important;
			    background-size: 100%;
			    @endif
			    font-weight: 400;0.0.0.10.
			}
			.watermark{
				font-size: 0.6em;
				color: white;
				text-align: right;
				padding-right: 2em;
				position: absolute;
				bottom: 0 !important;
			}
		}
	</style>
	<div id="mainLayout">
		@yield('strip_pass_contents')
	</div>
	<?php
		use Wavvve\Visitor;
		if(isset($_COOKIE['wid'])) {
			return Visitor::create(['passes_uuid' => $pass->uuid, 'visitor_cookie' => $_COOKIE['wid']]);
		} 
	?>
</body>
</html>