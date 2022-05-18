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
	echo "</table>";
include 'includes/bk_links.php';
?>
