class Slideshow{
	constructor(container, images){
		this.container = container;
		this.images = images;
		this.captionKeywords = /[\[hidden\]|\[thumbnail\]']/g;
		this.idx = 0;
		this.elements = {};
		this.elements['figures'] = [];
		this.init();
	}
	init(){
		this.container.appendChild(this.renderFigures());
		this.container.appendChild(this.renderControls());
		this.addListeners();
	}

	renderFigures(){
		let container = document.createElement('DIV');
		container.className = 'figure-container';
		this.images.forEach(function(el, i){
			let figure_class = i == 0 ?   "slideshow-figure viewing" : "slideshow-figure";
			let figure = document.createElement('FIGURE');
			figure.className = figure_class;
			let img = document.createElement('IMG');
			img.className = "slideshow-image";
			img.setAttribute('src', el.src);
			figure.appendChild(img);
			container.appendChild(figure);
			this.elements['figures'].push(figure);
		}.bind(this));
		return container;
	}
	renderControls(){
		let container = document.createElement('DIV');
		container.className = 'slideshow-control-container';
		let btn_prev = document.createElement('DIV');
		btn_prev.className = 'slideshow-prev-button';
		let paging = document.createElement('DIV');
		let current = document.createElement('SPAN');
		current.innerText = this.idx + 1;
		paging.innerText = ' / ' + this.images.length;
		paging.insertBefore(current, paging.firstChild);
		let btn_next = document.createElement('DIV');
		btn_next.className = 'slideshow-next-button';
		container.appendChild(btn_prev);
		container.appendChild(paging);
		container.appendChild(btn_next);
		this.elements['btn_prev'] = btn_prev;
		this.elements['btn_next'] = btn_next;
		this.elements['current'] = current;
		return container;
	}
	addListeners(){
		this.elements['btn_prev'].addEventListener('click', function(){
			this.prevSlide();
		}.bind(this));
		this.elements['btn_next'].addEventListener('click', function(){
			this.nextSlide();
		}.bind(this));
	}
	prevSlide(){
		this.elements['figures'][this.idx].classList.remove('viewing');
		this.idx = this.idx == 0 ? this.images.length - 1 : this.idx - 1;
		this.elements['figures'][this.idx].classList.add('viewing');
		this.updatePaging();
	}
	nextSlide(){
		this.elements['figures'][this.idx].classList.remove('viewing');
		this.idx = this.idx == this.images.length - 1 ? 0 : this.idx + 1;
		this.elements['figures'][this.idx].classList.add('viewing');
		this.updatePaging();
	}
	updatePaging(){
		this.elements['current'].innerText = this.idx + 1;
	}

}