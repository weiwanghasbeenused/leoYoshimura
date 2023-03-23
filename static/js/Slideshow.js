class Slideshow{
	constructor(container, images){
		this.container = container;
		this.images = images;
		this.captionKeywords = /[\[hidden\]|\[thumbnail\]]/ig;
		this.captionKeywordsYoutube = /\[youtube\]\((.*?)\)/i;
		this.idx = 0;
		this.elements = {};
		this.elements['wrappers'] = [];
		this.elements['pages'] = [];
		this.init();
	}
	init(){
		this.container.appendChild(this.renderSlides());
		this.container.appendChild(this.renderControls());
		this.addListeners();
	}

	renderSlides(){
		let container = document.createElement('DIV');
		container.className = 'wrapper-container';
		this.images.forEach(function(el, i){
			let match = el.caption.match(this.captionKeywordsYoutube);
			let wrapper = match ? this.renderYoutubeWrapper(el, match[1]) : this.renderFigureWrapper(el);
			if(i == 0) wrapper.classList.add('viewing');
			container.appendChild(wrapper);
			this.elements['wrappers'].push(wrapper);
		}.bind(this));
		return container;
	}
	renderYoutubeWrapper(item, iframe){
		let div = document.createElement('DIV');
		div.className = 'slide-wrapper';
		div.innerHTML = iframe;
		console.log(iframe);
		return div;
	}
	renderFigureWrapper(item){
		let figure = document.createElement('FIGURE');
		figure.className = 'slide-wrapper';
		let img = document.createElement('IMG');
		// img.className = "slideshow-image";
		img.setAttribute('src', item.src);
		figure.appendChild(img);

		return figure;
	}
	renderControls(){
		let container = document.createElement('DIV');
		container.className = 'slideshow-control-container';
		let btn_prev = document.createElement('DIV');
		btn_prev.className = 'slideshow-prev-button';
		let paging = document.createElement('DIV');
		paging.className = 'pages-container';
		if( this.images.length > 1 )
		{
			for(let i = 0; i < this.images.length; i++)
			{
				let p = document.createElement('SPAN');
				p.innerText = i + 1;
				p.className = i == this.idx ? 'page active' : 'page';
				p.setAttribute('idx', i);
				this.elements['pages'].push(p);
				p.addEventListener('click', function(event){
					this.jumpToSlide(event);
				}.bind(this));
				paging.appendChild(p);
			}
		}
		
		// let current = document.createElement('SPAN');
		// current.innerText = this.idx + 1;
		// paging.innerText = ' / ' + this.images.length;
		// paging.insertBefore(current, paging.firstChild);
		let btn_next = document.createElement('DIV');
		btn_next.className = 'slideshow-next-button';
		container.appendChild(paging);
		container.appendChild(btn_prev);
		container.appendChild(btn_next);
		this.elements['btn_prev'] = btn_prev;
		this.elements['btn_next'] = btn_next;
		// this.elements['current'] = current;
		return container;
	}
	addListeners(){
		// this.elements['btn_prev'].addEventListener('click', function(){
		// 	this.prevSlide();
		// }.bind(this));
		// this.elements['btn_next'].addEventListener('click', function(){
		// 	this.nextSlide();
		// }.bind(this));
	}
	prevSlide(){
		let old = this.idx
		// this.removeCurrentSlide();
		this.idx = this.idx == 0 ? this.images.length - 1 : this.idx - 1;
		this.switchSlide(this.idx, old);
		// this.elements['wrappers'][this.idx].classList.add('viewing');
		// this.updatePaging();
	}
	nextSlide(){
		let old = this.idx
		// this.removeCurrentSlide();
		this.idx = this.idx == this.images.length - 1 ? 0 : this.idx + 1;
		// this.elements['wrappers'][this.idx].classList.add('viewing');
		// this.updatePaging();
		this.switchSlide(this.idx, old);
	}
	jumpToSlide(event){
		let old = this.idx
		// this.removeCurrentSlide();
		this.idx = parseInt(event.target.getAttribute('idx'));
		// this.elements['wrappers'][this.idx].classList.add('viewing');
		// this.updatePaging();
		this.switchSlide(this.idx, old);
	}
	removeCurrentSlide(){
		this.elements['wrappers'][this.idx].classList.remove('viewing');
		this.elements['pages'][this.idx].classList.remove('active');
	}
	switchSlide(current, old){
		this.elements['wrappers'][old].classList.remove('viewing');
		this.elements['pages'][old].classList.remove('active');
		this.elements['wrappers'][current].classList.add('viewing');
		this.elements['pages'][current].classList.add('active');
	}
	updatePaging(){
		// this.elements['current'].innerText = this.idx + 1;

	}

}