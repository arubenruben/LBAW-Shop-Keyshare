<?php
	//includes
	include_once('../templates/tpl_common.php');
	include_once('../templates/tpl_contact.php');
	//page
	drawHead();
	drawHeader(0);
	drawBreadcrumb('Contact us');
    drawContact();
    drawFooter();
?>