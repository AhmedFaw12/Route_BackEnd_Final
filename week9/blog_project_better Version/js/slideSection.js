//function to show section 
var slide_btns = document.querySelectorAll('.slide_btn');
var sections = document.querySelectorAll('#comment');
console.log(sections);
	for (let i = 0; i < slide_btns.length; i++) {
		slide_btns[i].addEventListener('click', function(event) {
            $(this).hide();
			$("section").eq(i).slideDown();
		});
	}
