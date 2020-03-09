<?php
include_once('../templates/tpl_common.php');
include_once('../templates/tpl_products_list.php');

drawHead();
drawHeader(0);
drawNavbar(0,'Search Results');
drawProductList();
drawFooter();
