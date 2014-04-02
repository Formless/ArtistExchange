<?php

/* Open database connection. Verification of login should redirect to 
 * profile.php if the login is correct, and header.php outputs the HTML headers,
 * which does not allow the redirect to take place (header must be called 
 * BEFORE a script produces output).
 */
// INSERT CODE HERE <-----------------------------------------------------------
require_once "dbconnect.php";

/* If $_POST["username"] and $_POST["password"] aren't set, then we've reached 
 * this page in error (i.e., nothing should link to this page except the login 
 * form. Redirect to the site homepage (index.php).
 *
 * NOTE that if the user is already logged in and reaches this page, the 
 * redirection won't be a problem -- index.php should redirect to profile.php 
 * if the user is already logged in.
 */

if (!isset($_POST["username"]) || !isset($_POST["password"])) {
	header("Location: index.php");
	exit; 	// ensure script terminates immediately 
}
 
// retrieve the username and password from $_POST
// INSERT CODE HERE <-----------------------------------------------------------
$username = mysql_real_escape_string($_POST["username"]);
$password = mysql_real_escape_string(md5($_POST["password"]));	// hash password

// select user id from database (if login credentials valid)
// INSERT CODE HERE <-----------------------------------------------------------
$sql = "SELECT id FROM User WHERE username = '".$username."' AND password = '".$password."';";
$result = mysql_query($sql);
if ($result !== false)
{
	$row = mysql_fetch_assoc($result);
	if ($row !== false)
	{
		$userId = $row["id"];
		
		// set login token
		$expiration = time() + 3600; // expire 1 hour from now
		//setcookie("userId", $userId, $expiration);
		session_start();
		$_SESSION["userId"] = $userId;
		$_SESSION["userName"] = $userName;
		session_commit();
		
		
		// redirect to profile.php
		header("Location: profile.php");
		exit; 	// ensure script terminates immediately
	}
}

/* A correct query should produce exactly 0 or 1 rows from the database 
 * (returning 2+ rows indicates an error in the query or database (e.g., 
 * usernames aren't guaranteed unique)). If exactly 1 row was returned, store 
 * the user's id, which is used to as the "isLoggedIn" token; otherwise, display
 * an error message to the user.
 */
// INSERT CODE HERE <-----------------------------------------------------------

require_once "header.php";
 ?>
<div id="content">
  <br />
  Error logging in. Invalid username or password.
</div> <!-- end content -->
<?php
  require_once "footer.php";
