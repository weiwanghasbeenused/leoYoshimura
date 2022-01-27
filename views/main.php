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
?>
<main id="<?= $container_name ? $container_name : ''; ?>-container" class="container">
	<? if(!empty($thumbnail)){
		?><div class="detail-landing-image-wrapper"><img class="detail-landing-image" src = "<?= $thumbnail; ?>"></div><?
	} ?>
	<h1 id="detail-title"><?= $item['name1']; ?></h1>
	<section id="detail-body">
		<?= $body; ?>
	</section>
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
</style>