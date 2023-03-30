<?php
// If a link to a file has been clicked : open it
	if (isset($_POST['download'])) {
		$file = $_POST['download'];
		$opener = 'xdg-open';
		shell_exec("setsid -f $opener \"$file\" > /dev/null 2>/dev/null &");
		//display_table();
	}
?>
