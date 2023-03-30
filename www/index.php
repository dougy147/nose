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

<?php
	//include("./php/first_visit.php");
	include("./php/func_display_table.php");
	//include('./php/recursive_mode.php');
	include("./php/list_directories.php");
?>

<script src="./js/cbox_dir.js"></script>
<script src="./js/recursive_toggle.js"></script>
<script src="./js/hidden_toggle.js"></script>
<script src="./js/open_file.js"></script>

<!-- Form to grab user_input and selected directories -->
<form name="test_form" action="<?php echo $PHP_SELF; ?>" method="POST">
<input type="hidden" name="dirs_to_check" id="dirs_to_check" value="">
<input type="hidden" name="recursivity" id="recursivity" value='<?php echo $_POST["recursivity"]; ?>'>
<input type="hidden" name="hidden_fd" id="hidden_fd" value='<?php echo $_POST["hidden"]; ?>'>
<input class="user" type="text"
       name="user_input"
       value=""
       placeholder="<?php echo $currentDir; ?>"
       autofocus>
<input class="button"
       type="submit"
       value="search"
       onclick="cbox_dir();"
       name="submit">
</form>

<br>

<?php
	include("./php/recheck_dirs.php");
	include("./php/start_search.php");
	include("./php/display_panel.php");
	include('./php/func_open_file.php');
?>

<!-- Form to post filepath if link to file has been clicked -->
<!-- It also keeps track of recursive mode and checked_dirs -->
<form name="open_file" action="#" method="post">
<input type="hidden" name="download" value="-1">
<input type="hidden" name="dirs_to_check" id="dirs_to_check" value='<?php echo $_POST["dirs_to_check"]; ?>'>
<input type="hidden" name="recursivity" id="recursivity" value='<?php echo $_POST["recursivity"]; ?>'>
<input type="hidden" name="hidden_fd" id="hidden_fd" value='<?php echo $_POST["hidden"]; ?>'>
</form>

</center>

</body>

</html>
