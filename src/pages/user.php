<?php
    include_once('../templates/tpl_common.php');
    include_once('../templates/tpl_user.php');
    include_once('../templates/tpl_feedback.php');
    
    drawHead(['activate_popovers.js']);
    drawHeader(0);
    drawBreadcrumb('My Profile');
    drawUserDetails();
    drawFooter();
?>