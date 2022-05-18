<?php include 'leftmenu.php'; 
include 'connect.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
/*echo $_SESSION['bktyp'];*/
?>
<h1>booking</h1>
<?php 
if (empty($_GET['bktyp'])) { 
	if (empty($_SESSION['bktyp'])) { 
		$bktyp = 1; 
	} else { 
		$bktyp = ($_SESSION['bktyp']); 
	} 
} else {
	$bktyp = $_GET['bktyp']; 
} 
?>
<form method="GET">
<div style="margin: 20 20 20 20;" align="right"><b>options : </b>
<?php
$sql = "select id,typ from bk_booking_type order by 2";
echo "<select  onchange=\"this.form.submit();\" name=\"bktyp\"><option value=\"\">";
foreach($conn->query($sql) as $rw) {
        if ($rw['id']==$bktyp) {
                echo '<option value="'. $rw['id'] . '" selected>' . $rw['typ'];
        } else {
                echo '<option value="'. $rw['id'] . '">' . $rw['typ'];
        }
}
echo "</select></td></tr>";
$_SESSION['bktyp']=$bktyp;
/*echo "<br/>session again" . $_SESSION['bktyp'];*/
?>

</div>
</form>

<?php
	if (empty($_GET['id'])) {
		$whr = " where 1=1 ";
	} else {
		$whr = " where id = " . $_GET['id'];
	}

	$sql = "select b.id id,c.nm carrier,booking,booked,b.outbound foid,f6(f1.id) outbound,outdt,f6(f2.id) inbound,indt,cost,notes,outst,inst
		from bk_booking b 
		left outer join bk_flight f1 on f1.id=b.outbound 
		left outer join bk_flight f2 on f2.id=b.inbound 
		left outer join bk_carrier c on c.id=b.carrier
		where booking_type=" . $bktyp . 
		" order by booked desc";
	echo "<p>"  . $sql . "</p><table>";
	foreach($conn->query($sql) as $row) {
			echo "<tr>
			<td>" .  $row['booked'] .  "</td><td>" . $row['carrier'] . "</td><td> " .  $row['booking'] . "</td></td>";
			echo "<td>" . $row['outbound'] . "</td><td>" . $row['inbound'] . "</td>";

			if ($row['outst'] > 0) {
			  echo "<td>" . $row['outdt'] . " " . $row['outbound'] .  " " . $row['outst'] . " seat(s)</td>";
			} else {
			  echo "<td><s>" . $row['outdt'] . " " . $row['outbound'] .  " " . $row['outst'] . " seat(s)</s></td>";
			}
			if ($row['inst']) {
			  echo "<td>" . $row['indt'] . " " . $row['inbound'] . " " . $row['inst'] . " seat(s)</td>";
			} else {
			  echo "<td>&nbsp;</td>";
			}

			echo "<td>" .  $row['cost'] . "</td>
			<td>" .  $row['notes'] . "</td>
			<td><a href=\"bkngmdf.php?id=" . $row['id'] . "&typ=" . $bktyp . "\">mod</a></td>
			<td><a href=\"bkngdlp?id=" . $row['id'] . "\">del</a></td></tr>";
	}
	echo "</table>";
include 'includes/bk_links.php';
?>
