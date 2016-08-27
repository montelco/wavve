<!DOCTYPE html>
<html lang="en">
<head>
	<title> {{$pass->title}} </title>
	<meta name="description" content="{{ $pass->primary }}" />
	<link rel="icon" type="image/jpg" href="https://s-media-cache-ak0.pinimg.com/avatars/onevillagecoffe_1428514385_140.jpg" sizes="140x140">
	<link rel="manifest" href="manifest.json">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="#528089">
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
        var value = "{{ $pass->barcode_value }}";
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
			background: #1a2128;
		}

		h1{
			color: white !important;
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
			color: #528089;
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
			    background: url({{$pass->coupon_full_background_image}}-/progressive/yes/-/scale_crop/4000x4000/center/-/blur/45/) center center fixed no-repeat !important;
			    background-size: 100%;
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
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<h1> {{$pass->title}} </h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<hr>
			</div>
		</div>
		@if(isset($pass->expiry))
			<div class="row">
				<div class="col-md-2 col-md-offset-10 col-lg-2 col-lg-offset-10 col-sm-5 col-sm-offset-7 col-xs-5 col-xs-offset-7">
					<p class="expiry">Exp: {{ $pass->expiry }}</p>
				</div>
			</div>
		@endif
		<div class="row">
			<div class="col-md-4 col-xs-6">
				<p class="field primary">{{$pass->primary_field}}</p>
			</div>
			@if(isset($pass->secondary_field))
				<div class="col-md-4 col-md-offset-4 col-xs-5 col-xs-offset-1">
					<p class="secondary field">{{$pass->secondary_field}}</p>
				</div>
			@endif
		</div>
		<div class="row">
			<div class="col-md-4 col-md-offset-4 centred">
				<div id="bcRender"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4 col-sm-4 col-sm-offset-4 col-xs-6 col-xs-offset-3 centred">
				@if(isset($pass->cashier_helper))
					<p id="helper-text">{{  $pass->cashier_helper }}</p>
				@endif
			</div>
		</div>
	</div>
</body>
</html>