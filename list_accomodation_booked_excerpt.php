<?php
	//$sql = "select b.id id,c.nm carrier,ref booking,booked,f_stage(b.id,2,2) place, f_stage(b.id,2,0) checkin, f_stage(b.id,2,1) checkout, cost, notes 
	$sql = "select b.id id,c.nm carrier,ref booking,booked,d.nm dest, event_date_start start, event_date_end end, cost, nights 
	from bk_booking b 
	join bk_carrier c 
	on c.id=b.carrier 
	join bk_destination d
	on d.id=b.destination
	where type=" . $bktyp . 
	" order by booked desc";
        echo "<table><th>booked<th>booking<th>agency<th>dest<th>check-in<th>check-out<th>cost<th>nights";
	foreach($conn->query($sql) as $row) {
	  	echo "<tr>
			<td>" . $row['booked'] .  "</td>
			<td>" . $row['booking'] . "</td>
			<td>" . $row['carrier'] . "</td>
			<td>" . $row['dest'] . "</td>
			<td>" . $row['start'] . "</td>
			<td>" . $row['end'] . "</td>
			<td>" . $row['cost'] . "</td>
			<td>" . $row['nights'] . "</td>
			<td><a href=\"bkngmdf.php?id=" . $row['id'] . "&typ=" . $bktyp . "\">mod</a></td>
			<td><a href=\"bkngdlp?id=" . $row['id'] . "\">del</a></td>
		</tr>";
	}
?>
