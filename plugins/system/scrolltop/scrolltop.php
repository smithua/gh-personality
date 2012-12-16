<?php
/**
 * @version SVN: $Id: builder.php 469 2011-07-29 19:03:30Z elkuku $
 * @package    ScrollTop
 * @subpackage Base
 * @author     OSTree Team {@link http://www.ostree.org}
 * @author     Created on 16-Jan-2012
 * @license    GNU/GPL
 */

//-- No direct access
defined('_JEXEC') || die('=;)');

jimport('joomla.plugin.plugin');

/**
 * System Plugin.
 *
 * @package    ScrollTop
 * @subpackage Plugin
 */
class plgSystemScrollTop extends JPlugin
{
    /**
     * Constructor
     *
     * @param object $subject The object to observe
     * @param array $config  An array that holds the plugin configuration
     */
    public function __construct(& $subject, $config)
    {
        parent::__construct($subject, $config);
    }

    public function onBeforeRender()
    {
        $app = JFactory::getApplication();
        //ignore admin
        if ($app->isAdmin())
        {
            return true;
        }

        $doc = JFactory::getDocument();

        // ignore non html
        if ($doc->getType() != 'html'){
            return true;
        }

        // ignore modal pages or other incomplete pages
        $nogo = array('component', 'raw');

        if (in_array(JRequest::getString('tmpl'), $nogo)){
            return true;
        }

        JFactory::getLanguage()->load('plg_system_scrolltop', JPATH_ADMINISTRATOR);

        $doc->addScript(JURI::root(true) . '/media/scrolltop/js/gt.min.js');

        $doc->addStyleSheet(JURI::root(true) . '/media/scrolltop/css/scrolltop.css');

        $html="<div id='scroll' onclick='goTop();return false;'></div>";
        $doc->addScriptDeclaration('document.write("'.$html.'");');
    }

}
