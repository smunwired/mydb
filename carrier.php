<?php include 'leftmenu.php'; ?>
<?php include 'connect.php'; ?>
<h1>carriers</h1>
<table width="100%">
  <tr>
    <th>id<th>nm<td><a href="crrradf.php">add</a></td>
  </tr>
  <?php
  $sql="select id,nm from bk_carrier";
  //echo $sql;
  foreach($conn->query($sql) as $row) {
    echo "<tr valign=\"top\">
    <td align=\"center\">" . $row['id'] . "</td>
    <td align=\"center\">" . $row['nm'] . "</td>
    <td><a href=\"crrrmdf.php?id=" . $row['id'] . "\">mod</a><a href=\"crrrdlp?id=" . $row['id'] . "\">del</a></td>
    </tr>";
  }
echo "</table>";
include 'includes/bk_links.php';
?>
</body>
</html>
