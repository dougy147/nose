<?php
if(isset($_POST["submit"])) {
	$user_asks = $_POST["user_input"];
	$user_asks = htmlspecialchars($user_asks, ENT_QUOTES);

	//$checked_dirs = $_POST["dirs_to_check"];
	//echo $_POST["dirs_to_check"]; //
	//if (empty($checked_dirs)) { $checked_dirs = $currentDir; }

	$time_start = microtime(true);
	//shell_exec("cd .. && ./nose -cq --from-server \"$user_asks\" \"$currentDir\"");
	if($_POST["recursivity"] == 1 ) {
		shell_exec("cd .. && ./nose -crq --from-server \"$user_asks\" $checked_dirs");
	} else {
		shell_exec("cd .. && ./nose -cq --from-server \"$user_asks\" $checked_dirs");
	}
	display_table(); // TODO
	//include("print_results.php");
	$time_end = microtime(true);
	$time = round(($time_end - $time_start), 2, PHP_ROUND_HALF_UP);
	echo "<br><p class='request_info'>Request <span class='last_search'>{$user_asks}</span> processed in <span class='time_spent'>{$time}s</span></p>";
} else {
	display_table(); // TODO If first time load : no
}

//display_panel();
//include("display_panel.php");

?>
