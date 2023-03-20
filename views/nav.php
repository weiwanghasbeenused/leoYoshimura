<?
$temp = $oo->urls_to_ids(array('nav'));
$nav_id = end($temp);
$nav_item = $oo->get($nav_id);
$title = '';
$subtitle = '';
$title_pattern = '/\[(title|home)\]\((.*?)\)/';
$subtitle_pattern = '/\[(subtitle|listing)\]\((.*?)\)/';

preg_match($title_pattern, $nav_item['body'], $temp);
if(!empty($temp)){
	$title = $temp[2];
	if($temp[1] == 'home')
		$title = '<a href="/">' . $title . '</a>';
}

preg_match($subtitle_pattern, $nav_item['body'], $temp);
if(!empty($temp)){
	$subtitle = $temp[2];
	if($temp[1] == 'listing')
		$subtitle = '<a href="/list">' . $subtitle . '</a>';
}
if(!empty($title) || !empty($subtitle)) { ?>
<header id="main-header" class="container float-container">
	<h1 id="site-name-left"><?= $title; ?>, <?= $subtitle; ?></h1>
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
	#main-header > h1
	{
		font-size:1em;
	    line-height: 1.4em;
		letter-spacing:0.05em;
		word-spacing:-0.1em;
	}
	#main-header
	{
		width: 100vw;
		position: fixed;
		top: 0;
		left: 0;
		display: flex;
		box-sizing: border-box;
		padding-top: 20px;
		z-index: 1000;
		pointer-events: none;
	}
	#site-name-left
	{
		float: left;
	}
	#site-name-right
	{
		float: right;
		max-width: 40%;
		text-align: right;
	}
	@media screen and (min-width: 737px){
		#main-header
		{
			padding-left: 40px;
			padding-right: 40px;
			padding-top: 40px;
		}
	}
	@media screen and (min-width: 1025px){
		#main-header
		{
			padding-left: 100px;
			padding-right: 100px;
			padding-top: 40px;
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


