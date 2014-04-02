<?php

// unset "isLoggedIn" token
// INSERT CODE HERE <-----------------------------------------------------------
//setcookie("userId", false, time() - 3600);
session_start();
unset($_SESSION["userId"]);
session_unset(); // free session variables

if (isset($_COOKIE[session_name()]))  // session id saved in cookie
	setcookie(session_name(), false, time() - 3600); // invalidate session cookie
session_destroy(); // destroy data associated with current session


require_once "header.php";
 ?>
<script type="text/javascript">
<!--
// redirect to home page after 2500 ms
setTimeout("window.location = 'index.php';", 2500);
//-->
</script>

<div id="content">
  <br />
  You have logged out successfully.
</div> <!-- end content -->
<?php

require_once "footer.php";

 ?>
