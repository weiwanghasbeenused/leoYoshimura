<?php

$request = $_SERVER['REQUEST_URI'];
$requestclean = strtok($request,"?");
$uri = explode('/', $requestclean);


require_once("views/head.php");
// require_once("views/nav.php");

if(!$uri[1])
	require_once("views/home.php");
else
	require_once("views/main.php");

require_once("views/foot.php");

?>