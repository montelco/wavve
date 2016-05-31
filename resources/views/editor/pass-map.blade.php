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
	</style>

<script>
         var map;
         var map2;
         var infowindow;
         var minglmarker;
         var marker;
         var details;
         var _this;
         
         function getLatLngFromAddress(city, country){
         
           var address = city +", "+ country;
           var geocoder = new google.maps.Geocoder();
         
           geocoder.geocode( { 'address': address}, function(results, status) {
         
             if (status == google.maps.GeocoderStatus.OK) {
               $('#latitude').val(results[0].geometry.location.lat());
               $('#longitude').val(results[0].geometry.location.lng());
         
             } else {
               console.log("Geocode was not successful for the following reason: " + status);
             }
           });
         }
         
         function initialize() {
         	//set the latitude and longitude variables from the location structure we received
         	var latitude = <?php echo $t_location->getLatitude();?>;
         	var longitude = <?php echo $t_location->getLongitude();?>;
             var pyrmont = new google.maps.LatLng(latitude , longitude);
         	//set the map variables
           map2 = new google.maps.Map(document.getElementById('map-canvas2'), {
             center: pyrmont,
             zoom: 15
           });
         map = new google.maps.Map(document.getElementById('map-canvas'), {
         center: pyrmont,
         zoom: 15
         });
         map.setOptions({draggable: false,
         		scrollwheel: false});
           //set request variables
           var request = {
             location: pyrmont,
             radius: 2000,
             types: ['accounting', 'airport', 'amusement_park', 'aquarium', 'art_gallery', 'atm', 'bakery', 'bank', 'bar', 'beauty_salon', 'bicycle_store', 'book_store', 'bowling_alley', 'bus_station', 'cafe', 'campground', 'car_dealer', 'car_rental', 'car_repair', 'car_wash', 'casino', 'cemetery', 'church', 'city_hall', 'clothing_store', 'convenience_store', 'courthouse', 'dentist', 'department_store', 'doctor', 'electrician', 'electronics_store', 'embassy', 'establishment', 'finance', 'fire_station', 'florist', 'food', 'funeral_home', 'furniture_store', 'gas_station', 'general_contractor', 'grocery_or_supermarket', 'gym', 'hair_care', 'hardware_store', 'health', 'hindu_temple', 'home_goods_store', 'hospital', 'insurance_agency', 'jewelry_store', 'laundry', 'lawyer', 'library', 'liquor_store', 'local_government_office', 'locksmith', 'lodging', 'meal_delivery', 'meal_takeaway', 'mosque', 'movie_rental', 'movie_theater', 'moving_company', 'museum', 'night_club', 'painter', 'park', 'parking', 'pet_store', 'pharmacy', 'physiotherapist', 'place_of_worship', 'plumber', 'police', 'post_office', 'real_estate_agency', 'restaurant', 'roofing_contractor', 'rv_park', 'school', 'shoe_store', 'shopping_mall', 'spa', 'stadium', 'storage', 'store', 'subway_station', 'synagogue', 'taxi_stand', 'train_station', 'travel_agency', 'university', 'veterinary_care', 'zoo']
           };
           //initialize infowindow
           infowindow = new google.maps.InfoWindow();
           var service = new google.maps.places.PlacesService(map);
           
           //call google api nearbySearch 
           service.nearbySearch(request, callback);
           
           //create mingl summary location marker
             minglmarker = new google.maps.Marker({
             map: map2,
             position: pyrmont,
         	icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'
           });
              minglmarker = new google.maps.Marker({
             map: map,
             position: pyrmont,
                 icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'
           });
          
           //create the info window (we can style this however we want later)
         	minglmarker.infowindow = new google.maps.InfoWindow({
         	content: '<h5><p>You Are Here</p></h5><br></br><div id="content" style="width:200px;height:100px;"></div>'
         	});
         
         	//when the marker is clicked open the infowindow
           google.maps.event.addListener(minglmarker, 'click', function() {
         	minglmarker.infowindow.open(map2, this);
         	});
         
         	//initialize panoramic view
         	var pano = null;
         	//add a listener to the infowindow of the minglmarker
         	google.maps.event.addListener(minglmarker.infowindow, 'domready', function() 
         	{
         	//initialize panoramic view bind and visibility (sanity check)
         	if (pano != null) 
         	{
         		pano.unbind("position");
         		pano.setVisible(false);
         	}
         	//set panoramic view to street-vew panorama and bind it to the "content" div
         	pano = new google.maps.StreetViewPanorama(document.getElementById("content"), 
         	{
         		//set options
         		navigationControl: true,
         		navigationControlOptions: {style: google.maps.NavigationControlStyle.ANDROID},
         		enableCloseButton: false,
         		addressControl: false,
         		linksControl: false
         	});
         	//bind to position of minglmarker and set visible 
         	pano.bindTo("position", minglmarker);
         	pano.setVisible(true);
         	});
         	
         	//when the mingl infowindow is closed, unbind and hide 
         	google.maps.event.addListener(minglmarker.infowindow, 'closeclick', function() 
         	{
         		pano.unbind("position");
         		pano.setVisible(false);
         		pano = null;
         	});
         
           
          /* google.maps.event.addListener(minglmarker, 'click', function() {
         	if (!minglmarker.open)
         		{
         			minglmarker.infowindow.setContent('<p>You Are Here</p>');
         			minglmarker.infowindow.open(map, this);
         		}
         		else{
         			minglmarker.infowindow.close();
         			marker.open = false;
         		}
           });*/
           
         }
         
         function callback(results, status) {
           if (status == google.maps.places.PlacesServiceStatus.OK) {
             for (var i = 0; i < results.length; i++) {
         		
               createMarker(results[i]);
             }
           }
         }
         
         function detailsCallback(results, status, _marker) {
           if (status == "OK")
         		{
         			details = '<h2>'+ results.name + '<br></br>' + results.formatted_address + '</h2><br></br>' + results.formatted_phone_number + '<br></br>' + results.website +  '</h2>';
         			infowindow.setContent(details);
         			infowindow.open(map2, _this);
         			if (results.formated_address != null)
         			{
         				//infowindow.setContent('<h2>'+ results.name + '<br></br>' + results.formated_address + '</h2><br></br>' + results.formatted_phone_number + '<br></br>' + results.website +  '</h2>');
         			}
         			//else {//infowindow.setContent('<h5>error!</h5>');}
         			//infowindow.open(map2, this);
         		}	
           }
         
         //test function to dump variable
         function dump(v) {
             switch (typeof v) {
                 case "object":
                     for (var i in v) {
                         console.log(i+":"+v[i]);
                     }
                     break;
                 default: //number, string, boolean, null, undefined 
                     console.log(typeof v+":"+v);
                     break;
             }
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
         
         
         google.maps.event.addDomListener(window, 'load', initialize);
         
             
      </script>
	
	<iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d12280.739879591261!2d-75.14870065!3d39.6905449!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sus!4v1462991307145" width="100%" height="730px" frameborder="0" style="border:0" allowfullscreen></iframe>
@endsection