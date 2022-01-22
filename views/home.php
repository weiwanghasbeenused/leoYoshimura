<?
$deck = $item['deck'];
$body = $item['body'];
$reference_pattern = '/\(\*([0-9])*\)/';
preg_match_all($reference_pattern, $body, $matches);
$children = $oo->children($item['id']);
foreach($children as $key => $child)
{
	if( substr($child['name1'], 0, 1) == '.' || substr($child['name1'], 0, 1) == '_' )
		unset($children[$key]);
}
$children = array_values($children);

foreach($matches[0] as $key => $match)
{
	$match_idx = intval($matches[1][$key]) - 1;
	if(isset($children[$match_idx]))
	{
		$replacement = '<span class="tooltip">*<span class="tooltiptext">' . $children[$match_idx]['body'] . '</span></span>';
		$body = str_replace($match, $replacement, $body);
	}
	else
	{
		$replacement = '';
		$body = str_replace($match, $replacement, $body);
	}
}
	
?>
<main id="home-container" class="container">
	<div id="topbar"><?= $deck; ?></div>
	<div id="introtext"><?= $body; ?></div>
</main>
<style>
	#introtext{
        position:static;
        font-size: 4.5em;
        line-height: 1.2em;
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
	}

	/* Tooltip text */
	.tooltip .tooltiptext {
		visibility: hidden;
		width: 250px;
		background-color: rgba(255,255,255,0.96);
		color: black;
		padding: 3px 15px 15px;
		border: 1px solid;

		/* Position the tooltip text - see examples below! */
		position: absolute;
		z-index: 1;
	}

	/* Show the tooltip text when you mouse over the tooltip container */
	.tooltip:hover .tooltiptext {
		visibility: visible;
	}

	.tooltiptext{
		font-size:0.25em;
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

	.tooltip:hover .tooltiptext {
		opacity: 1;
	}
</style>