// Script to grab directory checkboxes.

function toggle_recursive() {
    // Set RECURSIVE MODE IN FORM "test_form"
    var recursive_mode = document.getElementById("recursivity");
    var recursive_button = document.getElementById("recursive_button");
    console.log("Before click, recursive mode was :", recursive_mode.value);

    if (recursive_mode.value == 0 || recursive_mode.value == "" ) {
	    recursive_mode.value = 1;
    	    //recursive_button.innerHTML="R (on)";
	    var image = document.getElementById('recursive_img') ;
	    image.src = "../assets/recursive.png";
	    if_all_unchecked_and_recursive_clicked() ;
    } else {
	    recursive_mode.value = 0;
    	    //recursive_button.innerHTML="R (off)";
	    var image = document.getElementById('recursive_img') ;
	    image.src = "../assets/recursive_off.png";
	    //document.getElementById("recursivity").value = 0;
	    if_all_checked_and_recursive_unclicked() ;
    }
    console.log("Recursive mode is :", recursive_mode.value);


}

// If all checkboxes are unchecked and recursive mode is selected : check all
function if_all_unchecked_and_recursive_clicked() {
	var textinputs = document.querySelectorAll('input[type=checkbox]');
	var empty = [].filter.call( textinputs, function( el ) {
	   return !el.checked
	});

	if (textinputs.length == empty.length) {
	    //alert("None filled");
	    //return false;
	    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
	     for (var i = 0; i < checkboxes.length; i++) {
	      if (checkboxes[i].type == 'checkbox')
	        checkboxes[i].checked = true;
	     }
	}
}

// If all checkboxes are checked and recursive mode is unselected : uncheck all
function if_all_checked_and_recursive_unclicked() {
	var textinputs = document.querySelectorAll('input[type=checkbox]');
	var empty = [].filter.call( textinputs, function( el ) {
	   return el.checked
	});

	if (textinputs.length == empty.length) {
	    //alert("None filled");
	    //return false;
	    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
	     for (var i = 0; i < checkboxes.length; i++) {
	      if (checkboxes[i].type == 'checkbox')
	        checkboxes[i].checked = false;
	     }
	}
}
