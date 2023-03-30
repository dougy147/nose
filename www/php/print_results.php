<?php
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
	echo "<table width='70%' border='1'>
		<tr>
		<td class='table_headers_rank'></td>
		<td class='table_headers_filepath'>Filepath</td>
		<td class='table_headers_score' style='text-align:center'>Σ tf-idf</td>
		</tr>";
	$index_colors=0;
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
				$filename=basename("$found_file");
				$found_file = preg_replace('/\'/', '\\\'', $found_file); // Replace ' by \' to avoid break in docs with '
				echo "<a href=\"javascript:formSubmit('$found_file');\" download='" . $found_file . "'> " . $filename . " </a></td>";
			} else {
				echo "<tr><td class='result_rank' style='opacity:0.2'>$index_colors</td>";
				echo "<td class='$coloring low_rank'>";
					$found_file=$result["filepath"];
				$filename=basename("$found_file");
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
?>
