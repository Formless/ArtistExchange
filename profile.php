<html>

<body>
<?php
require_once "dbconnect.php";

$headerOptions = array(
  "title" => "Profile"
);
require_once "header.php";
?>
<head>
<script type="text/javascript">
function rename1(str)
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {

    document.getElementById("updated").innerHTML="Name changed successfully";
    }
  }
  alert(document.getElementById("newname").value);
xmlhttp.open("GET","",true);
xmlhttp.send();
}


function rename(str)
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
		if(xmlhttp.responseText == "yay") {
			document.getElementById("name").innerHTML="<h1>"+document.getElementById("newname").value+"</h1>";
			document.getElementById("updated").innerHTML="Name changed successfully";
		}
    }
  }
xmlhttp.open("GET","renameuser.php?userId=" + str + "&newname=" + document.getElementById("newname").value,true);
xmlhttp.send();
}


</script>
</head>
<?php
//$username = $_SESSION["userName"];
define ("MAX_FILE_SIZE" , 16*1024*1024) ; // define constant , 16 MiB

if (isset($_FILES["photoFile"])){
	$username = $_SESSION["userName"];
	$file = $_FILES["photoFile"];
	if ($file["error"] === UPLOAD_ERR_FORM_SIZE || $file["size"] > MAX_FILE_SIZE)
		$error = "File size exceeds maximum (".MAX_FILE_SIZE." bytes)";
	else if ($file["error"] !== UPLOAD_ERR_OK)
		$error = "Error uploading file (code = ". $file["error"].")";
	else {
		$fileName = $username; // username previously retrieved from database
		// parse file extension from original name and add to new file name
		$fileExtStartIndex = strrpos($file["name"], ".");
		if ($fileExtStartIndex !== false)
			$fileName .= substr($file["name"], $fileExtStartIndex);
		$success = move_uploaded_file($file["tmp_name"], "uploads/photos/".$fileName);
		if ($success === false)
			$error = "Error moving file";
		else {
			// update database with ( new ) file name and mime type ( if applicable )
			
			$sql = "SELECT photoFile from Artist WHERE id='".$_SESSION["userId"]."'";
			$result = mysql_query($sql);
			
			if ($result !== false) {
			$row = mysql_fetch_assoc($result);
				if ($row !== false) {
					$sql = "UPDATE Artist SET photoFile='".$fileName."' WHERE id='".$_SESSION["userId"]."'";
					$result = mysql_query($sql);		
				}
				
				else {
					$sql = "INSERT INTO Artist(id, photoFile) VALUES('".$_SESSION["userId"]."', '".$fileName."')";  
					$result = mysql_query($sql);
				}
			}
			
		}
	}

}


if (isset($_FILES["musicFile"])){
	$username = $_SESSION["userName"];
	$file = $_FILES["musicFile"];
	if ($file["error"] === UPLOAD_ERR_FORM_SIZE || $file["size"] > MAX_FILE_SIZE)
		$error = "File size exceeds maximum (".MAX_FILE_SIZE." bytes)";
	else if ($file["error"] !== UPLOAD_ERR_OK)
		$error = "Error uploading file (code = ". $file["error"].")";
	else {
		$fileName = $file["name"]; // username previously retrieved from database
		// parse file extension from original name and add to new file name
		
		$success = move_uploaded_file($file["tmp_name"], "uploads/music/".$fileName);
		if ($success === false)
			$error = "Error moving file";
		else {
			// update database with ( new ) file name and mime type ( if applicable )
			$fileMime = mysql_real_escape_string($file["type"]);
			$sql = "SELECT musicFile from Artist WHERE id='".$_SESSION["userId"]."'";
			$result = mysql_query($sql);
			
			if ($result !== false) {
			$row = mysql_fetch_assoc($result);
				if ($row !== false) {
					$sql = "UPDATE Artist SET musicFile='".$fileName."', musicMime='".$fileMime."' WHERE id='".$_SESSION["userId"]."'";
					$result = mysql_query($sql);		
				}
				
				else {
					$sql = "INSERT INTO Artist(id, musicFile, musicMime) VALUES('".$_SESSION["userId"]."', '".$fileName."', '".$fileMime."')";  
					$result = mysql_query($sql);
				}
			}
			
		}
	}

}


if (isset($_POST["vote"])) {
	if (isset($_POST["delete"])) {
		$sql = "DELETE FROM ArtistVote WHERE userId='".$_SESSION["userId"]."' AND artistId='".$_SESSION["artistId"]."'";
		$result = mysql_query($sql);
		echo "Vote removed successfully";
	}
	
	else {
		
		$sql = "SELECT voteId from ArtistVote WHERE userID='".$_SESSION["userId"]."' AND artistId='".$_SESSION["artistId"]."'";
		$result = mysql_query($sql);
		
		if ($result !== false) {
			$row = mysql_fetch_assoc($result);
			if ($row !== false) {
				$sql = "UPDATE ArtistVote SET voteId='".$_POST["vote"]."' WHERE userId='".$_SESSION["userId"]."' AND artistId='".$_SESSION["artistId"]."'";
				$result = mysql_query($sql);
				echo "Vote cast successfully";
			
			}
			
			else {
				$sql = "INSERT INTO ArtistVote(userId, artistId, voteId) VALUES('".$_SESSION["userId"]."', '".$_SESSION["artistId"]."', '".$_POST["vote"]."')";
				$result = mysql_query($sql);
				echo "Vote cast successfully";
			}
		}
		
		
	}
	
}
?>


<div id="content">
  
	
 <div id="name"> <h1><?php /*  print artist's name */
  
  
  if(!isset($_GET['id'])) {
	$artistId = mysql_real_escape_string($_SESSION["userId"]);	// own
  }
  
  else {
	$artistId = $_GET['id'];	// other
  }
  
  if (isset($_POST["vote"])) {
	$artistId = $_SESSION["artistId"];
  }
  session_start();
  $_SESSION["artistId"] = $artistId;
  session_commit();
  $sql = "SELECT name FROM User WHERE id='$artistId'";
  $result = mysql_query($sql);
  $row = mysql_fetch_assoc($result);
  if($row===false){
	echo "No artists exist with the specified id";
  }
  else{
	$name = $row["name"];
	
		
			echo $name;
  }
  
  ?></h1></div>
  <?php 
	if ($artistId === $_SESSION["userId"]) {
		?>
		<form method="get" id="renameForm">
            <input id="newname" name ="newname" type ="text" />
			<button type="button" onclick="rename(<?php echo $_SESSION["userId"];?>)">Update Name</button>
			
		</form><?php
	}
  
  ?>
  <div id="updated"><br></div>
  <?php
 
  $sql = "SELECT photoFile FROM Artist WHERE id='$artistId'";
  $result = mysql_query($sql);
  $row = mysql_fetch_assoc($result);
  
  echo nl2br("Current photo:\n");

  if($row===false){
	echo nl2br("No current photo");
	
  }
  else{
	echo "\n";
	$photoFile = $row["photoFile"];
	
	if($photoFile !== null){	?>

		<img id="photo" src="uploads/photos/<?php echo $photoFile; ?>" alt="Artist's photo"/> 
	<?php
		echo nl2br("\n");
	}
	else
	
		echo nl2br("No current photo");
  }
  
  if ($artistId === $_SESSION["userId"]) {
  ?>
 
  <form method="post" action="profile.php" id="photoForm" enctype="multipart/form-data">
	
	<input name="MAX_FILE_SIZE" type="hidden" value="16777216"/>
	<label for="photoFileInput">Upload your photo</label><br/>
	<input id="photoFileInput" name="photoFile" type="file"/>
	<input id="photoButton" type ="submit" value ="Upload"/>
  </form>
  
  <?php
  }
  
  
  //music
  $sql = "SELECT musicFile FROM Artist WHERE id='$artistId'";
  $result = mysql_query($sql);
  $row = mysql_fetch_assoc($result);
  echo "<br>";
  echo nl2br("Current music:\n");
  //echo $sql;
  if($row===false){
	echo nl2br("No current music");
  }
  else{
	echo "\n";
	$musicFile = $row["musicFile"];
	$sql = "SELECT musicMime FROM Artist WHERE id='$artistId'";
	$result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	$musicMime = $row["musicMime"];
	//echo $musicMime;
	//echo $musicFile;
	if($musicFile !== null){ ?>
		
		<object id="music" type="<?php echo $musicMime; ?>" data="uploads/music/<?php echo $musicFile; ?>" width="320" height="240">
		<param name="src" value="<?php echo $musicFile;?>" />
		<param name="autoplay" value="false" />
		<param name="autoStart" value="0" />
		</object>
	<?php
	}
	else
		echo nl2br("No current music");
  }
   
   if ($artistId === $_SESSION["userId"]) { ?>
 
  <form method="post" action="profile.php" id="musicForm" enctype="multipart/form-data">
	
	<input name="MAX_FILE_SIZE" type="hidden" value="16777216"/>
	<label for="musicFileInput">Upload your music</label><br/>
	<input id="musicFileInput" name="musicFile" type="file"/>
	<input id="musicButton" type ="submit" value ="Upload"/>
  </form>
  
  <br>
  
    <?php 
	
	$sql = "SELECT favorite FROM User WHERE id = ".$_SESSION["userId"].";";
	$result = mysql_query($sql);
	$favoriteId = NULL;
	
	if ($result !== false) {
		$row = mysql_fetch_assoc($result);
		if ($row !== false) {
			$favoriteId = $row["favorite"];
		}
	}
	
	$sql = "SELECT * FROM User;"; 
	$result = mysql_query($sql) or die(mysql_error());
	?>
  <h3>Favorite Artist</h3>

 
  
  <form method="post" action="favselect.php">
  <select id="favorite" name="favorite">
	<?php
	

	for ($i = 1; $row = mysql_fetch_assoc($result); $i++) {
	 ?><option value="<?php echo $row['id']; ?>" <?php if($favoriteId == $row["id"]) echo "selected=\"selected\"";?>><?php echo $row['name'] ?></option><?php 
	}
  ?>
  </select>
  <input type="submit" value="submit" name="submit"><br />
  </form>
<?php
  }
   
  
  //feedback form
  if ($artistId !== $_SESSION["userId"]) {
  ?>
  <div>
   <br />
   <h3>Rate this artist</h3>
   <form method="post" action="<?php echo $_SERVER["PHP_SELF"]?>" id="voteForm">
    <?php
	$sql2 = "SELECT * FROM Vote";
    $vote_result = mysql_query($sql2);
	
	$sql3 = "SELECT voteId FROM ArtistVote WHERE userId='".$_SESSION["userId"]."' AND artistId='$artistId'";
	$result2 = mysql_query($sql3);
	$voteId = NULL;
	if ($result2 !== false) {
			$result3 = mysql_fetch_assoc($result2);
			if ($result3 !== false) {
				$voteId = $result3["voteId"];
			}
	}
	
	while ($values = mysql_fetch_assoc($vote_result)) {
		if ($values !== false) { 
		
	
		?>
		
			<input id="voteInput-<?php echo $values["id"]?>" name ="vote" type ="radio" value="<?php echo $values["id"]?>" <?php if($voteId == $values["id"]) echo "checked=\"checked\"";?>/>
            <label for ="voteInput-<?php echo $values["id"]?>"><?php echo $values["description"] ?></label><br />
        <?php    
		}
    }   
	
	if ($voteId !== null) {
	
	?>   
	
		<input id="deleteVoteInput" name ="delete" type ="checkbox" value="3"/>
			
			<label for ="deleteVoteInput">Delete vote</label><br />
  	<?php 
	}
	?>
            <input id="voteButton" type ="submit" value ="Vote!"/>
      </form>

  </div>
  <?php 
  } ?>
  
</div> <!-- end content -->
<?php
require_once "footer.php";
?>
</body>
</html>
