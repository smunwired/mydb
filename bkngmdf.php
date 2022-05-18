<?php include 'leftmenu.php'; ?>
<h1>Booking Modify Form</h1>

<?php
include 'connect.php';
$id = $_GET['id'];
$bktyp = $_GET['typ'];
if ($bktyp==2) { $period_label='nights'; } else { $period_label='days'; }
$sql = "select * from bk_booking where id=" . $id;
echo "<table>";
echo "<form method=\"post\"action=\"bkngmdp.php\">";
echo "<input type=\"hidden\" name=\"bktyp\" value=\"" . $bktyp . "\"></input>";
echo "<input name=\"id\" type=\"hidden\" value=\"" . $id . "\"></input>";
foreach($conn->query($sql) as $row) {
  $crr="select id,nm from bk_carrier order by 2";
  echo "<tr><td>carrier/supplier</td><td><select name=\"carrier\">
    <option value=\"\">";
  foreach($conn->query($crr) as $row0) {
    if ($row0['id']==$row['carrier']) {
      echo "<option value=\"". $row0['id'] . "\" selected>" . $row0['nm'];
    } else {
      echo "<option value=\"". $row0['id'] . "\" >" . $row0['nm'];
    }
  }
  echo "</select></td></tr>";
  $dst="select id,nm from bk_destination order by 2";
  echo "<tr>
          <td>destination</td>
          <td><select name=\"destination\">
            <option value=\"\">";
  foreach($conn->query($dst) as $row1) {
    if ($row1['id']==$row['destination']) {
      echo "<option value=\"". $row1['id'] . "\" selected>" . $row1['nm'];
    } else {
      echo "<option value=\"". $row1['id'] . "\" >" . $row1['id'] . " " . $row1['nm'] . " " . $row['destination'];
    }
  }
  echo "     </select>
          </td>
          <td>new destination<input name=\"new_destination\"></input></td>
        </tr>";
  echo "<tr>
          <td>booking ref</td>
          <td><input name=\"ref\" type=\"text\" value=\"" . $row['ref'] . "\"></input></td>
        </tr>
        <tr>
          <td>booking date</td>
          <td><input name=\"booked\" type=\"text\" value=\"" . $row['booked'] . "\"></input></td>
        </tr>";
//  if ($bktyp==5) {
//	$vsql="select id,nm from venue order by 2";
//        echo "<tr><td>venue</td><td><select name=\"venue\">
//        <option value=\"\">";
//        foreach($conn->query($vsql) as $rowV) {
//		if ($rowV['id']==$row['venue']) {
//        		echo "<option value=\"". $rowV['id'] . "\" selected>" . $rowV['nm'];
//		} else {
//        		echo "<option value=\"". $rowV['id'] . "\" >" . $rowV['nm'];
//		}
//        }
//        echo "</select></td></tr>";
//  }
  if ($bktyp==7) {
    echo "
  <tr>
    <td>event date</td><td><input name=\"event_date\" value=\"" . $row['event_date'] . "\"></input></td>
  </tr>
  <tr> 
    <td>seats/td> 
    <td><input name=\"outst\" type=\"text\" value=\"" . $row['outst'] . "\"></input></td>
  </tr>";
  } else {
echo "<tr>
    <td>check-in</td>
    <td><input name=\"event_date_start\" value=\"" . $row['event_date_start'] . "\"></input></td>
  </tr>";
echo "<tr>
    <td>check-out</td>
    <td><input name=\"event_date_end\" value=\"" . $row['event_date_end'] . "\"></input></td>
  </tr>
  <tr> <td>" . $period_label . "</td> <td><input name=\"nights\" type=\"text\" value=\"" . $row['nights'] . "\"></input></td> </tr>";
  }
//	$fsql = "select f.id id,f.nm,d1.nm dp,time_format(dptm,'%H:%i') dptm,d2.nm ar,time_format(artm,'%H:%i') artm 
//	from bk_flight f left 
//	outer join bk_destination d1 on d1.id=f.dpdst 
//	left outer join bk_destination d2 on d2.id=f.ardst order by 2";
//      $fsql = "select  from stage where booking='" . $row['booking'] . "'";
//	echo "<tr>";
//        if ($bktyp==1) {
//        	echo "<td>outbound date</td>";
//	} elseif ($bktyp==2) {
//		echo "<td>check in date</td>";
//	} elseif ($bktyp==5) {
//		echo "<td>performance date</td>";
//        } else {
//          echo "<td>collect</td>";
//        }
//        echo "<td><input name=\"outdt\" value=\"" . $row['outdt'] . "\"></input> seats <input size=\"1\" name=\"outst\" value=\"" . $row['outst'] . "\"></input></td>
//	</tr>
//	<tr>
//		<td>check out date</td>
//		<td><input name=\"indt\" value=\"" . $row['indt'] . "\"></input></td>
//	</tr>
//	";
//	if ($bktyp==1) {
//	  echo "
//		<tr>
//			<td>outbound flight no</td>
//			<td>
//				<select name=\"outbound\"><option value=\"\">";
//					foreach($conn->query($fsql) as $fl1) {
//						if ($fl1['id']==$row['outbound']) {
//       						echo "<option value=\"". $fl1['id'] . "\" selected>";
//      						echo $fl1['nm'] . " " . $fl1['dp'] . " " . $fl1['dptm'] . " " . $fl1['ar'] . " " . $fl1['artm'];
//						} else {
//       						echo "<option value=\"". $fl1['id'] . "\">";
//      						echo $fl1['nm'] . " " . $fl1['dp'] . " " . $fl1['dptm'] . " " . $fl1['ar'] . " " . $fl1['artm'];
//						}
//	  				}
//	  echo "<tr>
//       		<td>inbound date</td>
//			<td><input name=\"indt\" value=\"" . $row['indt'] . "\"></input> seats <input size=\"1\" name=\"inst\" value=\"" . $row['inst'] . "\"></input></td>
//		</tr>
//		<tr>
//			<td>inbound flight no</td><td>
//				<select name=\"inbound\"><option value=\"\">";
//					foreach($conn->query($fsql) as $fl2) {
//						if ($fl2['id']==$row['inbound']) {
//       						echo "<option value=\"". $fl2['id'] . "\" selected>";
//      						echo $fl2['nm'] . " " . $fl2['dp'] . " " . $fl2['dptm'] . " " . $fl2['ar'] . " " . $fl2['artm'];
//						} else {
//       						echo "<option value=\"". $fl2['id'] . "\">";
//      						echo $fl2['nm'] . " " . $fl2['dp'] . " " . $fl2['dptm'] . " " . $fl2['ar'] . " " . $fl2['artm'];
//						}
//	  				}
//				}
echo 
  "<tr><td>cost</td> <td><input name=\"cost\" type=\"text\" value=\"" . $row['cost'] . "\"></input></td></tr>
  <tr> <td>notes</td> <td><input name=\"notes\" type=\"text\" value=\"" . $row['notes'] . "\"></input></td> </tr>
  <tr> <td colspan=\"2\" align=\"center\"><input type=\"submit\"></input></td> </tr>
</form>
</table>";
}
?>
