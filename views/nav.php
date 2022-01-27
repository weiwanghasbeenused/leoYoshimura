<header id="main-header" class="container float-container">
	<h1 id="site-name-left"><a href="/">Leo Yoshimura</a></h1><div id="nav-line"></div><h1 id="site-name-right"><a href="/list">Art Direction and Production Design</a></h1>
</header>
<style>
	#nav-line
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
	}
	#main-header > h1
	{
		font-size:1em;
	    line-height: 1.4em;
	    /*margin-bottom: 3.5em;*/
		letter-spacing:0.05em;
		word-spacing:-0.1em;
		/*font-weight: 100;*/
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
			padding-left: 80px;
			padding-right: 80px;
			padding-top: 40px;
		}
	}
	@media screen and (min-width: 1025px){
		#main-header
		{
			padding-left: 200px;
			padding-right: 200px;
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



