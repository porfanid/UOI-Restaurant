<?php
/**
 * Function to get a list of the urls with a constraint.
 * If the in_href is True then the constraint is being checked in the href property of the a tag. Otherwise the inner text of the tag is being checked
 */
function read_links_from_url($link, $constraint, $in_href){
	// array to store the results
	$links = array();
	
	// parse the link contents
	$site = file_get_contents($link);
	$dom = new DomDocument();
	$dom->loadHTML($site);
	
	// get all the a attributes, iterate throuthem and check if the constraint is true
	$link_elements = $dom->getElementsByTagName("a");
	for($i=0;$i<$link_elements->length;$i++){
		$link_element = $link_elements->item($i);
		
		$text = mb_strtolower($link_element->nodeValue);
		$link = $link_element->getAttribute('href');
		
		if(($in_href==false and strpos($text,$constraint)!==False) or (($in_href==true and strpos($link,$constraint)!==False))){
			$links[]=$link;
		}
	}
	return $links;
}

function get_all_menus(){
	$menu=array();
	$links_for_restaurant_per_month = read_links_from_url("https://www.uoi.gr/tag/menou-lesxis/", "πρόγραμμα σίτισης", False);
	foreach($links_for_restaurant_per_month as $i=>$link){
		$menu_docs = read_links_from_url($link, "doc", True);
		$menu = array_merge($menu, $menu_docs);
	}
	return $menu;
}
?>
