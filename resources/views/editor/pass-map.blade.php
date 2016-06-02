@extends('layouts.dashbase')

@include('editor.applets.latest-jquery')

@section('dashContent')
	<style>
		#page-wrapper{
			padding: 0px !important;
    		margin-top: -55px !important;
    	}
		.container-fluid{
			padding-left: 0px !important;
			padding-right: 0px !important;
		}
		#map {
        height: 100%;
        width: 100%;
      }
	</style>

<title>Store locator with customisations</title>
    <script
      src="https://maps.googleapis.com/maps/api/js?libraries=places"></script>
    <script
      src="https://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js">
    </script>
    <script src="infobubble-compiled.js"></script>
    <script src="store-locator.min.js"></script>
    <script src="medicare-static-ds.js"></script>
    <script src="custom.js"></script>
    <link rel="stylesheet" href="storelocator.css">
    <style>
      body { font-family: sans-serif; }
      #map-canvas, #panel { height: 500px; }
      #panel { width: 300px; float: left; margin-right: 10px; }
      #panel .feature-filter label { width: 130px; }
      p.attribution, p.attribution a { color: #666; }
      .store .hours { color: grey; }
    </style>
  </head>
  <body>
    <h1>Medicare offices</h1>
    <div id="panel"></div>
    <div id="map-canvas"></div>
    <p class="attribution">Medicare location data from <a href="http://data.gov.au/66">data.gov.au</a>, licensed under <a href="http://creativecommons.org/licenses/by/2.5/au/">CC-BY 2.5</a></p>
  </body>
@endsection