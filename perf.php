<?php
        	$sql = "select v.nm venue,b.event_date evdt,b.id id,c.nm carrier,booking,booked,f_stage(b.booking," . $bktyp . ",0) outbound,f_stage(b.booking," . $bktyp . ",1) inbound,cost,notes,outst,inst
		from bk_booking b 
		left outer join bk_carrier c on c.id=b.carrier
		left outer join venue v on v.id=b.venue
		where booking_type=" . $bktyp . 
		" order by booked desc";
		echo "<br/>"  . $sql;
		echo "<table><th>booked<th>agency<th>Reference<th>cost<th>Act<th>venue<th>date<th>seats";
		foreach($conn->query($sql) as $row) {
	  		echo "<tr>
				<td>" .  $row['booked'] .  "</td>
				<td>" . $row['carrier'] . "</td>
				<td> " .  $row['booking'] . "</td>
				<td>" .  $row['cost'] . "</td>
				<td>" .  $row['notes'] . "</td>
				<td>" . $row['venue'] . "</td>
				<td>" . $row['evdt'] . "</td>
				<td>" . $row['outst'] . "</td>
				<td><a href=\"bkngmdf.php?id=" . $row['id'] . "&typ=" . $bktyp . "\">mod</a></td>
				<td><a href=\"bkngdlp?id=" . $row['id'] . "\">del</a></td>
			</tr>";
		}
?>
