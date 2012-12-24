<?php defined('_JEXEC') or die('Restricted access');
	/*
	This file is part of "Fox Joomla Extensions".

	You can redistribute it and/or modify it under the terms of the GNU General Public License
	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html

	You have the freedom:
	* to use this software for both commercial and non-commercial purposes
	* to share, copy, distribute and install this software and charge for it if you wish.
	Under the following conditions:
	* You must attribute the work to the original author by leaving untouched the link "powered by",
	except if you obtain a "registerd version" http://www.fox.ra.it/forum/14-licensing/151-remove-the-backlink-powered-by-fox-contact.html

	Author: Demis Palma
	Documentation at http://www.fox.ra.it/forum/2-documentation.html
	*/

	// Set Meta Description
	if ($this->cparams->get('menu-meta_description'))
		$this->document->setDescription($this->cparams->get('menu-meta_description'));
	// Set Meta Keywords
	if ($this->cparams->get('menu-meta_keywords'))
		$this->document->setMetadata('keywords', $this->cparams->get('menu-meta_keywords'));
	// Set robots (index, follow)
	if ($this->cparams->get('robots'))
		$this->document->setMetadata('robots', $this->cparams->get('robots'));

	$wholemenu = $this->Application->getMenu();
	$activemenu = $wholemenu->getActive();
	$cid = $activemenu->id;

	echo("<a name=\"cid_$cid\"></a>");

	echo('<div class="foxcontainer' . $this->cparams->get('pageclass_sfx') . '" style="width:' . $this->cparams->get("form_width", "550") . $this->cparams->get("form_unit", "px") . ' !important;">');

	// Page Heading if needed
	if ($this->cparams->get('show_page_heading'))
		echo("<h1>" . $this->escape($this->cparams->get('page_heading')) . "</h1>" . PHP_EOL);

	// Page Subheading if needed
	$page_subheading = $this->cparams->get("page_subheading", "");
	if (!empty($page_subheading))
		echo("<h2>" . $page_subheading . "</h2>" . PHP_EOL);

	$xml = JFactory::getXML(JPATH_ADMINISTRATOR . "/components/" . $GLOBALS["com_name"] . "/" . $GLOBALS["ext_name"] . ".xml");

	/* Don't remove the following code, or you will loose system messages too, like
	"Invalid field: email" or "Your messages has been received" and so on.
	If you have problems related to language files, fix your language file instead. */
	if (count($this->messages))
	{
		echo('<ul class="fox_messages">');
		//echo("<li>" . $this->cparams->get("missing_fields_text") . "</li>");
		foreach ($this->messages as $message)
		{
			echo("<li>" . $message . "</li>");
		}
		echo("</ul>");
	}

	if (!empty($this->FormText)) { ?>
	<form enctype="multipart/form-data" id="FoxForm" name="FoxForm" class="foxform" method="post" action="<?php echo($_SERVER["REQUEST_URI"] . "#cid_" . $cid);?>">
		<!-- <?php echo("com_" . $this->_name . " " . (string)$xml->version . " " . (string)$xml->license); ?> -->
		<?php echo($this->FormText); ?>
	</form>
	<?php
	}
	echo('</div>');
?>
