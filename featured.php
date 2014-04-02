<?php

$numFeaturedArtists = 10;

require_once "dbconnect.php";
require_once "header.php";

/* 20 April 2009 - JC
 * AVG of no rows (i.e., those produced by the LEFT JOIN) is NULL; MySQL treats
 * NULL values as larger than the expected values (i.e., NULL > floats). IFNULL 
 * solves the problem by explicitly setting NULL values to 0.
 */

 

$sql = <<<SQL
SELECT Artist.id, User.name, IFNULL(avg(ArtistVote.voteId), 0) as average
FROM Artist LEFT JOIN ArtistVote ON Artist.id = ArtistVote.artistId, User
WHERE Artist.id = User.id
GROUP BY Artist.id, User.name
ORDER BY average DESC, RAND() -- randomize artists with same average
LIMIT {$numFeaturedArtists};
SQL;

$result = mysql_query($sql);

$sql2 = "SELECT * FROM User ORDER BY RAND() LIMIT 3;";
$result2 = mysql_query($sql2);

 ?>
 
<div id="content">
<?php
$row = mysql_fetch_array($result2);
$rand_id = $row['id'];
$rand_name = $row['name'];
echo "Featured Artist: ";
?>
<a href="profile.php?id=<?php echo $rand_id; ?>"><?php echo $rand_name; ?></a>
<?
echo "<br />";
echo "<br />";
echo "<br />";


if ($result === false)
{
 ?>
  <div id="error" class="error">
    <?php echo mysql_error(); ?>
  </div> <!-- end error -->
<?php
}
else
{
 ?>
  <table>
    <tr>
      <th colspan="3">Featured Artists</th>
    </tr>
<?php
  for ($i = 1; $row = mysql_fetch_assoc($result); $i++)
  {
	if ($row['id'] != $rand_id) {

 ?>
    <tr>
      <td><?php echo $i; ?></td>
      <td>
        <a href="profile.php?id=<?php echo $row["id"]; ?>"><?php echo $row["name"]; ?></a>
      </td>
      <td style="font-size: smaller; ">
        [<?php printf("%.2f", $row["average"]); ?> / 5.0]
      </td>
    </tr>
<?php
	}
  }
 ?>
  </table>
<?php
}
 ?>
</div> <!-- end content -->
<?php

require_once "footer.php";

 ?>
