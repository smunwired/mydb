<?php include 'leftmenu.php'; ?>

<h1>account cards</h1>

<?php
$id = $_GET['accd'];
include 'connect.php';
$ordcol = 1;
echo "<table><tr><th>id<th align=\"center\">account</td><td>card_number</td><td>valid from</td><td>expires</td>
	<td colspan=\"3\" align=\"center\">
		<a href=\"crdadf.php?accd=" . $id . "\">add</a></td></tr>";
	$sql = "select id,account_id accd,f_get_accnm(account_id) accn,card_number,valid_from,expires
		from card where account_id = " . $id . " order by " . $ordcol;
		echo $sql;
	foreach($conn->query($sql) as $row) {
		echo "<tr>
			<td>" . $row['id'] .
		"</td><td>" . $row['accn'] .
		"</td><td>" . $row['card_number'] .
		"</td><td>" . $row['valid_from'] .
		"</td><td>" . $row['expires'] .
		"</td><td><a href=\"crdmdf.php?id=" . $row['id'] . "\">mod</a></td><td><a href=\"crddlp.php?id=" . $row['id']. "&accd=" . $row['accd'] . "\">del</a></td>";
	}
	echo "</table>";
?>
