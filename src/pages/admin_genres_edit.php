<?php
	//includes
	include_once('../templates/tpl_common.php');
	include_once('../templates/tpl_admin.php');
	//page
	drawHead();
	drawHeaderAdmin(0);
    drawAdminStart();
    drawAdminInterface(1);
    drawAdminTable(2);
    drawAdminEnd();
	drawAdminFooter(); 
?>