<html>
<body>
<h1>set statement date form</h1>
<table>
<form method="post" action="setstddtp.php">
<tr><td>tid</td><td><input name="tid" type="text" value="<?php echo $_GET['tid']; ?>"/></td></tr>
<tr><td>statement_date</td><td><input name="std" value="<?php echo $_GET['trd']; ?>" type="text"/></td></tr>
<tr><td>dd</td><td><input name="dd" value="<?php echo $_GET['dd']; ?>" type="text"/></td></tr>
<tr><td>dd</td><td><input name="amt" value="<?php echo $_GET['amt']; ?>" type="text"/></td></tr>
<tr><td colspan="2" align="center"><input type="submit" value="set"></td></tr>
</form>
</table>
</body>

</html>
