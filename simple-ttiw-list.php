<?php
/*
Plugin Name: Simple TTIW List
Plugin URI: http://www.artiss.co.uk/simple-wakoopa-list
Description: Adds a TheThingsIWant.com list to your WordPress theme
Version: 2.1
Author: David Artiss
Author URI: http://www.artiss.co.uk
*/

function simple_ttiw_list($username,$listname,$list_limit,$img_height) {

    echo "<li style=\"color: #ff0000; font-weight: bold;\">Your code is for the old version of Simple TTIW list. Please update.</li>\n";
    
}

function ttiw_list($list_url,$list_limit,$price_flag) {
    
	$check_failure=0;
	
	// Check that a list ID has been specified
  
    if ($list_url=="") {echo "<li style=\"color: #ff0000; font-weight: bold;\">Missing list URL for Simple TTIW List plugin.</li>\n"; $check_failure=1;}
	
	// If no list limit has been specified, set it to 99. Then validate the limit (must be between 1 and 99)
		
	if ($list_limit=="") {$list_limit=99;}
	if (($list_limit<1)or($list_limit>99)) {
		echo "<li style=\"color: #ff0000; font-weight: bold;\">Invalid list limit for Simple TTIW List plugin - must be between 1 and 99.</li>\n";
		$check_failure=1;
	}		     
    
    // If a price flag is specified, ensure it is Yes or No
    
    if (($price_flag!="")&&($price_flag!="Yes")&&($price_flag!="No")) {
		echo "<li style=\"color: #ff0000; font-weight: bold;\">Invalid price flag - must be blank, No or Yes.</li>\n";
		$check_failure=1;
	}	
		
	if ($check_failure==0) {	
    
		// Fetch in the contents of the XML file
	
		$array=file_get_contents($list_url);
        
        // First, get the link to the list
        
        $link_start=strpos($array,"<link>");
        $link_end=strpos($array,"</link>");
		$link_length=$link_end+7-$link_start;
		$list_link=substr($array, $link_start+6, $link_length-13);        
	
		// Read through the file and extract the appropriate sections
	
		$i=0;
		while ($i<$list_limit) {
			$item_start=strpos($array,"<item>");
			if ($item_start===false) {
				$i=$list_limit;	
			} else {                
                $item_strip="";
                $title="";
                $link="";
                $price="";
                $wants=1;
                $purchase=1;
                
				$item_end=strpos($array,"</item>");
				$item_length=$item_end+7-$item_start;
				$item_strip=substr($array,$item_start,$item_length);

				$title_start=strpos($item_strip,"<title>");
				$title_end=strpos($item_strip,"</title>",$title_start);
				$title_length=$title_end+8-$title_start;
				$title=substr($item_strip, $title_start+7, $title_length-15);
			
				$link_start=strpos($item_strip,"<link>",$title_end);
				$link_end=strpos($item_strip,"</link>",$link_start);
				$link_length=$link_end+7-$link_start;
				$link=substr($item_strip, $link_start+6, $link_length-13);	
                
 				$desc_start=strpos($item_strip,"<description>",$link_end);
				$desc_end=strpos($item_strip,"</description>",$desc_start);
				$desc_length=$desc_end+14-$desc_start;
				$desc=substr($item_strip, $desc_start+13, $desc_length-27);
                
                    // From the description prices and quantities can be extracted
                
                    $price_start=strpos($desc,"Price: <strong>");
                    $price_end=strpos($desc,"</strong>",$price_start);
                    $price_length=$price_end+9-$price_start;
                    $price=trim(substr($desc, $price_start+15, $price_length-24));                
                
                    $wants_start=strpos($desc,"Wants:</strong>",$price_end);
                    $wants_end=strpos($desc,"<strong>Purchases:",$wants_start);
                    $wants_length=$wants_end+18-$wants_start;
                    $wants=trim(substr($desc, $wants_start+15, $wants_length-33));
                
                    $purchase_start=strpos($desc,"Purchases:</strong>",$wants_end);
                    $purchase_end=strpos($desc,"</p>]]",$purchase_start);
                    $purchase_length=$purchase_end+6-$purchase_start;
                    $purchase=trim(substr($desc, $purchase_start+19, $purchase_length-25));                
			
				// Write out the appropriate information if there are items to purchase
			
                if ($wants>$purchase) {
                    if ($list_limit!=1) {echo "<li>";}
                    if (($wants-$purchase)>1) {echo ($wants-$purchase)." x ";}
                    if ($link!="") {echo "<a href=\"".$link."\" target=\"_blank\">";}
                    echo str_replace("&amp;","&",$title);
                    if ($link!="") {echo "</a>";}
                    if ($price_flag=="Yes") {echo " @ ".$price;}
                    if ($list_limit!=1) {echo "</li>\n";}
                    $i++;
                }
			
				// Remove the current software record from the array

				$array=substr($array,$item_end+7);
			}
		}
		
        if ($list_link!="") {echo "<li><a href=\"".$list_link."\" target=\"_blank\">More...</a></li>\n";}
		
	}	
}
?>