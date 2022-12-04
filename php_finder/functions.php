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

/**
 * Function to parse all the menus from the webpage
 */
function get_all_menus(){
	$menu=array();
	$links_for_restaurant_per_month = read_links_from_url("https://www.uoi.gr/tag/menou-lesxis/", "πρόγραμμα σίτισης", False);
	foreach($links_for_restaurant_per_month as $i=>$link){
		$menu_docs = read_links_from_url($link, "doc", True);
		$menu = array_merge($menu, $menu_docs);
	}
	return $menu;
}

/**
 * function to get the current month's menu
 */
function get_current_menu(){
	$all_menus = get_all_menus();
	$month = get_month();
	foreach($all_menus as $menu){
		if(strpos($menu,$month)!==False){
			return $menu;
		}
	}
	return False;
}
/**
 * Function to get a string to compare to the menu link based on the current month 
 */
function get_month(){
	$months = array('ianouar', 'fevroy', 'mart', 'april', 'mai', 'ioyni', 'ioyli','aug', 'septemv', 'okto', 'noem', 'dekem');	
	$month = date("m");
	return $months[$month-1];
}

function read_docx($filename){

    $striped_content = '';
    $content = '';

    if(!$filename || !file_exists($filename)) return false;

    $zip = zip_open($filename);
    if (!$zip || is_numeric($zip)) return false;

    while ($zip_entry = zip_read($zip)) {

        if (zip_entry_open($zip, $zip_entry) == FALSE) continue;

        if (zip_entry_name($zip_entry) != "word/document.xml") continue;

        $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

        zip_entry_close($zip_entry);
    }
    zip_close($zip);      
    $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
    $content = str_replace('</w:r></w:p>', "\r\n", $content);
    $striped_content = strip_tags($content);

    return $striped_content;
}
?>
