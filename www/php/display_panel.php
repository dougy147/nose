<?php
	echo "<div class='left_panel'>" ;
	//echo "<a href='?dir=" . $parentDir . "'> [prev]</a>  " ;
	echo "&emsp;&ensp; <a href='?dir=" . $parentDir . "'><img class='left_arrow' src='../assets/left_arrow.png'></a>  " ;
	//echo "<a href='?dir=/'>[home]</a>  " ;
	//echo "<a href='?dir=/'><img class='home' src='../assets/home.png'></a>  " ;
	$home = getenv('HOME');
	echo "<a href='?dir=$home'><img class='home' src='../assets/home.png'></a>  " ;
	if ($_POST['recursivity'] == 1) {
		//echo "<a id='recursive_button' href='javascript:toggle_recursive();'>R (on)</a>";
		echo "<a id='recursive_button' href='javascript:toggle_recursive();'><img id='recursive_img' class='recursive_img' src='../assets/recursive.png'></a>  ";
	} else {
		//echo "<a id='recursive_button' href='javascript:toggle_recursive();'>R (off)</a>";
		echo "<a id='recursive_button' href='javascript:toggle_recursive();'><img id='recursive_img' class='recursive_img' src='../assets/recursive_off.png'></a>  ";
	}
	if ($_POST['hidden'] == 1) {
		//echo "<a id='recursive_button' href='javascript:toggle_recursive();'>R (on)</a>";
		echo "<a id='hidden_button' href='javascript:toggle_hidden();'><img id='hidden_img' class='hidden_img' src='../assets/hidden.png'></a>";
	} else {
		//echo "<a id='recursive_button' href='javascript:toggle_recursive();'>R (off)</a>";
		echo "<a id='hidden_button' href='javascript:toggle_hidden();'><img id='hidden_img' class='hidden_img' src='../assets/hidden_off.png'></a>";
	}

	echo "<p class='cur_dir_name'>&emsp;&emsp;";
	echo $currentDir ;
	echo "</p>";

	echo "<table border='1' id='panel_table'>" ;
	foreach ($DirNames as $name) {
		if (str_starts_with($name, '.') == true || $name == "lost+found" ) { $dir_class = "hidden_dir"; continue;
		} else { $dir_class = "visible_dir"; } ;
		echo "<tr><td class='panel_dir $dir_class'><div class='checkbox-wrapper-2'><input class='look_inside sc-gJwTLC ikxBAC' name='choice[]' type='checkbox'";
		//echo "<tr><td class='panel_dir $dir_class'><input class='look_inside' name='choice[]' type='checkbox'";
		if ( str_contains($checked_dirs, "/" . $name )) { echo "checked "; } ; // TODO : keep checked
		echo "value='" . $currentDir . "/" . $name . "'> <a class='panel_dirs' href='?dir=" . $currentDir . "/" . $name . "'>" . $name . "</a></td></tr></div>";
		//echo "value='" . $currentDir . "/" . $name . "'><a class='panel_dirs' href='?dir=" . $currentDir . "/" . $name . "'>" . $name . "</a></td></tr>";
	}

	echo "</table>" ;
	echo "</div>";
?>
