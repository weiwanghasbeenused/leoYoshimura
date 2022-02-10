<?
	$container_name = $uri[1];
	$media = $oo->media($item['id']);
	$thumbnail = '';
	$body = $item['body'];

	if(!empty($media))
	{
		foreach($media as $m)
		{
			if(strpos($m['caption'], '[thumbnail]') !== false)
				$thumbnail = m_url($m);
		}

		if( empty($thumbnail) )
			$thumbnail = m_url($media[0]);
	}
	$list = getVisibleList();
	$page_idx = false;
	if(!empty($list)){
		foreach($list as $key => $l)
		{
			if($l['id'] == $item['id'])
			{
				$page_idx = $key;
				break;
			}
		}
	}

	$previous_sibling_item = array();
	$next_sibling_item = array();
	if($page_idx === 0)
		$next_sibling_item = $list[1];
	else if($page_idx === count($list) - 1)
		$previous_sibling_item = $list[count($list) - 2];
	else
	{
		$next_sibling_item = $list[$page_idx + 1];
		$previous_sibling_item = $list[$page_idx - 1];
	}
?>
<main id="<?= $container_name ? $container_name : ''; ?>-container" class="container">
	<? if(!empty($thumbnail)){
		?><div class="detail-landing-image-wrapper"><img class="detail-landing-image" src = "<?= $thumbnail; ?>"></div><?
	} ?>
	<h1 id="detail-title"><?= $item['name1']; ?></h1>
	<section id="detail-body">
		<?= $body; ?>
	</section>
	<footer id="page-nav-container" class="float-container">
		<? if(!empty($previous_sibling_item)){
			?><div id="previous-sibling"><a id="previous-sibling-link" href="/<?= $previous_sibling_item['url']; ?>"><?= $previous_sibling_item['name1']; ?></a></div><?
		} 
		if(!empty($next_sibling_item)){
			?><div id="next-sibling"><a id="next-sibling-link" href="/<?= $next_sibling_item['url']; ?>"><?= $next_sibling_item['name1']; ?></a></div><?
		}
		?>
	</footer>
</main>


<style>
	.detail-landing-image-wrapper
	{
		margin-bottom: 15px;
	}
	#detail-title
	{
		font-size: 1em;
		margin-bottom: 30px;
		/*font-weight: normal;*/
	}
	#detail-body
	{
		font-size: 1.35em;
		line-height: 1.35em;
	}
	/* ========
		 ipad
	   ======== */
	@media screen and (min-width: 737px){
		#detail-body
		{
			width: 66%;
		}
	}
	#page-nav-container
	{
		margin-top: 60px;
		
	}
	#previous-sibling
	{
		float: left;
		position: relative;
	}
	#next-sibling
	{
		float: right;
		
	}
	#next-sibling-link
	{
		position: relative;
		padding-right: 20px;
		font-weight: 500;
	}
	#next-sibling-link:after
	{
		content: " ";
		display: block;
		height: 20px;
		width: 20px;
		position: absolute;
		border-right: 1px solid;
		border-bottom: 1px solid;
		right: 0;
		top: -4px;
		transform: rotate(-45deg);
	}
	#previous-sibling-link
	{
		position: relative;
		padding-left: 20px;
		font-weight: 500;
	}
	#previous-sibling-link:before
	{
		content: " ";
		display: block;
		height: 20px;
		width: 20px;
		position: absolute;
		border-left: 1px solid;
		border-bottom: 1px solid;
		left: 0;
		top: -4px;
		transform: rotate(45deg);
	}
</style>