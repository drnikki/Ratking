<?php

include_once 'links.php';
    $options = array(
        CURLOPT_RETURNTRANSFER => true,     // return web page
        CURLOPT_HEADER         => true,    // don't return headers
        CURLOPT_FOLLOWLOCATION => true,     // follow redirects
        CURLOPT_ENCODING       => "",       // handle all encodings
        CURLOPT_USERAGENT      => "spider", // who am i
        CURLOPT_AUTOREFERER    => false,     // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
        CURLOPT_TIMEOUT        => 120,      // timeout on response
        CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
);

$x = 0;
$codez = array();
foreach($links as $link => $array) {
  $x++;
  //if($x < 50){
    if(!preg_match('/download\.divx\.com/', $array['dest'])) {
    $tehurl = "http://go-origin.divx.com/". $link;
      $http = curl_init($tehurl);
      curl_setopt_array( $http, $options );
      // do your curl thing here
        $result = curl_exec($http);
        $http_status = curl_getinfo($http, CURLINFO_HTTP_CODE);
        $output =  "\n" . $http_status . " -- ";  
        $output .=  $tehurl . " -- ";

        $output .=  $array['dest'];
        $codez[$http_status] .= $output;
        //echo " . ";
        echo "\n" .$output;
      }
  //}
}
echo "--------------------------------------------";
var_dump($codez);

echo "\n\n\n\n" . $x;

?>