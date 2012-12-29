<?php
/**
 * @package Module AIM  Atomatic Image Montage for Joomla! 1.5
 * @version $Id: mod_aim.php  2011-11-25 19:23:00
 * @author Smallirons
 * @copyright (C) 2011- Smallirons   - www.smallirons.net  
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html 
**/

defined( '_JEXEC' ) or die( 'Restricted access' );
require_once (dirname(__FILE__).DS.'noimage_functions.php');
$wrapper               = 'wrapper';

$montageWidth           = trim($params->get( 'MontageWidth', '600px' ));
$montageHeight          = intval($params->get( 'MontageHeight', 400 ));

$imgsrc        = trim($params->get('imgsrc', '' )); 
$imgsrc_arr    = explode("|",$imgsrc);

$liquid = "true";
if ($params->get('liquid') == 'yes') {
$liquid = "true";
}else{
$liquid = "false";
}

$fillastrow = "true";
if ($params->get('fillastrow') == 'yes') {
$fillastrow = "true";
}else{
$fillastrow = "false";
}



$alternateheight = "true";
if ($params->get('alternateheight') == 'yes') {
$alternateheight = "true";
}else{
$alternateheight = "false";
}

$minheightrange = intval($params->get( 'minheightrange', 190 ));
$maxheightrange = intval($params->get( 'maxheightrange', 300 ));





$marginvalue   = intval($params->get( 'margin', 3 ));
$minwidth      = intval($params->get( 'minwidth', 0 ));
$opacityvalue  = trim($params->get( 'opacityvalue', '0,4' ));

$xml_data_data .= '
    <link rel="stylesheet" type="text/css" href="modules/mod_aim/css/style.css" />
	<link media="screen" rel="stylesheet" href="modules/mod_aim/css_colorbox/colorbox.css" />
';
$xml_data_data .= "\n";
$xml_data_data .= "	
	<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow&v1' rel='stylesheet' type='text/css' /> 
	<link href='http://fonts.googleapis.com/css?family=Monoton' rel='stylesheet' type='text/css' />
";

$xml_data_data .= '
    <div class="container">
  ';

$xml_data_data .= "\n";

$xml_data_data .= '<div style="width:' ;
$xml_data_data .= $montageWidth;
$xml_data_data .= ';height:';
$xml_data_data .= $montageHeight;
$xml_data_data .= 'px; overflow-y:scroll; overflow-x:hidden; margin:40px auto; background:#FFF;" >';
$xml_data_data .= "\n";

$xml_data_data .= '';

$xml_data_data .= '<div class="am-container" id="am-container">';
$xml_data_data .= "\n";

//$totalphoto = 0

////////// ////////////////////////////////

$exist_url = JURI::root();
$server_path = getCurUrl($exist_url);
//////////////////////////////////////////
foreach ($imgsrc_arr as $ik=>$curr_isrc) {
	


if (false === strpos($curr_isrc, '://')) {
     $xml_data_data .= '<a href="' . trim($server_path.$curr_isrc) . '" rel="colorbox1"><img src="' . trim($server_path.$curr_isrc) . '"></img></a>';
     $xml_data_data  .= "\n";
}else{
      $xml_data_data .= '<a href="' . trim($curr_isrc) . ' " rel="colorbox1"><img src="' . trim($curr_isrc) . '"></img></a>';
      $xml_data_data  .= "\n";
}	 

/////////////////// END ////////////////////////////
}

$xml_data_data .= '
        </div>
    </div>
</div>
';

$xml_data_data .= '
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
';
$xml_data_data .= "\n";
$xml_data_data .= '			
		<script type="text/javascript" src="';
$xml_data_data .=   trim($server_path) . 'modules/mod_aim/js/jquery.montage.min.js"></script>';		
$xml_data_data .= "\n";
$xml_data_data .= '				
		<script type="text/javascript" src="';
$xml_data_data .=   trim($server_path) . 'modules/mod_aim/colorbox/jquery.colorbox.js"></script>';		
$xml_data_data .= "\n";



$xml_data_data .= file_get_contents($server_path."modules/mod_aim/montage1.txt");
$xml_data_data .= "\n";

$xml_data_data .= "									liquid : ";
$xml_data_data .= $liquid  . ',';
$xml_data_data .= "\n";

$xml_data_data .= "									fillLastRow	: ";
$xml_data_data .= $fillastrow  . ',';
$xml_data_data .= "\n";

$xml_data_data .= "									alternateHeight	: ";
$xml_data_data .= $alternateheight  . ',';
$xml_data_data .= "\n";

if ($params->get('altheightrange', 'yes') == 'yes') {
    $xml_data_data .= "									alternateHeightRange : {"; 
	$xml_data_data .= ' min : ' . $minheightrange . ',';
    $xml_data_data .= ' max : ' . $maxheightrange . '},';
    $xml_data_data .= "\n";
}	 


if ($minwidth > 0) {
    $xml_data_data .= "									minw : "; 
    $xml_data_data .= $minwidth . ',';
    $xml_data_data .= "\n";
}	 

$xml_data_data .= "									margin : ";
$xml_data_data .= $marginvalue;
$xml_data_data .= "\n";

$xml_data_data .= file_get_contents($server_path."modules/mod_aim/montage2.txt");
$xml_data_data .= $opacityvalue;
$xml_data_data .= "});";

$xml_data_data .= file_get_contents($server_path."modules/mod_aim/montage3.txt");



echo $xml_data_data;

php?>
