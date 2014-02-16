<?php

namespace Volke\Bundle\WebscraperBundle;

include 'webscraper.php';

	$scrapedpage = new Webscraper();
    
    /*$scraped_page = $scrapedpage -> curl("http://www.myhome.ie/residential/dublin/house-for-sale");   

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
*/

    $url = "http://www.myhome.ie/residential/dublin/house-for-sale";
    $scrapeFrom = '<ul id="results">';
    $scrapeTo = '<div class="searchResultsBottomLeaderboard">';
    $resultSeperator = '<li id="resultItem" class="premium">';
    $urlStart = '<a class="address ResidentialForSale" href="';      
 	$urlStop  = '">';      
 	$nextCode = 'Next &gt;';    
 	$nextStart = 'rel="next" href="';   
 	$nextStop = '">Next &gt;</a>';
    $lastpageIndicator = 'class="disabled next"';



    $urlList = $scrapedpage -> paged_scraping(	$url,
												$scrapeFrom,
												$scrapeTo,
												$resultSeperator,
												$urlStart,
												$urlStop,
												$nextCode,
												$nextStart,
												$nextStop,
                                                $lastpageIndicator
												);

    var_dump($urlList);


?>