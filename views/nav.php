<?
$temp = $oo->urls_to_ids(array('nav'));
$nav_id = end($temp);
$nav_item = $oo->get($nav_id);
$title = strip_tags($nav_item['deck']);
$right = strip_tags($nav_item['body']);
$link_pattern = '/\[(.*?)\]\((.*?)\)/';
$title = preg_replace($link_pattern, '<a href="$2">$1</a>', $title);
$right = preg_replace($link_pattern, '<a href="$2">$1</a>', $right);

if(!empty($title) || !empty($right)) { ?>
<header id="main-header" class="container float-container small">
	<h1 id="site-name"><?= $title; ?></h1><div id="nav-right"><?= $right; ?></div>
</header>
<style>
	/*#nav-line
	{
		position: relative;
		flex: 1;
		margin: 0 10px;
	}
	#nav-line:after
	{
		content: '';
		display: block;
		position: absolute;
		width: 100%;
		left: 0;
		top: 6px;
		border-top: 2px solid #000;
	}*/
	#main-header
	{
	    line-height: 1.4;
		letter-spacing:0.05em;
		word-spacing:-0.1em;
	}
	#main-header
	{
		width: 100vw;
		position: fixed;
		top: 0;
		left: 0;
/*		display: flex;*/
		box-sizing: border-box;
		padding-top: 20px;
		z-index: 1000;
		pointer-events: none;
	}
	#site-name
	{
		float: left;
	}
	#nav-right
	{
		float: right;
		max-width: 40%;
		text-align: right;
		font-weight: 700;
	}
	@media screen and (min-width: 737px){
		#main-header
		{
			padding-left: 40px;
			padding-right: 40px;
			padding-top: 30px;
		}
	}
	@media screen and (min-width: 1025px){
		#main-header
		{
			padding-left: 100px;
			padding-right: 100px;
/*			padding-top: 40px;*/
		}
	}
	@media screen and (min-width: 1500px){
		#main-header
		{
			width: 1300px;
			left: 50%;
			transform: translate(-50%, 0);
		}
	}
</style>
<? }


