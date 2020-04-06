import $ from 'jquery';

class MyNotes {
	constructor() {
		this.events();
	}

	events() {
		$(".delete-note").on("click", this.deleteNote);
	}

	//Methods will go here
	deleteNote() {
		$.ajax({
			url: z10Data.root_url + '/wp-json/wp/v2/note/230',
			type: 'DELETE',
			success: (response) => {
				console.log("success");
				console.log(response);
			},
			error: (response) => {
				console.log("sorry");
				console.log(response);
			}	
		});
	}

}

export default MyNotes;