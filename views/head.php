<?
// open-records-generator
require_once('open-records-generator/config/config.php');
require_once('open-records-generator/config/url.php');

$db = db_connect("guest");
$oo = new Objects();
$mm = new Media();
$ww = new Wires();
$uu = new URL();

if($uu->id)
    $item = $oo->get($uu->id);
else if(!$uri[1])
{
    $temp = $oo->urls_to_ids(array('home'));
    $item = $oo->get(end($temp));
}
$site_name = '';

$body_class = '';
if(!$uri[1])
    $body_class .= ' home';

?><!DOCTYPE html>
<html>
<head>
	<title><? echo $site_name ;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="trigger">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="stylesheet" href="/static/style/main.css">
    
</head>
<body class = ''>
<script>
    var body = document.body;
    var wW = window.innerWidth;
    var wH = window.innerHeight;
</script>
<script type = "text/javascript" src = "/static/js/_sniffing.js"></script>
<script type = "text/javascript" src = "/static/js/_functions.js"></script>