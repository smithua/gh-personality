/**
 * @version      $Id$
 * @package      Google Map - Directions
 * @subpackage   mod_gmdirections
 * @copyright    Copyright (C) 2009-2012 Noxidsoft. All rights reserved.
 * @license      GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @author       Noxidsoft <admin@noxidsoft.com>
 */

	var geocoder;
	var directionDisplay;
	var directionsService = new google.maps.DirectionsService();
	var map;

	function initialize() {
		geocoder = new google.maps.Geocoder();
		directionsDisplay = new google.maps.DirectionsRenderer();
		
		var myOptions = {
			mapTypeControl: true,
			mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}
		map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
		
		var zoom_level = document.getElementById("zoom_level").value;

			if(zoom_level == 0){
				map.setZoom(0);
			}
			if(zoom_level == 1){
				map.setZoom(1);
			}
			if(zoom_level == 2){
				map.setZoom(2);
			}
			if(zoom_level == 3){
				map.setZoom(3);
			}
			if(zoom_level == 4){
				map.setZoom(4);
			}
			if(zoom_level == 5){
				map.setZoom(5);
			}
			if(zoom_level == 6){
				map.setZoom(6);
			}
			if(zoom_level == 7){
				map.setZoom(7);
			}
			if(zoom_level == 8){
				map.setZoom(8);
			}
			if(zoom_level == 9){
				map.setZoom(9);
			}
			if(zoom_level == 10){
				map.setZoom(10);
			}
			if(zoom_level == 11){
				map.setZoom(11);
			}
			if(zoom_level == 12){
				map.setZoom(12);
			}
			if(zoom_level == 13){
				map.setZoom(13);
			}
			if(zoom_level == 14){
				map.setZoom(14);
			}
			if(zoom_level == 15){
				map.setZoom(15);
			}
			if(zoom_level == 16){
				map.setZoom(16);
			}
			if(zoom_level == 17){
				map.setZoom(17);
			}
			if(zoom_level == 18){
				map.setZoom(18);
			}
			if(zoom_level == 19){
				map.setZoom(19);
			}
		
			var address = document.getElementById("address").value;
			geocoder.geocode( { address: address}, function(results, status) {
			  if (status == google.maps.GeocoderStatus.OK && results.length) {
				// You should always check that a result was returned, as it is
				// possible to return an empty results object.
				if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
				  map.setCenter(results[0].geometry.location);
				  var marker = new google.maps.Marker({
					  position: results[0].geometry.location,
					  map: map
				  });
				}        
			  } else {
				alert("Geocode was unsuccessful due to: " + status);
			  }
			});
		
		directionsDisplay.setMap(map);
		directionsDisplay.setPanel(document.getElementById("directionsPanel"));
	}
		  
	function calcRoute() {
		var start = document.getElementById("start").value;
		var end = document.getElementById("end").value;
		var travel = document.getElementById("travel");
		
		var request = {
			origin:start, 
			destination:end,
			travelMode: google.maps.DirectionsTravelMode.DRIVING
		};

		directionsService.route(request, function(response, status) {
			if (status == google.maps.DirectionsStatus.OK) {
				directionsDisplay.setDirections(response);
			} else {
				alert("directionsService was unsuccessful due to: " + status);
			}
		});
	}