<?php
$test=file_get_contents("https://www.uoi.gr/tag/menou-lesxis/");

libxml_use_internal_errors(true);

$dom = new DomDocument();
$dom->loadHTML($test);

$dom_element = $dom->getElementById("content");
$links = $dom_element->getElementsByTagName("a");

for($i=0;$i<$links->length;$i++){
	$node = $links->item($i);
	$text = mb_strtolower($node->nodeValue);
	if(strpos($text,"πρόγραμμα σίτισης")===False){
		continue;
	}
	$link = $node->getAttribute('href');
	$menu_text = file_get_contents($link);
	$menu_site_dom = new DomDocument();
	$menu_site_dom->loadHTML($menu_text);
	$atatchments = $menu_site_dom->getElementsByTagName("a");
	for($j=0;$j<$atatchments->length;$j++){
		$link = $atatchments->item($j)->getAttribute('href');
		if(strpos($link, "doc")!=False){
			echo $link."\n";
		}

	}
}

?>
