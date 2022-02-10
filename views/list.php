<?
$children = $oo->children(0);
foreach($children as $key => $child)
{
	if( substr($child['name1'], 0, 1) == '.' || substr($child['name1'], 0, 1) == '_' )
		unset($children[$key]);
}
$children = array_reverse(array_values($children));

if($uri[1] == 'list') {
	?><div id="list-container" class="container"><?
}
?><div id="list-wrapper" class=""><?
foreach($children as $child)
{
	$c_title = $child['name1'];
	$c_media = $oo->media($child['id']);
	$c_thumbnail = '';
	$c_url = '/' . $child['url'];
	if(!empty($c_media))
	{
		foreach($c_media as $m)
		{
			if(strpos($m['caption'], '[thumbnail]') !== false)
				$c_thumbnail = m_url($m);
		}

		if( empty($c_thumbnail) )
			$c_thumbnail = m_url($c_media[0]);
	}
	?><div class="list-item"><a class="list-item-link" href="<?= $c_url; ?>"><?= empty( $c_thumbnail ) ? '' : '<div class="list-item-thumbnail-wrapper"><div class="list-item-thumbnail" style="background-image:url('.$c_thumbnail.')" ></div></div>'; ?><h2 class="list-item-title"><?= $c_title; ?></h2></a></div><?
}


?></div>
<?
if($uri[1] == 'list') {
	?></div><?
}
?>
<style>
	#list-wrapper
	{
		position: relative;
		width: calc(100% + 20px);
		left: -10px;
		margin-top: 40px;
	}
	.list-item
	{
		box-sizing: border-box;
		display: inline-block;
		width: 50%;
		padding: 0 10px;
		margin-bottom: 30px;
		vertical-align: top;
	}
	.list-item-title
	{
		font-size: 14px;
		line-height: 1.3em;
		font-weight: 400;
		display: inline-block;
		border-bottom: 2px solid transparent;
		padding: 0 2px 2px 2px;
	}
	.list-item-thumbnail-wrapper + .list-item-title
	{
		margin-top: 10px;
	}
	.list-item-thumbnail-wrapper
	{
		position: relative;
		padding-bottom: 66%;
		overflow: hidden;
	}
	.list-item-thumbnail
	{
		position: absolute;
		width: 100%;
		height: 100%;
		background-size: cover;
	}
	.noTouchScreen .list-item-link:hover .list-item-thumbnail
	{
		transition: transform .25s;
		transform: scale(1.2);
	}
	.noTouchScreen .list-item-link:hover .list-item-title
	{
		/*font-weight: bold;*/
		border-color: #000;
	}
	.list-item-link
	{
		display: block;
		text-align: center;
	}
	@media screen and (min-width: 737px){
		.list-item
		{
			width: 33.3%;
		}
	}
	/* ==========
		 laptop
	   ========== */
	@media screen and (min-width: 1025px){
		#list-wrapper{
			/*padding-left: 90px;*/
			/*padding-right: 90px;*/
		}
		.list-item
		{
			/*width: 33.3%;*/
		}
	}
	/* ================
	 large screen
   ================ */
	@media screen and (min-width: 1500px){
		#list-wrapper{
			/*padding-left: 0;*/
			/*padding-right: 0;*/
			width: 1320px;
		}
		.list-item
		{
			width: 25%;
		}
	}
</style>