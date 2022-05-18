<html>
<body>
<h1>set last played date form</h1>
<table>
<form method="post" action="lstplydp.php">
<tr><td>title</td><td><input name="ttl" type="text" value="<?php echo $_GET['id']; ?>"/></td></tr>
<tr><td>date</td><td><input name="lstndt" value="<?php echo date('Y-m-d') ?>" type="text"/></td></tr>
<tr><td colspan="2" align="center"><input type="submit" value="set"></td></tr>
</form>
</table>
<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.
$dt = new DateTime();
echo $dt->format('Y-m-d H:i:s');
?>
</body>

</html>
