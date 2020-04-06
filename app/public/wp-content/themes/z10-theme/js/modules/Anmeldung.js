import $ from 'jquery';

class Anmeldung {
	constructor() {
		this.events();
	}


	events() {
		$(".like-box").on("click", this.ourClickDispatcher.bind(this));
	}


	//methods
	ourClickDispatcher(e) {
		var currentLikeBox = $(e.target).closest(".like-box");
		if (currentLikeBox.attr('data-exists') == 'yes') {
			this.deleteLike(currentLikeBox);
		} else {
			this.createLike(currentLikeBox);
		}
	}

	createLike(currentLikeBox) {
		$.ajax({
			beforeSend: (xhr) => {
				xhr.setRequestHeader('X-WP-Nonce', z10Data.nonce);
			},
			url: z10Data.root_url + '/wp-json/z10/v1/manageAnmeldung', 
			type: 'POST',
			data: {'kursId': currentLikeBox.data('kurs')},
			success: (response) => {
				currentLikeBox.attr('data-exists', 'yes');
				var Anmeldungscount = parseInt(currentLikeBox.find(".like-count").html() ,10);
				Anmeldungscount++;
				currentLikeBox.find(".like-count").html(Anmeldungscount);
				currentLikeBox.attr("data-anmeldung", response);
				console.log(response);
				},
			error: (response) => {
				console.log(response);
				},
		});
	}

	deleteLike(currentLikeBox) {
		$.ajax({
			beforeSend: (xhr) => {
				xhr.setRequestHeader('X-WP-Nonce', z10Data.nonce);
			},
			url: z10Data.root_url + '/wp-json/z10/v1/manageAnmeldung', 
			data: {'anmeldung': currentLikeBox.attr('data-anmeldung')},
			type: 'DELETE',
			success: (response) => {
				currentLikeBox.attr('data-exists', 'no');
				var Anmeldungscount = parseInt(currentLikeBox.find(".like-count").html() ,10);
				Anmeldungscount--;
				currentLikeBox.find(".like-count").html(Anmeldungscount);
				currentLikeBox.attr("data-anmeldung", '');
				console.log(response);
				},
			error: (response) => {
				console.log(response);
				},
		});
	}







}

export default Anmeldung;