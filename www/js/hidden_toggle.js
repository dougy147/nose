// Script to hide/show hidden files/dirs.

function toggle_hidden() {
    var hidden_mode = document.getElementById("hidden_fd");
    var hidden_button = document.getElementById("hidden_button");
    console.log("Before click, hidden files mode was :", hidden_mode.value);

    if (hidden_mode.value == 0 || hidden_mode.value == "" ) {
	    hidden_mode.value = 1;
	    var image = document.getElementById('hidden_img') ;
	    image.src = "../assets/hidden.png";
    } else {
	    hidden_mode.value = 0;
	    var image = document.getElementById('hidden_img') ;
	    image.src = "../assets/hidden_off.png";
    }
    console.log("Hidden files mode is :", hidden_mode.value);

    //document.open_file.submit(); //TODO
}
