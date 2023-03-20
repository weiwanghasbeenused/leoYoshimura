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
	.detail-landing-image-wrapper
	{
		margin-bottom: 15px;
		padding-bottom: 66.7%;
		position: relative;
	}
	.detail-landing-image
	{
		display: none;
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		object-fit: cover;
	}
	.detail-landing-image.viewing
	{
		display: block;
	}
	#detail-landing-image-control-paging
	{
		display: inline-block;
		vertical-align: top;
		margin-top: 5px;
		/*font-size: ;*/
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
	/*#next-sibling-link:after
	{
		content: " ";
		display: block;
		height: 20px;
		width: 20px;
		position: absolute;
		border-right: 1px solid;
		border-bottom: 1px solid;
		right: -16px;
		top: -4px;
		transform: rotate(-45deg);
	}*/
	#detail-landing-image-control-next:before
	{
		content: " ";
		display: block;
		height: 100%;
		width: 100%;
		/*position: absolute;*/
		border-right: 1px solid;
		border-bottom: 1px solid;
		/*right: -16px;*/
		/*top: -4px;*/
		transform: rotate(-45deg);
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
	#detail-landing-image-control-prev:before
	{
		content: " ";
		display: block;
		height: 100%;
		width: 100%;
		/*position: absolute;*/
		border-left: 1px solid;
		border-bottom: 1px solid;
		/*right: -16px;*/
		/*top: -4px;*/
		transform: rotate(45deg);
		
	}
	#detail-landing-image-control-prev,
	#detail-landing-image-control-next
	{
		display: inline-block;
		height: 12px;
		width: 12px;
		position: relative;
		padding: 5px;
		cursor: pointer;
	}
	#detail-landing-image-control-prev:hover,
	#detail-landing-image-control-next:hover
	{
		color: #ccc;
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
	#detail-landing-image-control
	{
		float: right;
		padding-right: 5px;
		position: relative;
		top: -5px;
	}
	
	/* ========
		 ipad
	   ======== */

	@media screen and (min-width: 737px){
		#detail-body
		{
			width: 66%;
		}
		.detail-landing-image-wrapper
		{
			padding-bottom: 56%;
		}
	}
</style>
<script>
	var langing_image_index = 0;
	let sDetail_landing_image = document.getElementsByClassName('detail-landing-image');
	if(sDetail_landing_image.length > 0)
	{
		let sPaging_total = document.getElementById('paging-total');
		sPaging_total.innerText = sDetail_landing_image.length;
		let sPaging_current = document.getElementById('paging-current');
		let sDetail_landing_image_control_prev = document.getElementById('detail-landing-image-control-prev');
		let sDetail_landing_image_control_next = document.getElementById('detail-landing-image-control-next');
		function changeImage(direction = 'next'){
			sDetail_landing_image[langing_image_index].classList.remove('viewing');
			if(direction == 'next')
			{
				langing_image_index++;
				if(langing_image_index == sDetail_landing_image.length)
					langing_image_index = 0;
			}
			else if(direction == 'prev')
			{
				langing_image_index--;
				if(langing_image_index == -1)
					langing_image_index = sDetail_landing_image.length - 1;
			}
			sPaging_current.innerText = langing_image_index + 1;
			sDetail_landing_image[langing_image_index].classList.add('viewing');
		}
	}
</script>