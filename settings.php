<?php

/* Open database connection. Following submission of the registration form, 
 * the database must be queried to insert the new user.
 */
// INSERT CODE HERE <-----------------------------------------------------------
require_once "dbconnect.php";
require_once "header.php";

$error = false;

$userId = $_SESSION["userId"];
$userName = $_SESSION["userName"];
//echo "UserId: " . $userId;
//echo "<br />";

/* Ensure all necessary form variables (email, old password, new password, and 
 * password confirmation are set.
 */

if (isset($_POST["oldpassword"])) {
 	$oldpassword = mysql_real_escape_string(md5($_POST["oldpassword"]));
			  
	  
		$sql0 = "SELECT name FROM User WHERE id = '".$userId."' AND password = '".$oldpassword."';";
		$result0 = mysql_query($sql0);
		if ($result0 !== false) {
			$row0 = mysql_fetch_array($result0);
			if ($row0 !== false) {

		
	if($_POST["email"] != "") {
		echo "Email changed successfully. ";
		$email = $_POST["email"];
		if ($error === false) {
			
			// query database to see if username is already in use
			// INSERT CODE HERE <-------------------------------------------------------
			$sql = "SELECT id FROM User WHERE email = '".$email."';";
			$result = mysql_query($sql);
				
			if (mysql_num_rows($result) > 0) {
			  //echo mysql_num_rows($result);
			  $error = "Email already registered";
			}
			
			else {
				//echo "Terps";
				$sql = "UPDATE User SET email='".$email."' WHERE id='".$userId."';";
				$result = mysql_query($sql) or die(mysql_error());
			}
			
		}
	}
	 
	if ($_POST["password"] != "" && $_POST["confirmation"] != "")
	{
		//echo "Password!";
		$password = mysql_real_escape_string(md5($_POST["password"]));	// hash password
	  
	  

		// verify password and confirmation match
		if ($_POST["password"] !== $_POST["confirmation"]) {
			$error = "Password and password confirmation do not match";
			echo "Error: " . $error;
		}
		
		if ($error == false) {
			$sql = "UPDATE User SET password='".$password."' WHERE id='".$userId."';";
			$result = mysql_query($sql) or die(mysql_error());
			echo "Password changed successfully!";
		}
		
	}
		}
		}

}





// set the page title
$headerOptions = array("title"=>"Settings");
//include "header.php";
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
  <script type = "text/javascript" src = "scripts/settings.js" defer = "defer" > </script>

	<form method="post" action="settings.php" id="settingsForm" onsubmit = "return checkForm();">
     
                      
            <label for ="emailInput">Change Email</label><br />
            <input id="emailInput" name ="email" type ="text"/><br />
            
            <label for ="oldPasswordInput">Old Password</label><br />
            <input id="oldPasswordInput" name ="oldpassword" type ="password"/><br />
            
            <label for ="passwordInput">New Password</label><br />
            <input id="passwordInput" name ="password" type ="password"/><br />
            
            <label for ="confirmationInput">Confirm New Password</label><br />
            <input id="confirmationInput" name ="confirmation" type ="password"/><br />
            
            <input id="registerButton" type ="submit" value ="Submit"/>
            
            
          
   </form>
  
  
  
  
</div> <!-- end content -->
<?php
include "footer.php";
 ?>
