<?
	$container_name = $uri[1];
	$media = $oo->media($item['id']);
	$thumbnail = '';
	$body = $item['body'];

	if(!empty($media))
	{
		foreach($media as $key => $m)
		{
			if(strpos($m['caption'], '[thumbnail]') !== false){
				$thumbnail = m_url($m);
				unset($media[$key]);
			}
			if(strpos($m['caption'], '[hidden]') !== false)
				unset($media[$key]);
		}

		if( empty($thumbnail) ){
			$thumbnail = m_url($media[0]);
			unset($media[0]);
		}
	}
	$images = array();
	foreach($media as $m){
		$images[] = array(
			'src'     => m_url($m),
			'caption' => $m['caption']
		);
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
	<? if(false){
		?><div class="detail-landing-image-wrapper">
			<img class="detail-landing-image viewing" src = "<?= $thumbnail; ?>">
			<? if(!empty($media)){
				foreach($media as $m){
					?><img class="detail-landing-image" src = "<?= m_url($m); ?>"><?
				}
			} ?>
		</div>
		<? if(!empty($media)){
			?><div id="detail-landing-image-control">
			<div id="detail-landing-image-control-prev" onClick="changeImage('prev')"></div>
			<div id="detail-landing-image-control-paging"><span id="paging-current">1</span> / <span id="paging-total"></span></div>
			<div id="detail-landing-image-control-next" onClick="changeImage('next')"></div>
		</div><?
		} 
	} ?>
	<? if(!empty($media)){
		?><div id="slideshow-container"></div><?
	} ?>
	<h1 id="detail-title"><?= $item['name1']; ?></h1>
	<section id="detail-body">
		<?= $body; ?>
	</section>
	<footer id="page-nav-container" class="float-container">
		<? if(false){
			?><div id="previous-sibling"><a id="previous-sibling-link" href="/<?= $previous_sibling_item['url']; ?>"><?= $previous_sibling_item['name1']; ?></a></div><?
		} 
		if(!empty($next_sibling_item)){
			?><div id="next-sibling"><a id="next-sibling-link" href="/<?= $next_sibling_item['url']; ?>"><?= $next_sibling_item['name1']; ?></a></div><?
		}
		?>
	</footer>
</main>
<style>
	.slideshow-figure
	{
		margin-bottom: 15px;
		padding-bottom: 66.7%;
		position: relative;
		display: none;
	}
	.slideshow-image
	{
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		object-fit: cover;
	}
	.slideshow-figure.viewing
	{
		display: block;
	}
	.slideshow-control-container
	{
		display: flex;
		justify-content: flex-end;
		align-items: center;
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
	
	#page-nav-container
	{
		margin-top: 60px;
/*		display: none;*/
	}
	#previous-sibling
	{
		float: left;
		position: relative;
	}
	#next-sibling
	{
/*		float: right;*/
		
	}
	#next-sibling-link,
	#previous-sibling-link
	{
		position: relative;
		font-weight: 500;
		text-decoration: none;
		padding: 0 2px 2px 2px;
	}
	.noTouchScreen #next-sibling-link:hover,
	.noTouchScreen #previous-sibling-link:hover
	{
		color: #000;
		border-bottom: 1px solid;
	}
	#next-sibling-link
	{
		margin-right: 20px;
	}
	#previous-sibling-link
	{
		margin-left: 20px;
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
		left: -16px;
		top: -4px;
		transform: rotate(45deg);
	}
	.noTouchScreen #next-sibling-link:hover:after
	{
		right: -24px;
		transition: right .25s;
	}
	.noTouchScreen #previous-sibling-link:hover:before
	{
		left: -24px;
		transition: left .25s;
	}

	.slideshow-prev-button,
	.slideshow-next-button
	{
		height: 12px;
		width: 12px;
		position: relative;
		padding: 5px;
		cursor: pointer;
	}
	.noTouchScreen .slideshow-prev-button:hover,
	.noTouchScreen .slideshow-next-button:hover
	{
		color: #ccc;
	}
	.slideshow-next-button:before,
	.slideshow-prev-button:before
	{
		content: " ";
		display: block;
		height: 100%;
		width: 100%;
	}
	.slideshow-next-button:before
	{		
		border-right: 1px solid;
		border-bottom: 1px solid;
		transform: rotate(-45deg);
	}
	.slideshow-prev-button:before
	{
		border-left: 1px solid;
		border-bottom: 1px solid;
		transform: rotate(45deg);
		
	}
	
	/* ========
		 ipad
	   ======== */

	@media screen and (min-width: 737px){
		#detail-body
		{
			width: 66%;
		}
		.slideshow-figure
		{
			padding-bottom: 56%;
		}
	}
</style>
<script src = "/static/js/Slideshow.js"></script>
<script>
	let sSlideshow_container = document.getElementById('slideshow-container');
	let slideshow = null;
	if(sSlideshow_container)
	{
		let images = <?= json_encode($images, true); ?>;
		slideshow = new Slideshow(sSlideshow_container, images);
	}
	
</script>