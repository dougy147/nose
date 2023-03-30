<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel=icon href="./assets/icon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NOSE</title>
  </head>
  <body>
	<a href="<?php echo $PHP_SELF; ?>"><img class="logo" src="./assets/logo.png"></a>
    <center>
      <h1>Not Optimal Search Engine</h1>

<!-- Javascript to get the filepath of files -->
<!--  (see the php function to create list)  -->
<script>
function formSubmit(download)
{
  document.forms[0].download.value = download;
  document.forms[0].submit();
}
</script>

<!-- Form to post filepath if link to file has been clicked -->
<form action="<?php echo $PHP_SELF; ?>" method="POST">
<input type="hidden" name="download" value="-1">
</form>



      <form action="<?php echo $PHP_SELF; ?>" method="post">
	<input class="user" type="text"
	       name="user_input"
	       value=""
	       placeholder="what are you searching for?"
	       autofocus>
	<input class="button"
	       type="submit"
	       value="search"
	       name="submit">
      </form>

	<br>

<?php
// If a link to a file has been clicked : open it
if (isset($_POST['download'])) {
	$file = $_POST['download'];
	$opener = 'xdg-open';
	shell_exec("setsid -f $opener \"$file\" > /dev/null 2>/dev/null &");
	display_table();
	//exit;
}
?>


	<?php
	$filesInFolder = array();
	$baseDir       = "/";
	$currentDir    = !empty($_GET['dir']) ? $_GET['dir'] : $baseDir ;

	//if (isset($_GET['download'])) {
	//	echo $_GET['download'];
	//	exit;
	//}

	$iterator = new FilesystemIterator($currentDir);
	$name_to_display = $iterator->getPath();
	$parentDir = substr($name_to_display, 0, strrpos( $name_to_display, '/'));
	$DirNames = array();
	$FileNames = array();
	foreach ($iterator as $entry) {
	    $name = $entry->getBasename();
	    if (is_dir($currentDir . '/' . $name)) {
		    $DirNames[] = $name;
		}
	    elseif (is_file($currentDir . '/' . $name)) {
		    $FileNames[] = $name;
	    }
	}
	natcasesort($DirNames);
	natcasesort($FileNames);


	if(isset($_POST["submit"])) {
		if($_POST["user_input"] != "")
		{
			$user_asks = $_POST["user_input"];
			$user_asks = htmlspecialchars($user_asks, ENT_QUOTES);
			//if(file_get_contents('./served_index.txt') !== false) {
			//	$cur_index = file_get_contents('./served_index.txt');
			//} else { $cur_index = "";} ;
			//foreach(file("./served_index.txt") as $line) {
			//	$cur_index = $cur_index . " " . $line;
			//};
			$time_start = microtime(true);
			//shell_exec("cd .. && ./nose -cipf --from-server \"$user_asks\" \"$currentDir\"");
			shell_exec("cd .. && ./nose -cq --from-server \"$user_asks\" \"$currentDir\"");
			display_table();
			$time_end = microtime(true);
			$time = round(($time_end - $time_start), 2, PHP_ROUND_HALF_UP);
			echo "<br><p class='request_info'>Request <span class='last_search'>{$user_asks}</span> processed in <span class='time_spent'>{$time}s</span></p>";
			if (isset($cur_index)) {
				echo "<p class='cur_index_info'><i>Served with index <span class='served_index'>$cur_index</span></i></p>";
			} else {
				echo "<p class='cur_index_info'><i>Served with <span class='served_index'>default NOSE index</span></i></p>";
			};
		}
	}

	echo "<br>";

	echo "<h3><a href='?dir=/'>[home]</a> <a href='?dir=" . $parentDir . "'> [prev]</a> <br><br>" ;
	if ( $name_to_display === $baseDir ) {
		//echo "<h3>" . $name_to_display . "</h3>";
		echo $name_to_display . "</h3>";
	} else {
		//$name_to_display = "/" . ltrim($name_to_display, '/');
		//echo "<h3><a href='?dir=" . $parentDir . "'> (Prev)</a> " . $name_to_display . "</h3>";
		//echo "<h3><a href='?dir=/'>[home]</a> <a href='?dir=" . $parentDir . "'> [prev]</a> <br><br>" ;
		$name_to_display = ltrim($name_to_display, '/');
		foreach (explode("/", $name_to_display) as $folder) {
			$a = $a . "/" . $folder ;
			echo "/<a class='arborescence_link' href='?dir=" . $a . "'>" . $folder . "</a>";
		}
		echo "</h3>";
	}

	echo "<table width='40%' border='1' id='table_explorer'>
		<tr>
		<td class='table_headers_type'>Type</td>
		<td class='table_headers_filepath'>Filepath</td>
		</tr>";
	$index_colors=0;

	foreach ($DirNames as $name) {
		// if "." in dirname (class=' .. hidden_dir')
		if (str_starts_with($name, '.') == true ) { $dir_class = "hidden_dir";
		continue;
		} else { $dir_class = "visible_dir"; } ;
	    $index_colors++;
	     if ($index_colors % 2 == 0) { $coloring = "even";
		} else { $coloring = "odd"; };
	    //echo "<tr><td class='explorer_type'> (Dir) </td>";
	    echo "<tr><td class='explorer_type $dir_class'><img class='type_icon' src='./assets/dir.png'></td>";
	    echo "<td class='$coloring $dir_class'>";
	    echo "<a href='?dir=" . $currentDir . "/" . $name . "'>" . $name . "</a></td>";
	}

	foreach ($FileNames as $name) {
		// if "." in dirname (class=' .. hidden_dir')
		if (str_starts_with($name, '.') == true ) { $file_class = "hidden_file";
		continue;
		} else { $file_class = "visible_file"; } ;
	    $index_colors++;
	     if ($index_colors % 2 == 0) { $coloring = "even";
		} else { $coloring = "odd"; };
	    //echo "<tr><td class='explorer_type'> (File) </td>";
	    echo "<tr><td class='explorer_type $file_class'><img class='type_icon' src='./assets/file.png'></td>";
	    echo "<td class='$coloring $file_class'>";
	    $the_path = $currentDir . '/' . $name ;
	    $the_path = preg_replace('/^./', '', $the_path); // Delete the first slash to keep only one
	    $the_path = preg_replace('/\'/', '\\\'', $the_path); // Replace ' by \' to avoid break in docs with '
	    echo "<a href=\"javascript:formSubmit('$the_path');\" download='" . $the_path . "'> " . $name . " </a></td>";
	    }
	echo "</tr>";

	//echo "<input type = \"button\" name = \"hidden_files\" id=\"toggle_hidden_files\" value = \"Hidden files\" onclick = \"testDisplay(name)\">";
?>

<!--<script>
var hide = false;
function toggleTable()
{
  if (hide == false)
  {
	  hide = true;
	var table= document.getElementById("table_explorer");
        for (var i = 0, row; row = table.rows[i]; i++) {
        if(row.className == "explorer_type"){row.style.visibility="hidden";}
        }
    //document.getElementById('explorer_type').row.style.visibility = 'visibility';
  }
  else
  {
    hide = false;
	var table= document.getElementById("table_explorer");
        for (var i = 0, row; row = table.rows[i]; i++) {
        if(row.className == "explorer_type"){row.style.visibility="visible";}
        }
    //document.getElementById('explorer_type').row.style.visibility = 'hidden';
  }
}
</script>


<input type = "button" class="button" name = "hidden_files" id="toggle_hidden_files" value = "Hidden files" onclick = "testDisplay(name)">
-->

<!--<script>
function testDisplay(test) {
    if (document.getElementById("table_explorer").value == "Hide " + test) {
        document.getElementById("table_explorer").value = "Show " + test;
        var table= document.getElementById("dot_file");
        for (var i = 0, row; row = table.rows[i]; i++) {
        if(row.className == "dot_file"){row.style.visibility="hidden";}
        }
    }
    else{
        document.getElementById("toggle_hidden_files").value = "Hide " + test;
        var table= document.getElementById("table_explorer");
        for (var i = 0, row; row = table.rows[i]; i++) {
        if(row.className == "dot_file"){row.style.visibility='visible';}
        }
    }
}
</script>-->

	</center>

</body>


</html>

<?php
// Trying to keep my table of result when opening links...
function display_table() {
			$lines = file("../out/finder/top_ordering.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    			$data = array_map(function($v){
				list($filepath, $score_tmp) = explode("\t", $v);
				if (is_numeric($score_tmp)) {
				        $score = round($score_tmp, 2, PHP_ROUND_HALF_UP);
				} else {
					$score = $score_tmp;
				};
    			    	return ["filepath" => $filepath, "score" => $score];
			}, $lines);
			//flush();
			echo "<table width='70%' border='1'>
				<tr>
				<td class='table_headers_rank'></td>
				<td class='table_headers_filepath'>Filepath</td>
				<td class='table_headers_score' style='text-align:center'>Σ tf-idf</td>
				</tr>";
			$index_colors=0;
			//shell_exec("rm ./tmp/*");
			foreach($data as $result){
				$index_colors++;
				if ($index_colors % 2 == 0) { $coloring = "even";
					} else {
						$coloring = "odd"; };
				if (is_numeric($result["score"])) {
					if (floatval($result["score"]) > 0) {
						echo "<tr><td class='result_rank'>$index_colors</td>";
						echo "<td class='$coloring'>";
							$found_file=$result["filepath"];
						////shell_exec("ln -s $found_file './tmp/'");
						$filename=basename("$found_file");
						//echo "<a href='./tmp/" . $filename . "'>" . $result["filepath"] . "</a>";
	    					$found_file = preg_replace('/\'/', '\\\'', $found_file); // Replace ' by \' to avoid break in docs with '
	    					echo "<a href=\"javascript:formSubmit('$found_file');\" download='" . $found_file . "'> " . $filename . " </a></td>";
					} else {
						echo "<tr><td class='result_rank' style='opacity:0.2'>$index_colors</td>";
						echo "<td class='$coloring low_rank'>";
							$found_file=$result["filepath"];
						////shell_exec("ln -s $found_file './tmp/'");
						$filename=basename("$found_file");
						//echo "<a href='./tmp/" . $filename . "'>" . $result["filepath"] . "</a>";
	    					$found_file = preg_replace('/\'/', '\\\'', $found_file); // Replace ' by \' to avoid break in docs with '
	    					echo "<a href=\"javascript:formSubmit('$found_file');\" download='" . $found_file . "'> " . $filename . " </a></td>";
					};
					if (floatval($result["score"]) > 0) {
						echo "</td><td class='$coloring' style='text-align:center'>";
						echo $result["score"];
						echo "</td></tr>";
					} else {
						echo "</td><td class='$coloring low_rank' style='text-align:center'>";
						echo $result["score"];
						echo "</td></tr>";
					};
				} else {
					echo "<tr><td class='result_rank'>#</td>";
					echo "<td class='error_result'>";
						$error=$result["filepath"];
					echo "$error";
					echo "</td><td class='error_result' style='text-align:center'>";
					echo $result["score"];
					echo "</td></tr>";
					};
			};
			echo "</table>";
		}
// End of test
?>
