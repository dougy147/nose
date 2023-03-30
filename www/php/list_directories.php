<?php
	$filesInFolder = array();
	$baseDir       = "/";
	$currentDir    = !empty($_GET['dir']) ? $_GET['dir'] : $baseDir ;
	// Change potential "//" -> "/"
	$currentDir = preg_replace('~/+~', '/', $currentDir);
	////////////////
	$iterator = new FilesystemIterator($currentDir);
	$name_to_display = $iterator->getPath();
	$parentDir = substr($name_to_display, 0, strrpos( $name_to_display, '/'));
	$DirNames = array();
	foreach ($iterator as $entry) {
	    $name = $entry->getBasename();
	    if (is_dir($currentDir . '/' . $name)) {
		    $DirNames[] = $name;
		}
	}
	natcasesort($DirNames);
?>
