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
		$replacement = '<span class="tooltip">*<span class="tooltiptext">' . $tooltiptext_content . '</span></span>';
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
	<div id="introtext"><?= $body; ?></div>
	<? require_once("views/list.php"); ?>
</main>
<style>
	#introtext{
        position:static;
        font-size: 2.75em;
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
		cursor: help;
	}

	/* Tooltip text */
	.tooltip .tooltiptext {
		visibility: hidden;
		width: 250px;
		background-color: rgba(255,255,255,0.96);
		color: black;
		padding: 20px 15px;
		border: 1px solid;
		box-sizing: border-box;
		/* Position the tooltip text - see examples below! */
		position: absolute;
		z-index: 1;
		cursor: initial;
	}

	/* Show the tooltip text when you mouse over the tooltip container */
	.noTouchScreen .tooltip:hover .tooltiptext,
	.tooltip.active .tooltiptext {
		visibility: visible;
	}

	.tooltiptext{
		font-size:.5em;
		line-height:1.4em;
		padding-top: 10px;
		letter-spacing:0.1em;
		word-spacing:-0.1em;
	}

	/*fade in */
	.tooltip .tooltiptext {
		opacity: 0;
		transition: all .3s ease-out;
	}

	.noTouchScreen .tooltip:hover .tooltiptext,
	.tooltip.active .tooltiptext
	{
		opacity: 1;
	}
	#home-container
	{
		/*padding-top: 180px;*/
	}

	/* tooltip dev  */
	#home-container[tooltip="0"] .tooltiptext
	{
		top: 40px;
	}
	#home-container[tooltip="1"] .tooltiptext
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


	/* ========
	     ipad
       ======== */
	@media screen and (min-width: 737px){
		#introtext{
	        /*position:static;*/
	        font-size: 4.5em;
	        /*line-height: 1.2em;*/
	        /*letter-spacing:0.03em;*/
	        /*word-spacing:-0.035em;*/
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
			font-size: .35em;
			line-height:1.4em;
		}
	}
	/* ========
	     ipad
       ======== */
	@media screen and (min-width: 875px){
		
		.tooltiptext
		{
			font-size: .25em;
		}
	}
	/* ==========
		 laptop
	   ========== */
	@media screen and (min-width: 1025px){
		#introtext{
	        /*position:static;*/
	        font-size: 4.5em;
	        /*line-height: 1.2em;*/
	        /*letter-spacing:0.03em;*/
	        /*word-spacing:-0.035em;*/
	    }
	    .tooltiptext{
			/*font-size:0.25em;*/
			/*line-height:1.4em;*/
		}
	}
	/* ================
		 large screen
	   ================ */
	@media screen and (min-width: 1500px){
		.container
		{
			
		}
	}
</style>
<script>
	var tooltip_version = '<?= $tooltip_version; ?>';
	var container_horizontal_padding = 20;
	var tooltiptext_width = 250;
	var tooltiptext_left_dev = -20;
	
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
			if(tooltip_version == 0){
				let this_text = el.querySelector('.tooltiptext');
				if(this_text)
				{	
					let this_left = el.offsetLeft + container_horizontal_padding;
					console.log(this_left + tooltiptext_width > wW);
					if(this_left + tooltiptext_width > wW)
						this_text.style.left =  - (this_left + tooltiptext_width - wW -container_horizontal_padding) + tooltiptext_left_dev + 'px'
				}
			}
		});
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