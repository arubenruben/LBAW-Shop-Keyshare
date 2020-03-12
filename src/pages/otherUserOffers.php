<?php
    include_once('../templates/tpl_common.php');
    include_once('../templates/tpl_other_user.php');
    include_once('../templates/tpl_feedback.php');

    drawHead(['activate_popovers.js']);
    drawHeader(0);
    drawNavbar(4,'Ruben Almeida Offers');
    drawOtherUserOffers();
    drawFooter();
?>