<?php
include_once('../templates/tpl_common.php');
include_once('../templates/tpl_other_user.php');

drawHead(['activate_popovers.js']);
drawHeader(0);
drawOtherUserOffers();
drawFooter();
?>