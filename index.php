<?php
 function get_data($url) {
    $browse = curl_init();
    $timeout = 5;
    curl_setopt($browse, CURLOPT_URL, $url);
    curl_setopt($browse, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($browse, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($browse);
    curl_close($browse);
    return $data;
}

$returned_content = get_data('https://newyork.craigslist.org/search/web?format=rss');

$xml = simplexml_load_string($returned_content) or die("Wanderror");

foreach($xml->item as $item) {
	$item_date = $item->children('http://purl.org/dc/elements/1.1/');
	$item_source = $item->children('http://purl.org/dc/elements/1.1/');
	
    echo '<a href="'.$item->link.'" target="_blank">'.$item->title.'</a>';
	echo '<br><small>'.$item_date->date.'</small><br>';
    echo $item->description . "<hr>";
    echo "<br>";
}
  ?>