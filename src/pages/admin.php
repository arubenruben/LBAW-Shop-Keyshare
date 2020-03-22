<?php
	//includes
	include_once('../templates/tpl_common.php');
	include_once('../templates/tpl_admin.php');
    
    //page
    drawHead();
        drawHeaderAdmin();
        drawAdminStart();
            if(isset($_GET['page'])) {
                if($_GET['page'] < 0 || $_GET['page'] > 9) {
                    drawAdminInterface(0);
                }
                else {
                    drawAdminInterface(1);
                }
                drawAdminTable($_GET['page']);
            }
            else {
                drawAdminInterface(0);
                drawAdminTable();
            }
        drawAdminEnd();
	drawAdminFooter(); 
?>