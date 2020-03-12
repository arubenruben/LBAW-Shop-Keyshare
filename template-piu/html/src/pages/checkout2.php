<?php
    include_once('../templates/tpl_common.php');
    include_once('../templates/tpl_checkout.php');
    include_once('../templates/tpl_feedback.php');
    include_once('../templates/tpl_cart.php');

    drawHead();
    drawHeader(0);
    drawNavbar(4,'Checkout');
    drawCheckoutSecondPage();
    drawFooter();
?>

