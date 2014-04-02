<?php

// start or resume session
session_start();
session_commit();

/* Ensure that the user is either logged in or this is a "public" page that does
 * not require authentication. If this page is not public and the user is not 
 * logged in, redirect to login.php (which currently will redirect automatically
 * to the site homepage).
 */
// INSERT CODE HERE <-----------------------------------------------------------

$PUBLIC_PAGE[1] = "/~em2ae/cs4753/artist-exchange/index.php";
$PUBLIC_PAGE[2] = "/~em2ae/cs4753/artist-exchange/register.php";
$PUBLIC_PAGE[3] = "/~em2ae/cs4753/artist-exchange/login.php";
$PUBLIC_PAGE[4] = "/~em2ae/cs4753/artist-exchange/logout.php";

$ispresent = array_search($_SERVER["PHP_SELF"], $PUBLIC_PAGE);

if (!isset($_SESSION["userId"]) && $ispresent == false) {
	header("Location: login.php");
	exit; 	// ensure script terminates immediately
}


// open a database connection for the scripts that include this one
require_once "dbconnect.php";

/* headerOptions allows the (including) page to specify options to the header.
 * Options (key values of the array):
 *   title: page title (e.g., "title" => "INSERT PAGE TITLE HERE")
 */
if (! isset($headerOptions)) // not initialized, initialize with empty array
  $headerOptions = array();
else if (! is_array($headerOptions)) // not an array, raise warning
  trigger_error("Expecting header options to be an array", E_USER_WARNING);

echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  
  <title>Artist eXchange<?php if (isset($headerOptions["title"])) echo " :: {$headerOptions["title"]}"; ?></title>
  
  <!-- stylesheets -->
  <link rel="stylesheet" href="styles.css" type="text/css" />
</head>

<body>

<div id="masthead">
  <a href="index.php" style="text-decoration: none;">
    <img src="images/logo.png" style="border-style: none;" alt="Artist eXchange Logo" />
    <span style="font-size: 300%; letter-spacing: .25em;">
      <span style="color: #004499;">Artist</span>
      <span style="color: #000000;">eXchange</span>
    </span>
  </a>
</div> <!-- end masthead -->
