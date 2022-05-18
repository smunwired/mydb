<?php include 'leftmenu.php'; ?>
<?php include 'connect.php'; ?>
<h1>bktypes</h1>
<table width="100%">
  <tr>
    <th>id<th>nm<td><a href="bktypadf.php">add</a></td>
  </tr>
  <?php
  $sql="select id,nm from bk_booking_type";
  //echo $sql;
  foreach($conn->query($sql) as $row) {
    echo "<tr valign=\"top\">
    <td align=\"center\">" . $row['id'] . "</td>
    <td align=\"center\">" . $row['nm'] . "</td>
    <td><a href=\"bktypmdf.php?id=" . $row['id'] . "\">mod</a> <a href=\"bktypdlp.php?id=" . $row['id'] . "\">del</a></td>
    </tr>";
  }
echo "</table>";
include 'includes/bk_links.php';
?>
</body>
</html>
