class Slideshow{
	constructor(container, images, pageTitle, siblings){
		this.container = container;
		this.images = images;
		this.captionKeywords = /[\[hidden\]|\[thumbnail\]]/ig;
		this.captionKeywordsYoutube = /\[youtube\]\((.*?)\)/i;
		this.idx = 0;
		this.elements = {};
		this.elements['wrappers'] = [];
		this.elements['pages'] = [];
		this.pageTitle = pageTitle;
		this.siblings = siblings;
		this.init();
	}
	init(){
		this.slides = this.generateSlideData();
		this.container.innerHTML += this.renderSlides();
		this.container.innerHTML += this.renderInfo();
		this.prepareDOM();
		this.addListeners();
	}
	generateSlideData(){
		let output = [];
		for(let i = 0; i < this.images.length ; i++)
		{
			let img = this.images[i];
			let match = img.caption.match(this.captionKeywordsYoutube);
			let isViewing = i == 0;
			let obj = {
				"type": match ? "video" : "image",
				"src": img.src,
				"caption": img.caption,
				"symbol": match ? "video" : i + 1,
				"content": match ? this.renderYoutubeWrapper(match[1], isViewing) : this.renderFigureWrapper(img.src, isViewing)
			}
			output.push(obj);
		}
		return output;
	}
	renderSlides(){
		let output = '<div class="wrapper-container">';
		for(let i = 0; i < this.slides.length; i++)
		{
			output += this.slides[i].content;
		}
		output += '</div>';
		return output;
	}
	renderYoutubeWrapper(iframe, isViewing = false){
		let wrapperClass = isViewing ? 'slide-wrapper viewing' : 'slide-wrapper';
		let output = '<div class="'+wrapperClass+'">' + iframe + '</div>';
		return output;
	}
	renderFigureWrapper(src, isViewing = false){
		let wrapperClass = isViewing ? 'slide-wrapper viewing' : 'slide-wrapper';
		let output = '<figure class="'+wrapperClass+'"><img src="'+ src  +'"></figure>';
		console.log(output);
		return output;
	}
	renderInfo(){
		let output = '<div class="slideshow-info"><h1 id="detail-title">'+this.pageTitle+'</h1>';
		output += this.renderControls();
		output += '</div>';
		return output;

	}
	renderControls(){
		let output = '<div class="slideshow-control-container"><div class="pages-container">';
		if( this.slides.length > 1 )
		{
			for(let i = 0; i < this.slides.length; i++)
			{
				let btnClass = i == 0 ? 'page active' : 'page';
				let btn = '<span idx="'+i+'" class="'+btnClass+'">' + this.slides[i].symbol + '</span>';
				output += btn;
			}
		}
		output += '</div>';
		if(this.siblings.prev) output += '<a class="slideshow-prev-button" href="'+ this.siblings.prev["url"] +'"></a>';
		if(this.siblings.next) output += '<a class="slideshow-next-button" href="'+ this.siblings.next["url"] +'"></a>';
		output += '</div>';
		return output;
	}
	prepareDOM(){
		this.elements['wrappers'] = this.container.querySelectorAll('.slide-wrapper');
		this.elements['pages'] = this.container.querySelectorAll('.page');
	}
	addListeners(){
		for(let i = 0 ; i < this.elements['pages'].length; i++)
		{
			this.elements['pages'][i].addEventListener('click', function(event){
				console.log('yaya');
				this.jumpToSlide(event);
			}.bind(this))
		}
	}
	prevSlide(){
		let old = this.idx
		this.idx = this.idx == 0 ? this.images.length - 1 : this.idx - 1;
		this.switchSlide(this.idx, old);
	}
	nextSlide(){
		let old = this.idx
		this.idx = this.idx == this.images.length - 1 ? 0 : this.idx + 1;
		this.switchSlide(this.idx, old);
	}
	jumpToSlide(event){
		let old = this.idx
		this.idx = parseInt(event.target.getAttribute('idx'));
		console.log(this.idx, old);
		this.switchSlide(this.idx, old);
	}
	removeCurrentSlide(){
		this.elements['wrappers'][this.idx].classList.remove('viewing');
		this.elements['pages'][this.idx].classList.remove('active');
	}
	switchSlide(current, old){
		console.log();
		this.elements['wrappers'][old].classList.remove('viewing');
		this.elements['pages'][old].classList.remove('active');
		this.elements['wrappers'][current].classList.add('viewing');
		this.elements['pages'][current].classList.add('active');
	}
	updatePaging(){
		// this.elements['current'].innerText = this.idx + 1;
	}

}