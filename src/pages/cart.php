<?php
	//includes
	include_once('../templates/tpl_common.php');
	include_once('../templates/tpl_cart.php');
	include_once("../templates/tpl_feedback.php");
	//page
	drawHead();
	drawHeader(0);
	drawBreadcrumb('My Cart');
	drawCart();
	drawFooter(); 
?>