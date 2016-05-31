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

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3HYENbGDpPAJcVRRkJSkc9BYhf8HVVGI&callback=initMap"
  type="text/javascript"></script>

  <div id="map"></div>

<script>
         var map;
         function initMap() {
  		// Create a map object and specify the DOM element for display.
  		map = new google.maps.Map(document.getElementById('map'), {
    	center: {lat: 39.696041, lng: -75.151347},
   	 	scrollwheel: false,
    	zoom: 8
  		});
	}
         
         //creates markers on the map
         function createMarker(place) {
           var placeLoc = place.geometry.location;
             marker = new google.maps.Marker({
             map: map2,
             position: place.geometry.location
           });
         
          //will display infowindow of given entertainment marker
           google.maps.event.addListener(marker, 'mouseover', function() {
         
                  //set up our details request
                 var detailsRequest = {placeId: place.place_id};
         
                 //preserve "this" to a variable so we can access it in the callback
                 _this = this;
                 service = new google.maps.places.PlacesService(map);
                 service.getDetails(detailsRequest, detailsCallback, _this);
           });
         
             google.maps.event.addListener(marker, 'mouseout', function() {
             infowindow.close();
           });
         
         }
         
         
    //     google.maps.event.addDomListener(window, 'load', initialize);
         
             
      </script>
@endsection