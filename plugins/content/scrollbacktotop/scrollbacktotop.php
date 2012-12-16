<?php
/**
 * @version		$Id: scrollbacktotop 2011-01-20 $
 * @package		Joomla
 * @subpackage	Content
 * @copyright	Copyright (C) 2006 - 2011
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');

/**
 * Example Content Plugin
 *
 * @package		Joomla
 * @subpackage	Content
 * @since		1.5
 */
  
class plgContentScrollBackToTop extends JPlugin
{
	public function onContentBeforeDisplay($context, &$article, &$params)
	{
		if (strpos($context,'com_content') !== false || $context == 'text')
		{
			$app = JFactory::getApplication();
			
			$plugin =& JPluginHelper::getPlugin('content', 'scrollbacktotop');
			
			$pluginParams = $this->params;
			
			$type       = $pluginParams->get('sbtt_typ', 2);
			
			$havejQuery = $pluginParams->get('sbtt_hav', 0);
			
			$useMain  = $pluginParams->get('sbtt_main', '0');
			
			$speed = $pluginParams->get('sbtt_speed', 'slow');
			
			$pref = '';
			
			if (!$havejQuery) $pref = $this->getjQuery($speed);
			
			if ($useMain == '0' && $_SERVER['REQUEST_URI'] == '/') {  return; }
			
			$text = (isset($article->text)) ? $article->text : $article->introtext;

			if ( $type == '0' ) 
			{
				$text = $this->sbttPermalink().$text.$pref;
			} 
			else
			if ( $type == '1' ) 
			{
				$text = $text.$this->sbttPermalink().$pref;
			} 
			else
			{
				$text = $text.$this->sbttFixedPermalink().$pref;
			}
			
			if (isset($article->text))
			{
				$article->text = $text;
			} else
			{
				$article->introtext = $text;
			}
			
		}
		return '';
	}

	public function sbttPermalink()
	{
		$out = '<a href="#main" class="backtotop"><img src="/plugins/content/scrollbacktotop/top.png" alt="scroll back to top" border="0" /></a>';

		return $out;
	}

	public function sbttFixedPermalink()
	{
		$out = '<a href="#main" class="backtotop" style="position: fixed; bottom:0px; right:0px;"><img src="/plugins/content/scrollbacktotop/top.png" alt="scroll back to top" border="0" /></a>';

		return $out;
	}

	public function getjQuery($speed = 'slow')
	{
		return "<!-- Include jQuery -->
	<script src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js\" type=\"text/javascript\" charset=\"utf-8\"></script>

	<script type=\"text/javascript\" charset=\"utf-8\">
		   
		//Click event handler for any anchor that has an href that ends in top
		  $('a.backtotop').click(function() {
		   
			//Animates scroll to the top of the page...and take 1 second to do it.
			  $('html, body').animate({ scrollTop:0 }, '{$speed}');
	   
			//return false to prevent the default action of the anchor tag when clicked.
			  return false;
	 
		  });
	</script>";
	}

}