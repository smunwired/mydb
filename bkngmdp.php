<?php
include 'connect.php';
include 'leftmenu.php'; ?>
<h1>Booking Modify Post</h1>

<?php
if (empty($_POST['cost'])) { $cost="null"; } else { $cost = $_POST['cost']; }
if (empty($_POST['nights'])) { $nights="null"; } else { $nights = $_POST['nights']; }
$bktyp=$_POST['bktyp'];echo "<p>" . $bktyp;
if (!empty($_POST['new_destination'])) {
  $sql="insert into bk_destination(nm) values (\"" . $_POST['new_destination'] . "\")";
  try {
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $lstid=$conn->lastInsertId();
    echo "<br/>lastid : " . $lstid;
  } catch (Exception $e) {
    echo "<br/>some kind of failure here...";
    echo $e->getMessage();
    throw $e;
  }
}
if (!empty($lstid)) {
  $destination=$lstid;
} elseif (!empty($_POST['destination'])) {
  $destination = $_POST['destination'];
} else {
  $destination = 0;
}
//echo "<br/> ref : " . $_POST['ref'];
if ($bktyp==5) {
//  $upd = "update bk_booking set 
//	carrier= " .  $_POST['carrier'] . ",
//	booking='" .  $_POST['booking'] . "',
//	booked='" .  $_POST['booked'] . "',
//	event_date='" .  $_POST['outdt'] . "',
//	cost=" . $cost . ",
//	notes='" . $_POST['notes'] . "',
//	outst=" . $_POST['outst'] . ",
//	venue=" . $_POST['venue'] . "
//	where id=" . $_POST['id'];
//} else if ($bktyp==2) {
  $upd = "update bk_booking set 
	carrier= " .  $_POST['carrier'] . ",
	ref='" .  $_POST['ref'] . "',
	booked='" .  $_POST['booked'] . "',
	event_date_start='" .  $_POST['event_date_start'] . "',
	event_date_end='" .  $_POST['event_date_end'] . "',
	cost=" . $cost . ",
	nights=" . $nights . ",
	destination =" . $destination . ",
	notes='" . $_POST['notes'] . "'
	where id=" . $_POST['id'];
} elseif ($bktyp=7) {
  $upd = "update bk_booking set 
	carrier= " .  $_POST['carrier'] . ",
	ref='" .  $_POST['ref'] . "',
	booked='" .  $_POST['booked'] . "',
	event_date='" .  $_POST['event_date'] . "',
	outst=" . $_POST['outst'] . ",
	destination =" . $destination . ",
	notes='" . $_POST['notes'] . "'
	where id=" . $_POST['id'];
}
//  if (empty($_POST['outbound'])) { $outbound="null"; } else { $outbound= $_POST['outbound'] ; }
//  if (empty($_POST['inbound'])) { $inbound="null"; } else { $inbound=$_POST['inbound']; }
//
//  $upd = "update bk_booking set carrier= " .  $_POST['carrier'] . ",booking='" .  $_POST['booking'] . "',booked='" .  $_POST['booked'] . "',outbound=" . $outbound . ",outdt='" . $_POST['outdt'] . "',inbound=" . $inbound . ",indt='" . $_POST['indt'] . "',cost=" . $cost . ",notes='" . $_POST['notes'] . "',outst=" . $_POST['outst'] . ",inst=" . $_POST['inst'] . " where id=" . $_POST['id'];
//
//}
  echo "<p>" . $upd;
        try {
                        $stmt = $conn->prepare($upd);
                        $stmt->execute();
                        echo " <p>rows updated ";
        } catch (Exception $e) {
                    echo "<br/>some kind of failure here...";
                    echo $e->getMessage();
                      throw $e;
        }
include 'includes/bk_links.php';
?>
