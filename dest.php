<?php include 'leftmenu.php'; ?>
<?php include 'connect.php'; ?>
<h1>destinations</h1>
<table width="100%">
  <tr>
    <th>id<th>cd<th>nm<td><a href="dstnadf.php">add</a></td>
  </tr>
  <?php
  $sql="select id,cd,nm from bk_destination";
  //echo $sql;
  foreach($conn->query($sql) as $row) {
    echo "<tr valign=\"top\">
    <td align=\"center\">" . $row['id'] . "</td>
    <td align=\"center\">" . $row['cd'] . "</td>
    <td align=\"center\">" . $row['nm'] . "</td>
    <td><a href=\"dstnmdf.php?id=" . $row['id'] . "\">mod</a><a href=\"dstndlp?id=" . $row['id'] . "\">del</a></td>
    </tr>";
  }
echo "</table>";
?>
<?php include 'includes/bk_links.php'; ?>
</body>
</html>
