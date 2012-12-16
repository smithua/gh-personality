<?php
/**
 * Plugin to replace a core class JPagination.
 * This is fired on the first system import (before
 * the onBeforeInitialise event).
 */

// no direct access
defined('_JEXEC') or die;

// Replace core JPagination with override version
include_once JPATH_ROOT.'/plugins/system/jpaginator3000/pagination.php';