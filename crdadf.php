<?php include 'leftmenu.php'; ?>
<h1>card add form</h1>

<form name="crdadf" action="crdadp.php" method="post">
<table>
	<tr><td>account_id</td>
	<td><input name="account_id" value=" <?php echo $_GET['accd']; ?> "></input></td>
	</tr>
	<tr><td>card number</td>
	<td><input name="card_number"></input></td>
	</tr>
	<tr><td>valid_from</td>
	<td><input name="valid_from"></input></td>
	</tr>
	<tr><td>expires</td>
	<td><input name="expires"></input></td>
	</tr>
<tr>
	<td><input type="submit"></input></td>
</tr>
</form>
</body>
</html>
