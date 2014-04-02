<?php
require_once "dbconnect.php";

$q=$_GET["newname"];
$userId = $_GET["userId"];

$sql="UPDATE User SET name='".$q."' WHERE id='".$userId."';";
$result = mysql_query($sql);

if($result)
echo "yay";


?>