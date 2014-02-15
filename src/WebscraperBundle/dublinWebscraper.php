<?php

include 'webscraper.php';

	$scrapedpage = new Webscraper();
    $scraped_page = $scrapedpage -> curl("http://www.myhome.ie/residential/dublin/house-for-sale");   

    //$scraped_data = $scrapedpage -> scrape_between($scraped_page, "<li>", "</li>");   
    


    $scraped_data = explode("<div class=\"faveStar", $scraped_page);
     
    foreach ($scraped_data as $data){ 
    	if ($data === $scraped_data[0]){
    		continue;
    	}
    	else {
    		echo $data; // Echoing $scraped data, should show "The Internet Movie Database (IMDb)"
    	}
    }
?>