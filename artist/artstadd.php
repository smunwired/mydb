<?php include '../leftmenu.php'; ?>
<h1>Artist Add Form</h1>

<?php
include '../connect.php';
?>
<form method="post" action="artaddpt.php">
<table>
<tr><td>unindexed name</td><td><input type="text" name="pfxnm"></input></td></tr>
<tr><td>prefix</td><td><input type="text" name="prefix"></input></td></tr>
<tr><td>firstname</td><td><input type="text" name="firstname"></input></td></tr>
<tr><td>lastname</td><td><input type="text" name="lastname"></input></td></tr>
<tr><td>joinstr</td><td><input type="text" name="joinstr"></input></td></tr>
<tr><td>bandname</td><td><input type="text" name="bandname"></input></td></tr>
<tr><td>collaborators</td><td><input type="text" name="collab"></input></td></tr>
<tr><td>indexed name</td><td><input type="text" name="idxnm"></input></td></tr>
<tr><td colspan="2" align="center"><input type="submit"></td></tr>
</table>
</form>
<?php
include '../sitemap.php';
?>

