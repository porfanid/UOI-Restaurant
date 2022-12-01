<?php
$test=file_get_contents("https://www.uoi.gr/tag/menou-lesxis/");
//do not show php warnings with wrong html syntax
libxml_use_internal_errors(true);

// create dom and store the data from the site
$dom = new DomDocument();
$dom->loadHTML($test);

// reduce the amount of data by reading only the element with id content
// This will help us to remove unecessary links
$dom_element = $dom->getElementById("content");
// get the links from the content
$links = $dom_element->getElementsByTagName("a");

// for every link 
//	(1)check if it contains the "πρόγραμμα σίτισης" substring because we are intrested only in those links
//	(2)get the href and read the contents of that site.
//	(3)	read the doc links of that site and echo them as a result
for($i=0;$i<$links->length;$i++){
	$node = $links->item($i);
	$text = mb_strtolower($node->nodeValue);
//	(1)
	if(strpos($text,"πρόγραμμα σίτισης")===False){
		continue;
	}
	$link = $node->getAttribute('href');
//	(2)
	$menu_text = file_get_contents($link);
	$menu_site_dom = new DomDocument();
	$menu_site_dom->loadHTML($menu_text);
//	(3)
	$atatchments = $menu_site_dom->getElementsByTagName("a");
	for($j=0;$j<$atatchments->length;$j++){
		$link = $atatchments->item($j)->getAttribute('href');
		if(strpos($link, "doc")!=False){
			echo $link."\n";
		}

	}
}

?>
