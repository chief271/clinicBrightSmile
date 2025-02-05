<?php

// include connect to databse file
include "connect.php";

//directories
$temp ="includes/templates/";
$css ="layout/css/";
$js ="layout/js/";
$func ="includes/function/";

include  $func . "function.php";
// include  $func . "notification.php";
include  $temp . "header.php";

// add nav bar to all pages sauf pages with noNavbar var 
if(!isset($noNavbar))
{include  $temp . "navbar.php";}

?>