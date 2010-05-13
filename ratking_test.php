<?php

$csv = fopen("rat_king.csv", "r");

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
while(!feof($csv)) {
	$x++;
	//open CSV file...
	$rows = fgetcsv($csv);
	$lang_aware = NULL;
	$lang_marker = NULL;
	//if column 4 is true in the CSV, it needs to be LANGUAGE AWARE... so set this variable for later use.
	if ($rows[3] == "TRUE") {
		$lang_aware = "([^/]*[/]*)";
		$lang_marker = "\$1";
	}
	//match and remove qualified divx.com domain if it exists from column 1, and remove it.
	if (preg_match("/http:\/\/www.divx.com\//i", $rows[0], $match) != 0) {
		$rows[0] = str_replace($match, '', $rows[0]);
	}
	//strip lang info from the first part of the rewrite rule regex.
	if (preg_match("/en\/$/m", $rows[0], $match) != 0) {
		//if column 5 is true in the CSV, it needs to be LANGUAGE AWARE... Which also means column 6 must be false.
		if ($rows[3] == "TRUE" && $rows[4] == "FALSE") {
			$rows[0] = str_replace($match, '', $rows[0]);
			$rows[1] = str_replace($match, '', $rows[1]);
		}
		//if column 6 is true in the CSV, it needs to be LANGUAGE SPECIFIC. Duly noted, it should not remove the language from the redirect. Column 5 must also be false.
		if ($rows[3] == "FALSE" && $rows[4] == "TRUE") {
			$rows[0] = $rows[0];
		}
		//if both are false, just replace it with nothing.
		if ($rows[3] == "FALSE" && $rows[4] == "FALSE") {
			$rows[0] = str_replace($match, '', $rows[0]);
			$rows[1] = str_replace($match, '', $rows[1]);
		}
	}
	if (preg_match("/fr\/$/m", $rows[0], $match) != 0) {
		//if column 5 is true in the CSV, it needs to be LANGUAGE AWARE... Which also means column 6 must be false.
		if ($rows[3] == "TRUE" && $rows[4] == "FALSE") {
			$rows[0] = str_replace($match, '', $rows[0]);
			$rows[1] = str_replace($match, '', $rows[1]);
		}
		//if column 6 is true in the CSV, it needs to be LANGUAGE SPECIFIC. Duly noted, it should not remove the language from the redirect. Column 5 must also be false.
		if ($rows[3] == "FALSE" && $rows[4] == "TRUE") {
			$rows[0] = $rows[0];
		}
		//if both are false, just replace it with nothing.
		if ($rows[3] == "FALSE" && $rows[4] == "FALSE") {
			$rows[0] = str_replace($match, '', $rows[0]);
			$rows[1] = str_replace($match, '', $rows[1]);
		}
	}
	if (preg_match("/de\/$/m", $rows[0], $match) != 0) {
		//if column 5 is true in the CSV, it needs to be LANGUAGE AWARE... Which also means column 6 must be false.
		if ($rows[3] == "TRUE" && $rows[4] == "FALSE") {
			$rows[0] = str_replace($match, '', $rows[0]);
			$rows[1] = str_replace($match, '', $rows[1]);
		}
		//if column 6 is true in the CSV, it needs to be LANGUAGE SPECIFIC. Duly noted, it should not remove the language from the redirect. Column 5 must also be false.
		if ($rows[3] == "FALSE" && $rows[4] == "TRUE") {
			$rows[0] = $rows[0];
		}
		//if both are false, just replace it with nothing.
		if ($rows[3] == "FALSE" && $rows[4] == "FALSE") {
			$rows[0] = str_replace($match, '', $rows[0]);
			$rows[1] = str_replace($match, '', $rows[1]);
		}
	}
	if (preg_match("/es\/$/m", $rows[0], $match) != 0) {
		//if column 5 is true in the CSV, it needs to be LANGUAGE AWARE... Which also means column 6 must be false.
		if ($rows[3] == "TRUE" && $rows[4] == "FALSE") {
			$rows[0] = str_replace($match, '', $rows[0]);
			$rows[1] = str_replace($match, '', $rows[1]);
		}
		//if column 6 is true in the CSV, it needs to be LANGUAGE SPECIFIC. Duly noted, it should not remove the language from the redirect. Column 5 must also be false.
		if ($rows[3] == "FALSE" && $rows[4] == "TRUE") {
			$rows[0] = $rows[0];
		}
		//if both are false, just replace it with nothing.
		if ($rows[3] == "FALSE" && $rows[4] == "FALSE") {
			$rows[0] = str_replace($match, '', $rows[0]);
			$rows[1] = str_replace($match, '', $rows[1]);
		}
	}
	if (preg_match("/ja\/$/m", $rows[0], $match) != 0) {
		//if column 5 is true in the CSV, it needs to be LANGUAGE AWARE... Which also means column 6 must be false.
		if ($rows[3] == "TRUE" && $rows[4] == "FALSE") {
			$rows[0] = str_replace($match, '', $rows[0]);
			$rows[1] = str_replace($match, '', $rows[1]);
		}
		//if column 6 is true in the CSV, it needs to be LANGUAGE SPECIFIC. Duly noted, it should not remove the language from the redirect. Column 5 must also be false.
		if ($rows[3] == "FALSE" && $rows[4] == "TRUE") {
			$rows[0] = $rows[0];
		}
		//if both are false, just replace it with nothing.
		if ($rows[3] == "FALSE" && $rows[4] == "FALSE") {
			$rows[0] = str_replace($match, '', $rows[0]);
			$rows[1] = str_replace($match, '', $rows[1]);
		}
	}
	if (preg_match("/zh-hans\/$/m", $rows[0], $match) != 0) {
		//if column 5 is true in the CSV, it needs to be LANGUAGE AWARE... Which also means column 6 must be false.
		if ($rows[3] == "TRUE" && $rows[4] == "FALSE") {
			$rows[0] = str_replace($match, '', $rows[0]);
			$rows[1] = str_replace($match, '', $rows[1]);
		}
		//if column 6 is true in the CSV, it needs to be LANGUAGE SPECIFIC. Duly noted, it should not remove the language from the redirect. Column 5 must also be false.
		if ($rows[3] == "FALSE" && $rows[4] == "TRUE") {
			$rows[0] = $rows[0];
		}
		//if both are false, just replace it with nothing.
		if ($rows[3] == "FALSE" && $rows[4] == "FALSE") {
			$rows[0] = str_replace($match, '', $rows[0]);
			$rows[1] = str_replace($match, '', $rows[1]);
		}
	}
	if (preg_match("/zh-hant\/$/m", $rows[0], $match) != 0) {
		//if column 5 is true in the CSV, it needs to be LANGUAGE AWARE... Which also means column 6 must be false.
		if ($rows[3] == "TRUE" && $rows[4] == "FALSE") {
			$rows[0] = str_replace($match, '', $rows[0]);
			$rows[1] = str_replace($match, '', $rows[1]);
		}
		//if column 6 is true in the CSV, it needs to be LANGUAGE SPECIFIC. Duly noted, it should not remove the language from the redirect. Column 5 must also be false.
		if ($rows[3] == "FALSE" && $rows[4] == "TRUE") {
			$rows[0] = $rows[0];
		}
		//if both are false, just replace it with nothing.
		if ($rows[3] == "FALSE" && $rows[4] == "FALSE") {
			$rows[0] = str_replace($match, '', $rows[0]);
			$rows[1] = str_replace($match, '', $rows[1]);
		}
	}
	if (preg_match("/pt-br\/$/m", $rows[0], $match) != 0) {
		//if column 5 is true in the CSV, it needs to be LANGUAGE AWARE... Which also means column 6 must be false.
		if ($rows[3] == "TRUE" && $rows[4] == "FALSE") {
			$rows[0] = str_replace($match, '', $rows[0]);
			$rows[1] = str_replace($match, '', $rows[1]);
		}
		//if column 6 is true in the CSV, it needs to be LANGUAGE SPECIFIC. Duly noted, it should not remove the language from the redirect. Column 5 must also be false.
		if ($rows[3] == "FALSE" && $rows[4] == "TRUE") {
			$rows[0] = $rows[0];
		}
		//if both are false, just replace it with nothing.
		if ($rows[3] == "FALSE" && $rows[4] == "FALSE") {
			$rows[0] = str_replace($match, '', $rows[0]);
			$rows[1] = str_replace($match, '', $rows[1]);
		}
	}
	//if its language aware, it needs to replace $1 with the contents of the regex inside the parentheses... only on drupalized i18n domains, though. Which basically means only www.divx.com
	if ($lang_marker != NULL && preg_match("/http:\/\/www.divx.com\//", $rows[1], $match)) {
		$rows[1] = str_replace($match, '', $rows[1]);
		$rows[1] = $match[0].$lang_marker.$rows[1];
	}
	//create the redirect
	$redirect = "  RewriteRule ^".$lang_aware.addcslashes($rows[0],".*?+[](){}|") ."\$ ". $rows[1] ." [R=301,L]\n";
	//Captain, they're hailing us...
	//...on screen

    $tehurl = "http://www.divx.com/". $rows[0];
      $http = curl_init($tehurl);
      curl_setopt_array( $http, $options );
      	//OLYMPIC CURLING
        $result = curl_exec($http);
        $http_status = curl_getinfo($http, CURLINFO_HTTP_CODE);
        $last_link = curl_getinfo($http, CURLINFO_EFFECTIVE_URL);
        $output =  "\nStatus: " . $http_status . " ¢ Last Link: ";
        $output .= $last_link . " ¢ URL Input: ";
        $output .=  $tehurl . " ¢ Intended URL: ";
        $output .=  $rows[1];
        if ($last_link == $rows[1]){
        	$output .=  " ¢ Match";
        }
        else {
        	$output .=  " ~ No Match";
        }
        $codez[$http_status] .= $output;
        echo "\n" .$output;
}
echo "--------------------------------------------";
var_dump($codez);

echo "\n\n\n\n" . $x

?>