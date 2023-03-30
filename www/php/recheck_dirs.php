<?php
	// Recheck checkboxes of previously checked dirs
	$checked_dirs = $_POST["dirs_to_check"];
	if (empty($checked_dirs)) { $checked_dirs = $currentDir; }
?>
