<?php
	//includes
	include_once('../templates/tpl_common.php');
	include_once('../templates/tpl_about.php');
	//page
	drawHead();
	drawHeader(0);
	drawNavbar(4,'About Us');
    drawAbout();
    drawFooter();
?>