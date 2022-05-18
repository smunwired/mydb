<?php include 'leftmenu.php'; ?>
<h1>Flights</h1>

<?php
include 'connect.php';
	echo "<table class=\"nobr\">
		<tr>
			<th>flight no<th>depart dest<th>time<th>arrival dest<th>time<th>operated by
			<td colspan=\"3\"><a href=\"flghadf.php\">add</a></td>
		</tr>";
	$sql = "select f.id,f.nm flight_no,d1.nm depart_dest,dptm depart_time,d2.nm arrival_dest,artm arrival_time,coalesce(shrt,c.nm) opr 
		from bk_flight f 
		left outer join bk_destination d1 on d1.id=f.dpdst 
		left outer join bk_destination d2 on d2.id=f.ardst
		left outer join bk_carrier c on c.id=f.opr
		order by 2";
		echo $sql;
	foreach($conn->query($sql) as $row) {
		echo "<tr>
		<td>" . $row['flight_no'] .
		"</td><td>" . $row['depart_dest'] .
		"</td><td>" . $row['depart_time'] .
		"</td><td>" . $row['arrival_dest'] .
		"</td><td>" . $row['arrival_time'] .
		"</td><td>" . $row['opr'] .
			"</td>
			<td><a href=\"flghmdf.php?id=" . $row['id'] . "\">mod</a></td>
			<td><a href=\"flghdlp.php?id=" . $row['id'] . "\">del</a></td>
		</tr>";
	}
	echo "</table>";
include 'includes/bk_links.php';
?>
