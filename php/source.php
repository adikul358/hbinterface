<?php 

$url="https://www.strangeplanet.fr/work/gradient-generator/?c=13:4CAF50:FFEE58:C62828";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
$html = curl_exec($ch);
curl_close($ch);

libxml_use_internal_errors(true);
$doc = new DOMDocument;
$doc->loadHTML( $html);
$xpath = new DOMXpath( $doc);

$node = $xpath->query( '//textarea[@cols="80"]')->item(0);

echo $node->textContent; // This will print **GET THIS TEXT** 
?>
