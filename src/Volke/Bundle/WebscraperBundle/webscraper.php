<?php

namespace Volke\Bundle\WebscraperBundle;

class Webscraper 
{
	
/**
 * Defining the basic cURL function
 * @param  [string] $url [url of the website that should be scraped]
 * @return [obj] [html code returned from the $url]
 */
    function curl($url) {

    	
        $options = Array( // Assigning cURL options to an array
            CURLOPT_RETURNTRANSFER => TRUE,  // Setting cURL's option to return the webpage data
            CURLOPT_FOLLOWLOCATION => TRUE,  // Setting cURL to follow 'location' HTTP headers
            CURLOPT_AUTOREFERER => TRUE, // Automatically set the referer where following 'location' HTTP headers
            CURLOPT_CONNECTTIMEOUT => 120,   // Setting the amount of time (in seconds) before the request times out
            CURLOPT_TIMEOUT => 120,  // Setting the maximum amount of time for cURL to execute queries
            CURLOPT_MAXREDIRS => 10, // Setting the maximum number of redirections to follow
            CURLOPT_USERAGENT => "Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.1a2pre) Gecko/2008073000 Shredder/3.0a2pre ThunderBrowse/3.2.1.8",  // Setting the useragent
            CURLOPT_URL => $url, // Setting cURL's URL option with the $url variable passed into the function
            );

        //run the curl method
        $ch = curl_init();  
        curl_setopt_array($ch, $options);   // Setting cURL's options using the previously assigned array data in $options
        $data = curl_exec($ch); 
        curl_close($ch);   
        return $data;  
    }

/**
 *The basic scraping function
 * @param  [string] $data  [html code to be parsed]
 * @param  [string] $start [The start point for the data scraped]
 * @param  [string] $end   [The end point for the data scraped]
 * @return [string]        [Data between html tags]
 */
   function scrape_between($data, $start, $end){
    	$data = stristr($data, $start); 
    	$data = substr($data, strlen($start)); 
    	$stop = stripos($data, $end);   
    	$data = substr($data, 0, $stop);   
    	return $data;   
    }

/**
 * [paged_scraping description]
 * @param  [string] $siteUrl         [Url to be scraped]
 * @param  [string] $scrapeFrom      [Delimiter for where the scrape should start]
 * @param  [string] $scrapeTo        [Delimiter for where the scrape should end]
 * @param  [string] $resultSeperator [What seperates the results on the page]
 * @param  [string] $urlStart        [The text before an url]
 * @param  [string] $urlStop         [The text where the url stops]
 * @param  [string] $nextCode        [The html code for the next button]
 * @param  [string] $nextStart       [The text before an "next" url]
 * @param  [string] $nextStop        [The text where the "next" url stops]
 * @param  [string] $lastpageIndicator[The text that indicates we're at the last page]
 * @return [array]                  [An array of all urls on all pages]
 */
    function paged_scraping($siteUrl, 
    	$scrapeFrom, 
      	$scrapeTo, 
    	$resultSeperator, 
    	$urlStart, 
    	$urlStop, 
    	$nextCode, 
    	$nextStart, 
    	$nextStop, 
    	$lastpageIndicator){
    	
    	$continue = TRUE;   // Assigning a boolean value of TRUE to the $continue variable. This will stay true as long as there are more pages
	    $url = $siteUrl;    // Assigning the URL we want to scrape to the variable $url

	    // While $continue is TRUE, i.e. there are more search results pages
	    while ($continue == TRUE) {

	        $results_page = $this -> curl($url); // Downloading the results page using our curl() funtion

	        $results_page = $this -> scrape_between($results_page, $scrapeFrom, $scrapeTo); // Scraping out only the middle section of the results page that contains our results

	        $separate_results = explode($resultSeperator, $results_page);   // Exploding the results into separate parts into an array

	        // For each separate result, scrape the URL
	        foreach ($separate_results as $separate_result) {
	        	if ($separate_result != "") {
	                $results_urls[] = $this -> scrape_between($separate_result, $urlStart, $urlStop); // Scraping the page ID number and appending to the IMDb URL - Adding this URL to our URL array
	            }
	        }

	        // Searching for a 'Next' link. If it exists scrape the url and set it as $url for the next loop of the scraper
	        if (!strpos($results_page, $lastpageIndicator)) {
		        if (strpos($results_page, $nextCode)) {
		        	$continue = TRUE;
		        	$urlAppend = $this -> scrape_between($results_page, $nextStart, $nextStop);
		        	
		        	if (isset($urlAppend)){
			        	$url = $siteUrl . $urlAppend;
			        } 
			        else {
			        	$continue = FALSE;
			        }
		        } 
		    }
	        else {
	         	$continue = FALSE;  // Setting $continue to FALSE if there's no 'Next' link
	        }
	        sleep(rand(3,5));   // Sleep for 3 to 5 seconds. Useful if not using proxies. We don't want to get into trouble.
	    }
	    return $results_urls;
	}
}

?>