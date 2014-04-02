<?php

/* Open database connection. Following submission of the registration form, 
 * the database must be queried to insert the new user.
 */
// INSERT CODE HERE <-----------------------------------------------------------
require_once "dbconnect.php";

$error = false;
/* Ensure all form variables (i.e., name, email, username, password, and 
 * password confirmation are set.
 */
if (isset($_POST["name"], $_POST["email"], $_POST["username"], 
      $_POST["password"], $_POST["confirmation"]))
{
  $username = mysql_real_escape_string($_POST["username"]);
  $password = mysql_real_escape_string(md5($_POST["password"]));	// hash password
  
  // verify password and confirmation match
  if ($_POST["password"] !== $_POST["confirmation"])
    $error = "Password and password confirmation do not match";
  
  if ($error === false)
  {
    // query database to see if username is already in use
    // INSERT CODE HERE <-------------------------------------------------------
    $sql = "SELECT id FROM User WHERE username = '".$username."';";
	$result = mysql_query($sql);
		
    if (mysql_num_rows($result) > 0)
	  //echo mysql_num_rows($result);
      $error = "Username already registered";
  }
  
  if ($error === false)
  {
    // insert user into database
    // INSERT CODE HERE <-------------------------------------------------------
    $sql = "INSERT INTO User (name, email, username, password) VALUES ('".$_POST["name"]."', '".$_POST["email"]."', '".$username."', '".$password."');";
		
    $result = mysql_query($sql);

    if ($result !== false)
    {
	  $lastID = mysql_insert_id();
	  //$userId = $row[$lastID];
	  
	  session_start();
	  $_SESSION["userId"] = $lastID;
	  session_commit();
      // redirect to profile
      header("Location: profile.php");
	  exit; 	// ensure script terminates immediately 
    }
    else
    {
      $error = "We're sorry, but an unexpected error prevented us from ".
          "finalizing your registration.";
      // DEBUGGING ONLY !!! REMOVE AFTER HAND TESTING!
      $error = mysql_error(); // retrieve error message from server
    }
     
  }
}
else if (! empty($_POST))
  $error = "Missing required information";

// set the page title
$headerOptions = array("title"=>"Registration");
include "header.php";
?>
<div id="content">
  
<?php
if ($error !== false)
{
 ?>
  <div id="error" class="message">
    <?php echo $error; ?>
  </div>
<?php
}
 ?>
  <br />
  <!-- INSERT REGISTRATION FORM HERE -->
  <script type = "text/javascript" src = "scripts/register.js" defer = "defer" > </script>

  <form method="post" action="register.php" id="registerForm" onsubmit = "return checkForm();">
     
            <label for ="nameInput">Name</label><br />
            <input id="nameInput" name ="name" type ="text" value=""/><br />
            
            <label for ="emailInput">Email</label><br />
            <input id="emailInput" name ="email" type ="text"/><br />
            
            <label for ="usernameInput">Username</label><br />
            <input id="usernameInput" name ="username" type ="text"/><br />
            
            <label for ="passwordInput">Password</label><br />
            <input id="passwordInput" name ="password" type ="password"/><br />
            
            <label for ="confirmationInput">Confirm Password</label><br />
            <input id="confirmationInput" name ="confirmation" type ="password"/><br />
            
            <input id="registerButton" type ="submit" value ="Register"/>
            
            
          
      </form>
  
  
  
  
</div> <!-- end content -->
<?php
include "footer.php";
 ?>
