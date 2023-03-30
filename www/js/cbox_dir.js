// Script to grab directory checkboxes.

function cbox_dir() {
    var boxes = document.getElementsByClassName('look_inside');
    var paths = [];
    console.log(boxes);
    var arr = [];
    for(var x=0; x<boxes.length; x++){
	    if (boxes[x].checked) {
		    arr.push(boxes[x].value);
	    }
	}
    console.log(arr);
    var checked = arr.join(' ');
    console.log(checked);
    let checked_trim = checked.replace(/\/+/g, '/')
    console.log(checked_trim);
    //window.alert(checked_trim);
    document.test_form.dirs_to_check.value = checked_trim;

}
