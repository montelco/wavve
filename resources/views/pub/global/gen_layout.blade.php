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
	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script src="http://www.jqueryscript.net/demo/Simple-jQuery-Based-Barcode-Generator-Barcode/jquery-barcode.js"></script>
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
          moduleSize: "15",
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
		body{
			text-shadow: 0px 0px 3px rgba(0, 0, 0, 0.25);
			
			background: @yield('bg-defaults');
			overflow-x: hidden;
		}

		h1{
			color: @yield('header-colour') !important;
			text-align: center;
		}
		p{
			padding-top: 1.5em;
			font-size: 1.1em;
		}
		p.field{
			color: white;
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
			    background: url({{$pass->strip_background_image}}-/progressive/yes/-/scale_crop/2000x2000/center/-/blur/45/) center center fixed no-repeat;
			    background-size: cover;
		    @endif
		}
		.secondary, .expiry{
			text-align: right;
		}
		@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi){ 
		   body{
			    height: 100%;
			    transition: all 0.5s ease;
			    -webkit-transition: all 0.5s ease;
			    -moz-transition: all 0.5s ease;
			    -o-transition: all 0.5s ease;
			    -ms-transition: all 0.5s ease;
			    height: 100%;
			    width: 100%;
			    @if(isset($pass->coupon_full_background_image))
			    background: url({{$pass->coupon_full_background_image}}-/progressive/yes/-/scale_crop/4000x4000/center/-/blur/45/) center center fixed no-repeat;
			    background-size: cover;
			    @endif
			    font-weight: 400;
			    padding-bottom: 100px;
			}
		}
		@media(max-width: 767px){
			body{
			    height: 100%;
			    transition: all 0.5s ease;
			    -webkit-transition: all 0.5s ease;
			    -moz-transition: all 0.5s ease;
			    -o-transition: all 0.5s ease;
			    -ms-transition: all 0.5s ease;
			    height: 100%;
			    width: 100%;
			    @if(isset($pass->coupon_full_background_image))
			    background: url({{$pass->coupon_full_background_image}}-/progressive/yes/-/scale_crop/1500x1500/center/-/blur/40/) center center fixed no-repeat !important;
			    background-size: 100%;
			    @endif
			    font-weight: 400;
			    padding-bottom: 100px;
			}
		}
		@media(min-width: 768px){
			body{
			    height: 100%;
			    transition: all 0.5s ease;
			    -webkit-transition: all 0.5s ease;
			    -moz-transition: all 0.5s ease;
			    -o-transition: all 0.5s ease;
			    -ms-transition: all 0.5s ease;
			    height: 100%;
			    width: 100%;
			    @if(isset($pass->coupon_full_background_image))
			    background: url({{$pass->coupon_full_background_image}}-/progressive/yes/-/scale_crop/2000x2000/center/-/blur/45/) center center fixed no-repeat !important;
			    background-size: 100%;
			    @endif
			    font-weight: 400;
			    padding-bottom: 100px;
			}
		}
	</style>
	<div class="container">
		@yield('pass_contents')
	</div>
		@yield('strip_pass_contents')
</body>
</html>