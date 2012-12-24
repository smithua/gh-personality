/**
 * @version      $Id$
 * @package      Google Map - Directions
 * @subpackage   mod_gmdirections
 * @copyright    Copyright (C) 2009-2012 Noxidsoft. All rights reserved.
 * @license      GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @author       Noxidsoft <admin@noxidsoft.com>
 */

var geocoder;
var map;

function getBaseURL() {
   var url = location.href;  // entire url including querystring - also: window.location.href;
   var baseURL = url.substring(0, url.indexOf('/', 14));
   var isMSIE = /*@cc_on!@*/0;

   if (baseURL.indexOf('http://localhost') != -1) {
     // Base Url for localhost
     var url = location.href;  // window.location.href;
     var pathname = location.pathname;  // window.location.pathname;
     var index1 = url.indexOf(pathname);
     var index2 = url.indexOf("/", index1 + 1);
     
     var baseLocalUrl = url.substr(0, index2);

     return baseLocalUrl + "/";
   } else {
     // Root Url for domain name
     return baseURL + "/";
   }
}
	
function codeAddress() {
	var toggle_mapcontrols = document.getElementById("toggle_mapcontrols").value;
	geocoder = new google.maps.Geocoder();
	
	if (toggle_mapcontrols == 0) {
		var myOptions = {
			navigationControl: false,
			mapTypeControl: false,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}
	} else {
		var myOptions = {
			mapTypeControl: true,
			mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}
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
	var contentString = address;
	
	var infowindow = new google.maps.InfoWindow({
		content: contentString
	});
	
	var marker_icon = document.getElementById("marker_icon").value;
	
	var base = getBaseURL(); // get the base URL only once then share
	
	if (marker_icon == 0) {
		var image = base + 'modules/mod_gmdirections/images/yellow.png';
	}
	if (marker_icon == 1) {
		var image = base + 'modules/mod_gmdirections/images/green.png';
	}
	if (marker_icon == 2) {
		var image = base + 'modules/mod_gmdirections/images/blue.png';
	}
	if (marker_icon == 3) {
		var image = base + 'modules/mod_gmdirections/images/black.png';
	}
	if (marker_icon == 4) {
		var image = base + 'modules/mod_gmdirections/images/home.png';
	}
	if (marker_icon == 5) {
		var image = base + 'modules/mod_gmdirections/images/university.png';
	}
	if (marker_icon == 6) {
		var image = base + 'modules/mod_gmdirections/images/school.png';
	}
	if (marker_icon == 7) {
		var image = base + 'modules/mod_gmdirections/images/parking.png';
	}
	if (marker_icon == 8) {
		var image = base + 'modules/mod_gmdirections/images/info.png';
	}
	if (marker_icon == 9) {
		var image = base + 'modules/mod_gmdirections/images/conference.png';
	}
	if (marker_icon == 10) {
		var image = base + 'modules/mod_gmdirections/images/church.png';
	}
	if (marker_icon == 11) {
		var image = base + 'modules/mod_gmdirections/images/bookstore.png';
	}

	geocoder.geocode( { address: address}, function(results, status) {
	  if (status == google.maps.GeocoderStatus.OK && results.length) {
		// You should always check that a result was returned, as it is
		// possible to return an empty results object.
		if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
		  map.setCenter(results[0].geometry.location);
		  
		  var marker = new google.maps.Marker({
			  position: results[0].geometry.location,
			  map: map,
			  title:address,
			  icon: image
		  });
		  google.maps.event.addListener(marker, 'click', function() {
			infowindow.open(map,marker);
		  });
		}        
	  } else {
		alert("Geocode was unsuccessful due to: " + status);
	  }
	});
}