// Script to open file when clicking on it

function formSubmit(file_to_open)
{

  // Save checked dirs before opening
  //cbox_dir();

  //document.forms[0].download.value = file_to_open;
  //document.forms[0].submit();
  document.open_file.download.value = file_to_open;
  document.open_file.submit();

}
