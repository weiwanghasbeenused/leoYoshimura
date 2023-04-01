<?
$deck = $item['deck'];
$body = $item['body'];
$reference_pattern = '/\[\*\]\((.*?)\)/';
preg_match_all($reference_pattern, $body, $matches);
$children = $oo->children($item['id']);
$references = array();
$viewMore_pattern = '/\[view more\]/i';

foreach($children as $key => $child)
{
	if( substr($child['name1'], 0, 1) != '.' && substr($child['name1'], 0, 1) != '_' )
	{
		$references[$child['url']] = $child;
	}
}

foreach($matches[0] as $key => $match)
{
	$match_key = $matches[1][$key];
	if(isset($references[$match_key]))
	{
		$tooltiptext_content = preg_replace($viewMore_pattern, '<a href="/' . $references[$match_key]['url'] . '">View more</a>', $references[$match_key]['deck']);
		$replacement = '<span class="tooltip">*<span class="tooltiptext middle">' . $tooltiptext_content . '</span></span>';
		$body = str_replace($match, $replacement, $body);
	}
	else
	{
		$replacement = '';
		$body = str_replace($match, $replacement, $body);
	}
}


/* tooltip dev */
	
$tooltip_version = isset($_GET['tooltip']) ? $_GET['tooltip'] : 0;
?>
<main id="home-container" class="container" tooltip="<?= $tooltip_version; ?>">
	<div id="introtext" class="large"><?= $body; ?></div>
	<? require_once("views/list.php"); ?>
</main>
<style>
	#introtext{
        position:static;
/*        font-size: 2.75em;*/
        line-height: 1.3em;
        letter-spacing:0.03em;
        word-spacing:-0.035em;
    }
    
    .ast{
        color: red;
    }
    /* Tooltip container */
	.tooltip {
		position: relative;
		display: inline-block;
		color: red;
		cursor: default;
		letter-spacing: -0.1em;
	}

	/* Tooltip text */
	.tooltiptext {
/*		visibility: hidden;*/
		width: 250px;
		background-color: rgba(255,255,255,0.96);
		color: black;
		padding: 12px 15px;
		border: 1px solid;
		box-sizing: border-box;
		/* Position the tooltip text - see examples below! */
		position: absolute;
		z-index: 1;
		cursor: initial;
		letter-spacing: 0;
/*		font-size: .5em;*/
		line-height: 1.4em;
		padding-top: 10px;
		opacity: 0;
		top: 30px;
		left: 0;
		pointer-events: none;
	}

	.noTouchScreen .tooltip:hover .tooltiptext,
	.tooltip.active .tooltiptext
	{
		opacity: 1;
		transition: all .3s ease-out;
		pointer-events: initial;
	}
	#home-container
	{
		/*padding-top: 180px;*/
	}

	
	/*#home-container[tooltip="1"] .tooltiptext
	{
		position: fixed;
		right: 0;
		top: 0;
		height: 100vh;
		border-top: none;
		border-bottom: none;
		transform: translate(250px, 0);
		width: 90vw;
	}
	#home-container[tooltip="1"] .tooltip.active .tooltiptext
	{
		transform: translate(0, 0);
		transition: transform .5s;
	}
*/
	


	/* ========
	     ipad
       ======== */
	@media screen and (min-width: 737px){
		#introtext{
/*	        font-size: 4.5em;*/
	    }
		header
		{
			
		}
		.container
		{
			
		}
		#menu_toggle
		{
			display: none;
		}
		.tooltiptext
		{
/*			font-size: .32em;*/
			line-height:1.4em;
			width: 350px;
		}
	}
	/* ========
	     ipad
       ======== */
	@media screen and (min-width: 875px){
		
		.tooltiptext
		{
/*			font-size: .25em;*/
		}
	}
	/* ==========
		 laptop
	   ========== */
	@media screen and (min-width: 1025px){
		#introtext{
	        /*position:static;*/
/*	        font-size: 4.5em;*/
	    }
	    .tooltiptext{
	    	width: 30vw;
			/*font-size:0.25em;*/
			/*line-height:1.4em;*/
		}
	}
	/* ================
		 large screen
	   ================ */
	@media screen and (min-width: 1500px){
		.tooltiptext{
			width: 450px;
		}
	}
</style>
<script>
	var tooltip_version = '<?= $tooltip_version; ?>';
	var container_horizontal_padding = 20;
	// var tooltiptext_left_dev = -20;
	
	var sTooltip = document.getElementsByClassName('tooltip');
	if(sTooltip.length != 0)
	{
		[].forEach.call(sTooltip, function(el, i){
			if(hasTouchScreen){
				el.addEventListener('click', function(event){
					if(!el.classList.contains('active'))
					{
						let currentActive = document.querySelector('.tooltip.active');
						if(currentActive)
							currentActive.classList.remove('active');
						el.classList.add('active');
						setTimeout(function(){
							
						}, 0);
						
					}
					else
					{
						if(event.target.classList.contains('tooltip'))
							el.classList.remove('active');
					}
				});
			}
			positionTooltip(el, container_horizontal_padding);
		});
		window.addEventListener('resize', function(){
			[].forEach.call(sTooltip, function(el, i){
				positionTooltip(el, container_horizontal_padding);
			});
		});
	}

	function positionTooltip(el){
		let this_text = el.querySelector('.tooltiptext');
		if(!this_text) return;
		let windowWidth = window.innerWidth;
		let width = getTooltipWidth(windowWidth);
		let container_padding = getContainerPadding(windowWidth);
		this_text.style.left = 0;
		let right = el.offsetLeft + container_padding + width;
		if(right > windowWidth - 20)
			this_text.style.left =  - (right - (windowWidth - 20)) + 'px'
	}
	function getContainerPadding(width){
		if(width < 737) return 20;
		if(width < 1025) return 40;
		if(width < 1500) return 100;
		return (width - 1300) / 2;
	}
	function getTooltipWidth(width){
		if(width < 737) return 250;
		if(width < 1025) return 300;
		if(width < 1500) return width * 0.3;
		return 450;
	}
	if(hasTouchScreen)
	{
		document.addEventListener('click', function(e){
			// console.log('click document');
			checkTarget(e);
		});
		function checkTarget(e){
			console.log(e.target);
			if(!e.target.classList.contains('tooltiptext') && !e.target.classList.contains('tooltip'))
			{
				if(document.querySelector('.tooltip.active'))
				{
					document.querySelector('.tooltip.active').classList.remove('active');
					document.removeEventListener('click', checkTarget);
				}
			}
		}
	}
	
</script>