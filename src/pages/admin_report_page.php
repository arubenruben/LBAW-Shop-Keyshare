<?php
    include_once('../templates/tpl_common.php');
    include_once('../templates/tpl_user.php');
    include_once('../templates/tpl_admin.php');

    drawHead();
    drawHeaderAdmin(0);
    drawReportPage("admin");
?>