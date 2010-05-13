<?php

include_once("htaccess_include.php");

$csv = fopen("rat_king.csv", "r");

echo $constant1;
$x = 0;
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
	//create the redirect, if it exists
	if ($rows[0] != NULL && $rows[1] != NULL){
	$redirect = "  RewriteRule ^".$lang_aware.addcslashes($rows[0],".*?+[](){}|") ."\$ ". $rows[1] ." [R=301,L]\n";
	//Captain, they're hailing us...
	//...on screen
	echo $redirect;
	}
}

echo $constant2;

echo "\n  # DONE - This file was generated by the RAT KING \n";

fclose($csv);

?>