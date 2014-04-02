<?php
require_once "dbconnect.php";
require_once "header.php";

//echo "hello";

$userId = $_SESSION["userId"];


if (isset($_POST["favorite"])) {

	$favorite = $_POST["favorite"];
	$sql = "UPDATE User SET favorite='".$favorite."' WHERE id='".$userId."';";
	//echo $sql;
	$result = mysql_query($sql) or die(mysql_error());
}

?>
<script type="text/javascript">
<!--
// redirect to profile page after 100 ms
setTimeout("window.location = 'profile.php';", 100);
//-->
</script>
