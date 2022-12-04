<?php
//do not show php warnings with wrong html syntax
libxml_use_internal_errors(true);

include_once("functions.php");
$link =  get_current_menu();

echo read_docx($link);

?>
