<?php include 'leftmenu.php'; ?>
<h2>booking add post</h2>
<?php
$servername = "localhost";
$username = "stef";
$password = "pass";
$dbname = "mydb";
echo "<br/> new supplier " . $new_supplier . ", new destination " . $new_destination;
if (empty($_POST['trd'])) { $trd="null"; } else { $trd= "'" . $_POST['trd'] . "'"; }
if (empty($_POST['outbound_flight_id_1'])) { $outbound_flight_id_1='null'; } else { $outbound_flight_id_1=$_POST['outbound_flight_id_1']; }
if (empty($_POST['outbound_flight_id_2'])) { $outbound_flight_id_2='null'; } else { $outbound_flight_id_2=$_POST['outbound_flight_id_2']; }
echo "<br/>flight id 2 : " . $outbound_flight_id_2;
if (empty($_POST['inbound_flight_id'])) { $inbound_flight_id='null'; } else { $inbound_flight_id=$_POST['inbound_flight_id']; }
if (empty($_POST['inbound_date'])) { 
  $inbound_date='null'; 
} else { 
  $inbound_date=$_POST['inbound_date']; 
}
if (empty($_POST['outbound_date'])) { $outbound_date='null'; } else { $outbound_date=$_POST['outbound_date']; }

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//NEW SUPPLIER
  $new_supplier=$_POST['new_supplier'];
  if (!empty($new_supplier)) {
    $sql="insert into bk_carrier(nm) values (\"" . $new_supplier . "\")";
    // Prepare statement
    $stmt = $conn->prepare($sql);

    try {// execute the query
      $stmt->execute();
      // echo a message to say the INSERT succeeded
      $new_carrier_id=$conn->lastInsertId();
      echo "<br/>" . $stmt->rowCount() .  "<br/>new carrier " . $new_supplier . " inserted. ID : " . $new_carrier_id ;
    } catch (PDOException $e) {
	echo $sql . "<br/>" . $e->getMessage();
    }
  }

//NEW DESTINATION
  $new_destination=$_POST['newdest'];
  if (!empty($new_destination)) {
    $sql="insert into bk_destination(nm) values (\"" . $new_destination . "\")";
    // Prepare statement
    $stmt = $conn->prepare($sql);

    try {// execute the query
      $stmt->execute();
      // echo a message to say the INSERT succeeded
      $new_destination_id=$conn->lastInsertId();
      echo "<br/>" . $stmt->rowCount() .  "<br/>new destination " . $new_destination . " inserted. ID : " . $new_destination_id ;
    } catch (PDOException $e) {
	echo $sql . "<br/>" . $e->getMessage();
    }
  }
  if (empty($new_destination)) { $destination=$_POST['destination']; } else { $destination=$new_destination_id; }
  if (empty($new_supplier)) { $carrier=$_POST['carrier']; } else { $carrier=$new_carrier_id; }
//WHAT TYPE IS IT?
//
//  if (!empty($_POST['new_booking_type'])) {
//    $sql="insert into bk_booking_type(nm) values (\"" . $_POST['new_booking_type'] . "\")";
    /*
    try {
    */
//      $stmt = $conn->prepare($sql);
//      $stmt->execute();
//      $bktyp=$conn->lastInsertId();
//      echo "<br/>lstid for bk_booking_type : " . $bktyp;
/*
    } catch {
      echo $sql . "<br/>" . $e->getMessage();
    }
    */
//    echo "<br/>new booking type not empty." . $sql;
//  } else {
//    $bktyp = $_POST['bktyp'];
//  }
//  echo "<br/>booking type " . $bktyp . $outbound_date . " " . $dbname . " anything!";
//  echo "<br/>type : " . $_POST['bktyp'];;

//NEW SUPPLIER
//    if (!empty($_POST['new_supplier'])) {
//      $sql="insert into bk_carrier(nm) values (\"" . $_POST['new_supplier'] . "\")"; 
//      echo "<br/>NEW SUPPLIER : " . $sql
//      $stmt = $conn->prepare($sql);
//      $stmt->execute();
//      $carrier=$conn->lastInsertId();
//      echo "<br/>lastid : " . $lstid;
//    }
//    if (empty($carrier)) {
//      if (empty($_POST['carrier'])) {
//        echo "NO CARRIER, THIS WILL NOT WORK";
//      } else {
//       $carrier = $_POST['carrier'];
//        echo "<br/>carrier : " . $carrier;
//      }
//    }
/*
    if ($bktyp==6} {
      $sql = "insert into bk_booking(carrier,ref,booked,cost,notes,outst,inst,type,event_date_start,event_date_end) 
        values (" . $carrier .  ",\"
        " . $_POST['booking'] .  "\",\"" . $_POST['booked'] .  "\",
        " . $_POST['cost'] .  ",
        \"" . $_POST['notes'] . "\",
        " . $_POST['outst'] . ",
        " . $_POST['inst'] . ",
        " . $bktyp . ", \"" . $_POST['collection_date'] . "\", \"" . $_POST['return_date'] . "\")"; 
    } elseif ($bktyp==7) {
      $sql = "insert into bk_booking(carrier,ref,booked,cost,notes,outst,type,event_date,destination) 
        values (" . $carrier .  ",\"
        " . $_POST['booking'] .  "\",\"" . $_POST['booked'] .  "\",
        " . $_POST['cost'] .  ",
        \"" . $_POST['notes'] . "\",
        " . $_POST['outst'] . ",
        " . $bktyp . ", \"" . $_POST['prfdt'] . "\"," . $destination . ")"; 
    } else { 
      $sql="stuff that wont work";
    }
*/
$bktyp=$_POST['bktyp'];
echo "<br/> perf date : " . $_POST['prfdt'];
echo "<br/> bktyp " . $bktyp;
if ($bktyp==6) {
  $sql="type6";
      $sql = "insert into bk_booking(carrier,ref,booked,cost,notes,nights,type,event_date_start,event_date_end,destination) 
        values (" . $carrier .  ",\"
        " . $_POST['booking'] .  "\",\"" . $_POST['booked'] .  "\",
        " . $_POST['cost'] .  ",
        \"" . $_POST['notes'] . "\",
        " . $_POST['days'] . ",
        " . $bktyp . ", 
        \"" . $_POST['collection_date'] . "\",
        \"" . $_POST['return_date'] . "\",
        " . $destination . ")"; 
    echo "sql6 : " . $sql;
} elseif ($bktyp==7) {
  $sql="type7";
      $sql = "insert into bk_booking(carrier,ref,booked,cost,notes,outst,type,event_date,destination) 
        values (" . $carrier .  ",\"
        " . $_POST['booking'] .  "\",\"" . $_POST['booked'] .  "\",
        " . $_POST['cost'] .  ",
        \"" . $_POST['notes'] . "\",
        " . $_POST['outst'] . ",
        " . $bktyp . ", \"" . $_POST['prfdt'] . "\"," . $destination . ")"; 
} else {
//assuming performance
//is carrier same as supplier ?
  $sql="insert into bk_booking(ref,carrier,cost,notes,type,venue,event_date) values ('" 
	. $_POST['booking'] . "'," 
	. $carrier . "," 
	. $_POST['cost'] . ",'" 
	. $_POST['notes'] . "',"
	. $_POST['bktyp'] . ","
	. $_POST['vn'] . ",'"
	. $_POST['prfdt'] . "')";
}
  echo "<br/>sql is" . $sql;
//  // Prepare statement
  $stmt = $conn->prepare($sql);

  try {// execute the query
    $stmt->execute();
    // echo a message to say the INSERT succeeded
    	$lstid=$conn->lastInsertId();
    echo "<br/>" . $stmt->rowCount() .  "Booking " . $_POST['booking'] . " inserted. ID : " . $lstid ;
    echo "<br/>booking type : " . $bktyp;
    
    } catch (PDOException $e) {
	echo $sql . "<br/>" . $e->getMessage();
    }
} catch(PDOException $e) {
    echo $sql . "<br/>" . $e->getMessage();
}
$conn = null;
include 'includes/bk_links.php';
?>

