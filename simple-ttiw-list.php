<?php
/*
Plugin Name: Simple TTIW List
Plugin URI: http://www.artiss.co.uk/simple-wakoopa-list
Description: Adds a TheThingsIWant.com list to your WordPress theme
Version: 1.0
Author: David Artiss
Author URI: http://www.artiss.co.uk
*/

function simple_ttiw_list($username,$listname,$list_limit,$img_height) {
	
	$check_failure=0;
	
	// Check that a user and list name has been specified

	if ($username=="") {echo "<p style=\"color: #ff0000; font-weight: bold;\">Missing username for Simple TTIW List plugin.</p>\n"; $check_failure=1;}
    
    if ($listname=="") {echo "<p style=\"color: #ff0000; font-weight: bold;\">Missing listname for Simple TTIW List plugin.</p>\n"; $check_failure=1;}
	
	// If no list limit has been specified, set it to 99. Then validate the limit (must be between 1 and 99)
		
	if ($list_limit=="") {$list_limit=99;}
	if (($list_limit<1)or($list_limit>99)) {
		echo "<p style=\"color: #ff0000; font-weight: bold;\">Invalid list limit for Simple TTIW List plugin - must be between 1 and 99.</p>\n";
		$check_failure=1;
	}		
	       
		
	if ($check_failure==0) {	
    
		// Build the XML filename using the supplied user and list name
	
		$xmlfile="http://www.thethingsiwant.com/rss/".$username."/list/".$listname."/";
	
		// Fetch in the contents of the XML file
	
		$array=file_get_contents($xmlfile);
	
		// Read through the file and extract the appropriate sections
	
		$i=0;
		while ($i<$list_limit) {
			$item_start=strpos($array,"<item>");
			if ($item_start===false) {
				$i=$list_limit;	
			} else {	
				$item_end=strpos($array,"</item>");
				$item_length=$item_end+7-$item_start;
				$item_strip=substr($array,$item_start,$item_length);

				$title_start=strpos($item_strip,"<title>");
				$title_end=strpos($item_strip,"</title>");
				$title_length=$title_end+8-$title_start;
				$title=substr($item_strip, $title_start+7, $title_length-15);
			
				$link_start=strpos($item_strip,"<link>");
				$link_end=strpos($item_strip,"</link>");
				$link_length=$link_end+7-$link_start;
				$link=substr($item_strip, $link_start+6, $link_length-13);	
			
				// Write out the appropriate information
			
				echo "<li><a href=\"".$link."\" target=\"_blank\">".$title."</a></li>\n";
			
				// Remove the current software record from the array

				$array=substr($array,$item_end+7);
				$i++;
			}
		}
		
		echo "<li><a href=\"http://www.thethingsiwant.com/".$username."/list/".$listname."/\" target=\"_blank\">More...</a></li>\n";
		
	}	
}
?>