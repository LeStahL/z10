import $ from 'jquery';

class Search {
	//1. describe and create/initiate our object
	constructor(){
		this.addSearchHTML(); 		//has to be at beginning so that terms can be found
		this.resultsDiv = $("#search-overlay__results");
		this.openButton = $(".js-search-trigger");
		this.closeButton = $(".search-overlay__close");
		this.searchOverlay = $(".search-overlay");
		this.searchField = $("#search-term");
		this.events();
		this.isOverlayOpen = false;
		this.isSpinnerVisible = false;
		this.previousValue;
		this.typingTimer;
	}

	//2. events
	events() {
		this.openButton.on("click", this.openOverlay.bind(this));
		this.closeButton.on("click", this.closeOverlay.bind(this));
		$(document).on("keydown", this.keyPressDispatcher.bind(this));
		this.searchField.on("keyup", this.typingLogic.bind(this));
	}


	//3. methods (function,action...)
	typingLogic() {
		if (this.searchField.val() != this.previousValue) {
			clearTimeout(this.typingTimer);

			if (this.searchField.val()) {
				if (!this.isSpinnerVisible) {
					this.resultsDiv.html('<div class="spinner-loader"></div>');
					this.isSpinnerVisible = true;
				}
				this.typingTimer = setTimeout(this.getResults.bind(this), 750);
			} else {
				this.resultsDiv.html('');
				this.isSpinnerVisible = false;
			}
		}
		this.previousValue = this.searchField.val();
	}


	getResults() {
		$.getJSON(z10Data.root_url + '/wp-json/z10/v1/search?term=' + this.searchField.val(), (results) => {
			this.resultsDiv.html(`
				<div class="row">
					<div class="one-third">
						<h2 class="search-overlay__section-title"> Allgemein </h2>
						${results.generalInfo.length ? '<ul class="link-list min-list">' : '<p> Kein passendes Ergebnis gefunden </p>'}
							${results.generalInfo.map(item => `<li><a href="${item.permalink}"> ${item.title} </a>  </li>`).join('')}
						${results.generalInfo.length ? '</ul>' : ''}
					</div>
					<div class="one-third">
						<h2 class="search-overlay__section-title"> Veranstaltungen </h2>
						${results.events.length ? '' : `<p> Kein passendes Ergebnis gefunden, <a href="${z10Data.root_url}/programm"> siehe alle Veranstaltungen </a> </p>`}
							${results.events.map(item => `
								<div class="event-summary">
								  <a class="event-summary__date t-center" href="${item.permalink}">
								    <span class="event-summary__month">${item.month}</span>
								    <span class="event-summary__day">${item.day}</span>  
								  </a>
								  <div class="event-summary__content">
								    <h5 class="event-summary__title headline headline--tiny"><a href="${item.permalink}">${item.title}</a> ${item.past ? '(vergangen)' : ''} </h5>
								    <p>${item.description}<a href="${item.permalink}" class="nu gray">Learn more</a></p>
								  </div>
								</div>
							`).join('')}
							${results.pastevents.map(item => `
								<div class="event-summary">
								  <a class="event-summary__date t-center" href="${item.permalink}">
								    <span class="event-summary__month">${item.month}</span>
								    <span class="event-summary__day">${item.day}</span>  
								  </a>
								  <div class="event-summary__content">
								    <h5 class="event-summary__title headline headline--tiny"><a href="${item.permalink}">${item.title}</a> ${item.past ? '(vergangen)' : ''} </h5>
								    <p>${item.description}<a href="${item.permalink}" class="nu gray">Learn more</a></p>
								  </div>
								</div>
							`).join('')}
						<h2 class="search-overlay__section-title"> Kurse </h2>
						${results.kurse.length ? '<ul class="link-list min-list">' : `<p> Kein passendes Ergebnis gefunden, <a href="${z10Data.root_url}/kurse"> siehe alle Kurse </a> </p>`}
							${results.kurse.map(item => `<li><a href="${item.permalink}"> ${item.title} </a>  </li>`).join('')}
						${results.kurse.length ? '</ul>' : ''}
						${results.pastkurse.length ? '<ul class="link-list min-list">' : ''}
							${results.pastkurse.map(item => `<li><a href="${item.permalink}"> ${item.title} </a> (vergangen) </li>`).join('')}
						${results.pastkurse.length ? '</ul>' : ''}
					</div>
					<div class="one-third">
						<h2 class="search-overlay__section-title"> News </h2>
						${results.news.length ? '<ul class="link-list min-list">' : `<p> Kein passendes Ergebnis gefunden, <a href="${z10Data.root_url}/news"> siehe alle News </a> </p>`}
							${results.news.map(item => `<li><a href="${item.permalink}"> ${item.title} </a>  vom ${item.postDate} </li>`).join('')}
						${results.news.length ? '</ul>' : ''}
					</div>
				</div>	
			`);
			this.isSpinnerVisible = false;
		});

	}


	keyPressDispatcher(e) {

		if (e.keyCode == 83  && !this.isOverlayOpen && !$("input, textarea").is(':focus')) {
			this.openOverlay();
		}

		if (e.keyCode == 27 && this.isOverlayOpen) {
			this.closeOverlay();
		}
	}


	openOverlay() {
		this.searchOverlay.addClass("search-overlay--active");
		$("body").addClass("body-no-scroll");
		this.searchField.val('');
		setTimeout( () => this.searchField.focus(), 301);
		console.log("open method just ran");
		this.isOverlayOpen = true;
	}

	closeOverlay(){
		this.searchOverlay.removeClass("search-overlay--active");
		$("body").removeClass("body-no-scroll");
		console.log("close method just ran");
		this.isOverlayOpen = false;
	}

	addSearchHTML() {
		$("body").append(`
			<div class="search-overlay">
		    <div class="search-overlay__top">
		      <div class="container">
		        <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
		        <input type="text" class="search-term" placeholder="Was suchst du?" id="search-term">
		        <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
		      </div>
		    </div>
		    <div class="container">
		      <divid id="search-overlay__results"></div>

		    </div>
		  </div>
		`);
	}
}

export default Search;