<?php include 'leftmenu.php'; ?>
<h1>booking add form</h1>
<?php include 'getsel.php'; ?>
<?php if ((empty($_GET['grp']))) { $grp="flgt"; } else { $grp = $_GET['grp']; } ?>
<form method="GET">
<div style="margin: 20 20 20 20;" align="right"><b>options : </b>
<?php           getsel($grp,'flgt','accm','train');               ?>
</div>
</form>

<?php
include 'connect.php';
?>
<form name="bkngadf" action="bkngadp.php" method="post">
<table width=100% style="table-layout: auto;">
<h2>generic</h2>
<tr>
  <td>type</td>
  <td>
<?php
  $sql = "select id,nm from bk_booking_type order by 2";
  echo "<select name=\"bktyp\"><option value=\"\">";
  foreach($conn->query($sql) as $row) {
	echo "<option value=\"". $row['id'] . "\">";
	echo $row['nm'];
  }
  echo "		
    </select></td>
	<td>new booking type</td>
	<td><input name=\"new_booking_type\"></input></td>
</tr>
<tr>
  <td>supplier</td>
  <td>";
  $sql = "select id,nm from bk_carrier order by 2";
  echo "		<select name=\"carrier\"><option value=\"\">";
  foreach($conn->query($sql) as $row) {
	echo "	<option value=\"". $row['id'] . "\">";
	echo 	$row['nm'];
  }
  echo "</select>
	</td>
	<td>new supplier</td>
	<td><input name=\"new_supplier\"></input></td>
	<td>booking ref</td>
	<td><input name=\"booking\"></input></td>
</tr>
<tr>
	<td>destination</td>
	<td>
	<select name=\"destination\"><option value=\"\">";
	$sql = "select id,nm from bk_destination where cd is null or cd = '' order by 2";
	$sql = "select id,nm,cd from bk_destination order by 2";
	foreach($conn->query($sql) as $row) {
		echo "<option value=\"". $row['id'] . "\">";
		echo $row['nm'] . " " . $row['cd'];
	}		
	echo "</select></td>
	<td>new destination</td><td><input name=\"newdest\"></input></td>
	<td>venue</td>
	<td>";
		$sql = "select id,nm from venue order by 2";
		echo "
		<select name=\"vn\"><option value=\"\">";
		foreach($conn->query($sql) as $row) {
			echo "<option value=\"". $row['id'] . "\">";
			echo $row['nm'];
		}
		echo "</select>
	</td>
</tr>
<tr><td>cost</td><td><input name=\"cost\"></input></td></tr>
<tr><td>notes</td><td><input name=\"notes\"></input></td></tr>
<tr><td>days/nights</td><td><input name=\"days\"></input></td></tr>"
?>
<tr>
	<td>
		direction
	</td>
	<td>
		<select name="direction">
			<option value=""></option>
			<option value="0">outbound</option>
			<option value="1">inbound</option>
			<option value="2">extras</option>
		</select>
	</td>
	<td>
		sequence
	</td>
	<td>
		<input name="sequence"></input>
	</td>
</tr>
<tr>
	<td>performance date</td>
	<td><input name="prfdt"></input></td>
	<td>event start date/check-in</td>
	<td><input name="event_start"></input></td>
	<td>event end date/check-out</td>
	<td><input name="event_end"></input></td>
</tr>
<tr>
	<td>booking date</td>
	<td><input name="booked"></input></td>
	<td>collection date</td><td><input name="collection_date"></input></td>
	<td>return date</td><td><input name="return_date"></input></td>
></td>
</tr>
<?php
$sql = "select f.id id,f.nm,d1.nm dp,time_format(dptm,'%H:%i') dptm,d2.nm ar,time_format(artm,'%H:%i') artm from bk_flight f left outer join bk_destination d1 on d1.id=f.dpdst left outer join bk_destination d2 on d2.id=f.ardst order by 2";
echo "<tr><td colspan=\"6\"><h2>flights outbound/inbound (stage)</h2></td></tr><tr>
	<td>
	outbound date </td><td><input name=\"outbound_date\"></input> seats <input size=\"1\" name=\"outst\" value=\"1\"></input>
	</td>
</tr>
<tr>
<td>outbound flight no #1</td><td>
<select name=\"outbound_flight_id_1\"><option value=\"\">";
foreach($conn->query($sql) as $row) {
	echo "<option value=\"". $row['id'] . "\">";
	echo $row['nm'] . " " . $row['dp'] . " " . $row['dptm'] . " " . $row['ar'] . " " . $row['artm'];
}
echo "</select></td>
<td>outbound flight no #2</td><td>
<select name=\"outbound_flight_id_2\"><option value=\"\">";
foreach($conn->query($sql) as $row) {
	echo "<option value=\"". $row['id'] . "\">";
	echo $row['nm'] . " " . $row['dp'] . " " . $row['dptm'] . " " . $row['ar'] . " " . $row['artm'];
}
echo "</select></td></tr>";
echo "<tr>
	<td>inbound date</td><td><input name=\"inbound_date\"></input> seats <input size=\"1\" name=\"inst\" value=\"1\"></input></td>
</tr>
<tr>
<td>inbound flight no</td><td>
<select name=\"inbound_flight_id\"><option value=\"\">";
foreach($conn->query($sql) as $row) {
	echo "<option value=\"". $row['id'] . "\">";
	echo $row['nm'] . " " . $row['dp'] . " " . $row['dptm'] . " " . $row['ar'] . " " . $row['artm'];
}
echo "</select></td></tr>
<tr><td align=\"center\"colspan=\"2\"><input type=\"submit\"></input></td></tr>
</table></form>";
include 'includes/bk_links.php';
?>
