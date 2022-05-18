<?php
	$sql = "select b.id id,c.nm carrier,booking,booked,b.outbound foid,f6(f1.id) outbound,outdt,f6(f2.id) inbound,indt,cost,notes,outst,inst
		from bk_booking b 
		left outer join bk_flight f1 on f1.id=b.outbound 
		left outer join bk_flight f2 on f2.id=b.inbound 
		left outer join bk_carrier c on c.id=b.carrier
		where booking_type=" . $bktyp . 
		" order by booked desc";
	$sql = "select b.id id,c.nm carrier,booking,booked,f_stage(b.id,1,0) outbound,f_stage(b.id,1,1) inbound, cost, notes 
		from bk_booking b 
		join bk_carrier c 
		on c.id=b.carrier 
		where booking_type=" . $bktyp;
	$sql = "select b.id id, c.nm carrier,ref booking,booked,f_stage(b.id,type,0) collect,f_stage(b.id,type,1) rtn, cost, notes 
	from bk_booking b join bk_carrier c on c.id=b.carrier where type=" . $bktyp;
	$sql = "select b.id id, c.nm carrier,d.nm destination,ref booking,booked,event_date_start collect,event_date_end rtn, cost,nights,notes 
		from bk_booking b 
		join bk_carrier c on c.id=b.carrier 
		left outer join bk_destination d on d.id=b.destination
		where type=" . $bktyp . " and booked > now() - INTERVAL " . $range . " year order by booked " . $sort;
	echo "<p>"  . $sql . "</p>";		
        echo "<table><th>booked<th>rentor<th>reference<th>collect<th>at<th>return<th>cost<th>days<th>notes";
	foreach($conn->query($sql) as $row) {
		echo "<tr>
			<td>" .  $row['booked'] .  "</td>
			<td>" . $row['carrier'] . "</td>
			<td> " .  $row['booking'] . "</td>
			<td>" . $row['collect'] . "</td>
			<td>" . $row['destination'] . "</td>
			<td>" . $row['rtn'] . "</td>
			<td>" .  $row['cost'] . "</td>
			<td>" .  $row['nights'] . "</td>
			<td>" .  $row['notes'] . "</td>
			<td><a href=\"bkngmdf.php?id=" . $row['id'] . "&typ=" . $bktyp . "\">mod</a></td>
			<td><a href=\"bkngdlp?id=" . $row['id'] . "\">del</a></td></tr>";
	}
?>
