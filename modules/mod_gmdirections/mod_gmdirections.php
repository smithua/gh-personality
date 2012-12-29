<?php
/**
 * @version      $Id$
 * @package      Google Map - Directions
 * @subpackage   mod_gmdirections
 * @copyright    Copyright (C) 2009-2012 Noxidsoft. All rights reserved.
 * @license      GNU General Public License <http://www.gnu.org/copyleft/gpl.html>
 * @author       Noxidsoft <admin@noxidsoft.com>
 */

//don't allow other scripts to grab and execute our file
defined('_JEXEC') or die();

$baseUrl = JURI::base();

$address				= $params->get( 'address' );
$height 				= $params->get( 'height' );
$width 					= $params->get( 'width' );
$zoom 					= $params->get( 'zoom' );
$marker_icon			= $params->get( 'marker_icon' );
$toggle_search 			= $params->get( 'toggle_search' );
$toggle_buttontext 		= $params->get( 'toggle_buttontext' );
$toggle_topbottom 		= $params->get( 'toggle_topbottom' );
$toggle_leftmiddleright = $params->get( 'toggle_leftmiddleright' );
$toggle_mapcontrols		= $params->get( 'toggle_mapcontrols' );
$toggle_active			= $params->get( 'toggle_active' );
$toggle_directions 		= $params->get( 'toggle_directions' );
$toggle_mode	 		= $params->get( 'toggle_mode' );
$start 					= $params->get( 'start' );
$end 					= $params->get( 'end' );
$toggle_buttondirtext 	= $params->get( 'toggle_buttondirtext' );
$mainmap 				= $params->get( 'mainmap' );
$dirheight				= $params->get( 'dirheight' );
$panelfloat				= $params->get( 'panelfloat' );
$toggle_showdironly		= $params->get( 'toggle_showdironly' );
$travel					= $params->get( 'travel' );

$moduleclass_sfx = htmlspecialchars($params->get( 'moduleclass_sfx' ));

if($toggle_active == 1) { // if the directions map has been turned ON...
	$toggle_search 		= 0;	// turn off the mainmap search widget
	$mainmap 			= 0;	// turn off the mainmap itself
}
?>

<html>
<head>
<title></title>
<jdoc:include type="head" />
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="<?php echo $baseUrl ?>modules/mod_gmdirections/css/template.css" type="text/css" />

<?php
	$document = &JFactory::getDocument();
	$document->addScript( 'http://maps.google.com/maps/api/js?sensor=false' );
	
	// only load what we need
	if($mainmap == 1) { $document->addScript( $baseUrl.'modules/mod_gmdirections/js/geocoder.js' ); }
	if($mainmap == 0 && $travel == 0) { 
		$document->addScript( $baseUrl.'modules/mod_gmdirections/js/directionsServiceDriving.js' ); 
	}
	if($mainmap == 0 && $travel == 1) { 
		$document->addScript( $baseUrl.'modules/mod_gmdirections/js/directionsServiceWalking.js' ); 
	}
	if($mainmap == 0 && $travel == 0 && $toggle_mode == 1) { 
		$document->addScript( $baseUrl.'modules/mod_gmdirections/js/directionsServiceDrivingMode1.js' ); 
	}
	if($mainmap == 0 && $travel == 1 && $toggle_mode == 1) { 
		$document->addScript( $baseUrl.'modules/mod_gmdirections/js/directionsServiceWalkingMode1.js' ); 
	}
?>
</head>

<!-- Geocode calls for the mainmap -->
<?php if($mainmap == 1) { ?>

<body onload="codeAddress()">
<div class="<?php echo $moduleclass_sfx; ?>">
<div id="wrap_map" style="width:<?php echo $width; ?>px">
	<?php if($toggle_leftmiddleright == 0) {  // position search left ?>
		<div class="map_left_pos">
			<?php
				if($toggle_topbottom == 0){
					if($toggle_search == 1){
						echo '<input id="address" type="textbox" value="'.$address.'">';
						echo '<input type="button" value="'.$toggle_buttontext.'" onclick="codeAddress()">';
					}
				}				
			?>

			<?php				
				echo '<div id="map_canvas" style="width: '.$width.'px; height: '.$height.'px;"></div>';
				echo '<input id="zoom_level" type="hidden" value="'.$zoom.'">';
				echo '<input id="address" type="hidden" value="'.$address.'">';	
				echo '<input id="marker_icon" type="hidden" value="'.$marker_icon.'">';
				echo '<input id="toggle_mapcontrols" type="hidden" value="'.$toggle_mapcontrols.'">';					
			?>

			<?php				
				if($toggle_topbottom == 1){
					if($toggle_search == 1){
						echo '<input id="address" type="textbox" value="'.$address.'">';
						echo '<input type="button" value="'.$toggle_buttontext.'" onclick="codeAddress()">';
					}
				}
			?>
		</div>
	<?php } ?>
	
	<?php if($toggle_leftmiddleright == 1) {  // position search centered ?>
		<div class="map_middle_pos">
			<?php
				if($toggle_topbottom == 0){
					if($toggle_search == 1){
						echo '<input id="address" type="textbox" value="'.$address.'">';
						echo '<input type="button" value="'.$toggle_buttontext.'" onclick="codeAddress()">';
					}
				}				
			?>

			<?php				
				echo '<div id="map_canvas" style="width: '.$width.'px; height: '.$height.'px;"></div>';
				echo '<input id="zoom_level" type="hidden" value="'.$zoom.'">';
				echo '<input id="address" type="hidden" value="'.$address.'">';
				echo '<input id="marker_icon" type="hidden" value="'.$marker_icon.'">';
				echo '<input id="toggle_mapcontrols" type="hidden" value="'.$toggle_mapcontrols.'">';
			?>

			<?php				
				if($toggle_topbottom == 1){
					if($toggle_search == 1){
						echo '<input id="address" type="textbox" value="'.$address.'">';
						echo '<input type="button" value="'.$toggle_buttontext.'" onclick="codeAddress()">';
					}
				}
			?>
		</div>
	<?php } ?>
	
	<?php if($toggle_leftmiddleright == 2) {  // position search right ?>
		<div class="map_right_pos">
			<?php
				if($toggle_topbottom == 0){
					if($toggle_search == 1){
						echo '<input id="address" type="textbox" value="'.$address.'">';
						echo '<input type="button" value="'.$toggle_buttontext.'" onclick="codeAddress()">';
					}
				}				
			?>

			<?php				
				echo '<div id="map_canvas" style="width: '.$width.'px; height: '.$height.'px;"></div>';
				echo '<input id="zoom_level" type="hidden" value="'.$zoom.'">';
				echo '<input id="address" type="hidden" value="'.$address.'">';
				echo '<input id="marker_icon" type="hidden" value="'.$marker_icon.'">';
				echo '<input id="toggle_mapcontrols" type="hidden" value="'.$toggle_mapcontrols.'">';
			?>

			<?php				
				if($toggle_topbottom == 1){
					if($toggle_search == 1){
						echo '<input id="address" type="textbox" value="'.$address.'">';
						echo '<input type="button" value="'.$toggle_buttontext.'" onclick="codeAddress()">';
					}
				}
			?>
		</div>
	<?php } ?>
</div>
<?php } ?>

<!-- DirectionsService calls instead of the mainmap -->
<?php if($mainmap == 0) { ?>

<body style="margin:0px; padding:0px;" onload="initialize()">
<div class="<?php echo $moduleclass_sfx; ?>">
	<?php
		if($toggle_showdironly == 1) {
	?>
	
		<strong>Start (A): </strong><input type="text" id="start" value="<?php echo $start; ?>"/>
		<strong>End (B): </strong><input type="text" id="end" value="<?php echo $end; ?>"/>

		<input type="submit" value="<?php echo $toggle_buttondirtext; ?>" onclick="calcRoute();" />

		<input id="zoom_level" type="hidden" value="<?php echo $zoom; ?>">
		<input id="address" type="hidden" value="<?php echo $address; ?>">

		<?php 
			if($panelfloat == 0) { 
				echo '<div><div id="map_canvas" style="float:right;width:70%;height:'.$dirheight.'px;"></div>';
				echo '<div id="directionsPanel" style="float:left;width:30%;height 100%;"></div>';
			}
			
			if ($panelfloat == 1) {
				echo '<div><div id="map_canvas" style="float:left;width:70%;height:'.$dirheight.'px;"></div>';
				echo '<div id="directionsPanel" style="float:right;width:30%;height 100%;"></div>';
			}

			if ($panelfloat == 2) {
				echo '<div><div id="map_canvas" style="float:left;width:100%;height:'.$dirheight.'px;"></div>';
			} 
		?>
	<?php } ?>
	
	<?php
		if($toggle_showdironly == 0) {
	?>
	
		<table border="0">
			<tr>
				<td><strong>Start (A): </strong></td>
				<td><input type="text" id="start" value="<?php echo $start; ?>"/></td>
			</tr>
			<tr>
				<td><strong>End (B): </strong></td>
				<td><input type="text" id="end" value="<?php echo $end; ?>"/></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="<?php echo $toggle_buttondirtext; ?>" onclick="calcRoute();" /></td>
			</tr>
		</table>

		<input id="zoom_level" type="hidden" value="<?php echo $zoom; ?>">
		<input id="address" type="hidden" value="<?php echo $address; ?>">

		<?php 
			echo '<div><div id="map_canvas" style="float:right;width:0%;height:0px;"></div>';
			echo '<div id="directionsPanel" style="float:left;width:100%;height 100%;"></div>';
		?>
	<?php } ?>
<?php } ?>
</div>

</body>
</html>

