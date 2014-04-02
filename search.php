<?php

$resultsPerPage = 10;

require_once "dbconnect.php";
require_once "header.php";

 ?>
<div id="content">
<?php
if (! isset($_GET["q"]))
{
 ?>
  <br />
  No query specified.
<?php
}
else
{
  $offset = (isset($_GET["page"]) ? $_GET["page"] * $resultsPerPage : 0);
  
  $sql = <<<SQL
SELECT id, name
FROM User
-- WHERE MATCH (name, email, username) AGAINST ('{$_GET["q"]}')
WHERE name LIKE '%{$_GET["q"]}%'
   OR email LIKE '%{$_GET["q"]}%'
   OR username LIKE '%{$_GET["q"]}%'
LIMIT {$offset},{$resultsPerPage};
SQL;
  
  $result = mysql_query($sql);
  if ($result === false)
    $message = mysql_error();
  else
  {
    $total = mysql_num_rows($result);
    assert ($total <= $resultsPerPage);
    
    $startNum = $offset + 1;
    $endNum = $offset + $total;
    //assert ($endNum >= $startNum);
    
    if ($total === 0)
      $message = "No search results found.";
    else
    {
      $message = "Search successful, displaying results {$startNum} &ndash; ".
          "{$endNum}.";
    }
  }
 ?>
  <br />
  <div class="message">
    <?php echo $message; ?>
  </div>
  
  <table>
<?php
  if ($result !== false)
  {
    for ($i = $startNum; $row = mysql_fetch_assoc($result); $i++)
    {
 ?>
    <tr>
      <td><?php echo $i; ?></td>
      <td>
        <a href="profile.php?artistId=<?php echo $row["id"]; ?>"><?php echo $row["name"]; ?></a>
      </td>
    </tr>
<?php
    }
    assert (mysql_fetch_assoc($result) === false);
  }
 ?>
  </table>
<?php
}
 ?>
</div> <!-- end content -->
<?php

require_once "footer.php";
