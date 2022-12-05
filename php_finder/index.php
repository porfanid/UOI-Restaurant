<?php

require __DIR__ .'/vendor/autoload.php';
header('Content-Type: application/json; charset=utf-8');



//do not show php warnings with wrong html syntax
libxml_use_internal_errors(true);
include_once("functions.php");

use PhpOffice\PhpWord\PhpWord;
//echo get_current_menu();

$doc_name = "./sitisis-dekemvrioy-2022.docx";
$docx = new PhpWord($doc_name);
//$docx = new \PhpOffice\PhpWord\CreateDocxFromTemplate($doc_name);
$referenceNode = array(
    'type' => 'table-cell',
    'parent' => 'w:tbl/w:tr/',
    'contains' => 'First row',
);

$contents = $docx->getWordStyles($referenceNode);

echo contents;

?>
