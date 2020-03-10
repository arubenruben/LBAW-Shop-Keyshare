<?php
	//includes
	include_once('../templates/tpl_common.php');
	include_once('../templates/tpl_contact.php');
	//page
	drawHead();
	drawHeader(0);
	drawNavbar(0,'Contact Us');
    drawContact();
    drawFooter();
?>