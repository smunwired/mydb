<?php include 'leftmenu.php'; ?>
<h1>journey add form</h1>

<?php
include 'connect.php';
?>
<form name="jrnyaddf" method="post" action="jrnyaddp.php">
<table>
<tr><td>date of travel</td><td><input type="text" name="prefix"></input></td></tr>
<tr><td>carrier</td>
<td>
<?php
$sql = "select id,nm from fl_carrier order by 2";
echo "<select name=\"crr\">";
foreach($conn->query($sql) as $row) {
        echo "<option value=\"". $row['id'] . "\"";
          echo ">";
        echo $row['nm'];
}
?></tr><tr><td>
<?php
$sql = "select id,nm from fl_flight order by 2";
echo "<select name=\"crr\">";
foreach($conn->query($sql) as $row) {
        echo "<option value=\"". $row['id'] . "\"";
          echo ">";
        echo $row['nm'];
}
?>
</td></tr>
<tr><td>lastname</td><td><input type="text" name="lastname"></input></td></tr>
<tr><td>joinstr</td><td><input type="text" name="joinstr"></input></td></tr>
<tr><td>bandname</td><td><input type="text" name="bandname"></input></td></tr>
<tr><td>collaborators</td><td><input type="text" name="collab"></input></td></tr>
<tr><td colspan="2" align="center"><input type="submit"></td></tr>
</table>
</form>
<?php
include '../sitemap.php';
?>

