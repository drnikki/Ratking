<?php

include_once("htaccess_include.php");

$csv = fopen("rat_king.csv", "r");
$rows = fgetcsv($csv, 0, ',' );

echo $constant1;

while(!feof($csv)) {
	//open CSV file...
	$rows = fgetcsv($csv);
	$lang_aware = NULL;
	$lang_marker = NULL;
	//if column 5 is true in the CSV, it needs to be LANGUAGE AWARE... so set these variables for later use.
	if ($rows[4] == "TRUE") {
		$lang_aware = "([^/]*[/]*)";
		$lang_marker = "\$1";
	}
	//match and remove qualified divx.com domain if it exists from column 1, and replace it with a carat (regex prefix).
	if (preg_match("/http:\/\/www.divx.com\//i", $rows[0], $match) != 0) {
		$rows[0] = str_replace($match, '^', $rows[0]);
	}
	//strip lang info from the first part of the rewrite rule regex
	if (preg_match("/en\//", $rows[0], $match) != 0) {
		//if column 5 is true in the CSV, it needs to be LANGUAGE AWARE... Which also means column 6 must be false.
		if ($rows[4] == "TRUE" && $rows[5] == "FALSE") {
			$rows[0] = str_replace($match, $lang_aware, $rows[0]);
			$rows[1] = str_replace($match, '', $rows[1]);
		}
		//if column 6 is true in the CSV, it needs to be LANGUAGE SPECIFIC. Duly noted, it should not remove the language from the redirect. Column 5 must also be false.
		if ($rows[4] == "FALSE" && $rows[5] == "TRUE") {
			$rows[0] = $rows[0];
		}
		//if both are false, just replace it with nothing
		if ($rows[4] == "FALSE" && $rows[5] == "FALSE") {
			$rows[0] = str_replace($match, '', $rows[0]);
			$rows[1] = str_replace($match, '', $rows[1]);
		}
	}
	if (preg_match("/fr\//", $rows[0], $match) != 0) {
		//if column 5 is true in the CSV, it needs to be LANGUAGE AWARE...
		if ($rows[4] == "TRUE") {
			$rows[0] = str_replace($match, $lang_aware, $rows[0]);
			$rows[1] = str_replace($match, '', $rows[1]);
		}
		//if column 6 is true in the CSV, it needs to be LANGUAGE SPECIFIC. Duly noted, it should not remove the language from the redirect.
		if ($rows[5] == "TRUE") {
			$rows[0] = $rows[0];
		}
		//otherwise just replace it with nothing
		if ($rows[4] == "FALSE" && $rows[5] == "FALSE") {
			$rows[0] = str_replace($match, '', $rows[0]);
			$rows[1] = str_replace($match, '', $rows[1]);
		}
	}
	if (preg_match("/de\//", $rows[0], $match) != 0) {
		//if column 5 is true in the CSV, it needs to be LANGUAGE AWARE...
		if ($rows[4] == "TRUE") {
			$rows[0] = str_replace($match, $lang_aware, $rows[0]);
			$rows[1] = str_replace($match, '', $rows[1]);
		}
		//if column 6 is true in the CSV, it needs to be LANGUAGE SPECIFIC. Duly noted, it should not remove the language from the redirect.
		if ($rows[5] == "TRUE") {
			$rows[0] = $rows[0];
		}
		//otherwise just replace it with nothing
		if ($rows[4] == "FALSE" && $rows[5] == "FALSE") {
			$rows[0] = str_replace($match, '', $rows[0]);
			$rows[1] = str_replace($match, '', $rows[1]);
		}
	}
	//es currently gets replaced in any link with "technologies" in it - find a way around
	/*if (preg_match("/es\//i", $rows[0], $match) != 0) {
		$rows[0] = str_replace($match, '', $rows[0]);
		$rows[1] = str_replace($match, '', $rows[1]);
	}*/
	if (preg_match("/ja\//", $rows[0], $match) != 0) {
		//if column 5 is true in the CSV, it needs to be LANGUAGE AWARE...
		if ($rows[4] == "TRUE") {
			$rows[0] = str_replace($match, $lang_aware, $rows[0]);
			$rows[1] = str_replace($match, '', $rows[1]);
		}
		//if column 6 is true in the CSV, it needs to be LANGUAGE SPECIFIC. Duly noted, it should not remove the language from the redirect.
		if ($rows[5] == "TRUE") {
			$rows[0] = $rows[0];
		}
		//otherwise just replace it with nothing
		if ($rows[4] == "FALSE" && $rows[5] == "FALSE") {
			$rows[0] = str_replace($match, '', $rows[0]);
			$rows[1] = str_replace($match, '', $rows[1]);
		}
	}
	if (preg_match("/zh-hans\//", $rows[0], $match) != 0) {
		//if column 5 is true in the CSV, it needs to be LANGUAGE AWARE...
		if ($rows[4] == "TRUE") {
			$rows[0] = str_replace($match, $lang_aware, $rows[0]);
			$rows[1] = str_replace($match, '', $rows[1]);
		}
		//if column 6 is true in the CSV, it needs to be LANGUAGE SPECIFIC. Duly noted, it should not remove the language from the redirect.
		if ($rows[5] == "TRUE") {
			$rows[0] = $rows[0];
		}
		//otherwise just replace it with nothing
		if ($rows[4] == "FALSE" && $rows[5] == "FALSE") {
			$rows[0] = str_replace($match, '', $rows[0]);
			$rows[1] = str_replace($match, '', $rows[1]);
		}
	}
	if (preg_match("/zh-hant\//", $rows[0], $match) != 0) {
		//if column 5 is true in the CSV, it needs to be LANGUAGE AWARE...
		if ($rows[4] == "TRUE") {
			$rows[0] = str_replace($match, $lang_aware, $rows[0]);
			$rows[1] = str_replace($match, '', $rows[1]);
		}
		//if column 6 is true in the CSV, it needs to be LANGUAGE SPECIFIC. Duly noted, it should not remove the language from the redirect.
		if ($rows[5] == "TRUE") {
			$rows[0] = $rows[0];
		}
		//otherwise just replace it with nothing
		if ($rows[4] == "FALSE" && $rows[5] == "FALSE") {
			$rows[0] = str_replace($match, '', $rows[0]);
			$rows[1] = str_replace($match, '', $rows[1]);
		}
	}
	if (preg_match("/pt-br\//", $rows[0], $match) != 0) {
		//if column 5 is true in the CSV, it needs to be LANGUAGE AWARE...
		if ($rows[4] == "TRUE") {
			$rows[0] = str_replace($match, $lang_aware, $rows[0]);
			$rows[1] = str_replace($match, '', $rows[1]);
		}
		//if column 6 is true in the CSV, it needs to be LANGUAGE SPECIFIC. Duly noted, it should not remove the language from the redirect.
		if ($rows[5] == "TRUE") {
			$rows[0] = $rows[0];
		}
		//otherwise just replace it with nothing
		if ($rows[4] == "FALSE" && $rows[5] == "FALSE") {
			$rows[0] = str_replace($match, '', $rows[0]);
			$rows[1] = str_replace($match, '', $rows[1]);
		}
	}
	//if its language aware, it needs to replace $1 with the contents of the regex inside the parentheses
	if ($lang_marker != NULL) {
		preg_match("/http:\/\/www.divx.com\//i", $rows[1], $match);
		$rows[1] = str_replace($match, '', $rows[1]);
		$rows[1] = $match[0].$lang_marker.$rows[1];
	}
	//create the redirect
	$redirect = "  RewriteRule ". $rows[0] ."\$ ". $rows[1] ." [R=301,L]\n";
	//Captain, they're hailing us...
	//...on screen
	echo $redirect;
}

echo $constant2;

echo "\n  # DONE - This file was generated by the RAT KING \n";

fclose($csv);

?>