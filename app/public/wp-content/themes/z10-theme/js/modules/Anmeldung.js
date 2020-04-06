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
		if (currentLikeBox.data('exists') == 'yes') {
			this.deleteLike(currentLikeBox);
		} else {
			this.createLike(currentLikeBox);
		}
	}

	createLike(currentLikeBox) {
		$.ajax({
			
			url: z10Data.root_url + '/wp-json/z10/v1/manageAnmeldung', 
			type: 'POST',
			data: {'kursId': currentLikeBox.data('kurs')},
			success: (response) => {
				console.log(response);
				},
			error: (response) => {
				console.log(response);
				},
		});
	}

	deleteLike() {
		$.ajax({
			url: z10Data.root_url + '/wp-json/z10/v1/manageAnmeldung', 
			type: 'DELETE',
			success: (response) => {
				console.log(response);
				},
			error: (response) => {
				console.log(response);
				},
		});
	}







}

export default Anmeldung;