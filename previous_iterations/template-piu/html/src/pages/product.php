<?php
	//includes
	include_once('../templates/tpl_common.php');
	include_once('../templates/tpl_product.php');
	include_once("../templates/tpl_feedback.php");
	//page
	drawHead(['activate_popovers.js']);
	drawHeader(0);
	drawNavbar(4,'Product');
	drawProduct();
	drawFooter();
?>