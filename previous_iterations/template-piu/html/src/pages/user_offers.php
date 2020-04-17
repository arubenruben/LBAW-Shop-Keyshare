<?php
    include_once('../templates/tpl_common.php');
    include_once('../templates/tpl_user.php');

    drawHead();
    drawHeader(1);
    drawNavbar(4,'My Offers');
    drawUserOffers('normal');
    drawFooter();
?>