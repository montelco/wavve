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
    <link rel="stylesheet" href="{{ URL::to('/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('/css/lato.css') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ URL::to('/css/bootstrap.min.css') }}">
</head>
<body>
	<script src="{{ URL::to('/js/jquery-latest.min.js') }}"></script>
	<script src="{{ URL::to('/js/jquery-barcode.js') }}"></script>
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
			}
			.social-bugs{
				float: right;
				position: absolute;
				right: 0.15em;
				bottom: 0;

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

		@if($pass->template_number == 2)
			.strip_bg{
				@if(isset($pass->strip_background_image))
				    background: url({{$pass->strip_background_image}}-/progressive/yes/-/scale_crop/600x800/center/-/blur/45/) center center no-repeat;
				    background-size: cover;
			    @else
			    	background: url(https://ucarecdn.com/eea63b9c-0ca6-48ec-9ed4-90def8f09ef6/-/progressive/yes/-/scale_crop/1800x600/) center center no-repeat;
				    background-size: cover;
			    @endif
			}
		@endif
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
				position: relative;
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
				position: relative;
			    height: 100%;
			    transition: all 0.5s ease;
			    -webkit-transition: all 0.5s ease;
			    -moz-transition: all 0.5s ease;
			    -o-transition: all 0.5s ease;
			    -ms-transition: all 0.5s ease;
			    @if(isset($pass->coupon_full_background_image))
			    background: url({{$pass->coupon_full_background_image}}-/progressive/yes/-/scale_crop/600x800/center/-/blur/45/) center center no-repeat !important;
			    background-size: 100%;
			    @endif
			    font-weight: 400;
			}
			.watermark{
				font-size: 0.6em;
				color: white;
				text-align: right;
			}

			.social-bugs{
				float: right;
				position: absolute;
				right: 0.15em;
				bottom: 0;
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