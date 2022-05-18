<?php include 'leftmenu.php'; ?>
<h2>extra add post</h2>
<?php
$servername = "localhost";
$username = "stef";
$password = "pass";
$dbname = "mydb";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "insert into bk_booking(type,carrier,ref,booked,cost,notes)
values (1," . $_POST['carrier'] . 
	",\"" . $_POST['ref'] .
	"\",\"" . $_POST['booking_date'] . 
	"\"," . $_POST['cost'] . 
	",\"" . $_POST['notes'] . "\")";
echo "<br/>" . $sql;

    // Prepare statement
    $stmt = $conn->prepare($sql);

    try {// execute the query
    	$stmt->execute();

    // echo a message to say the INSERT succeeded
  	$lstid=$conn->lastInsertId();
  echo "<br/>" . $stmt->rowCount() .  "Booking " . $_POST['booking'] . " inserted. ID : " . $lstid ;
  echo "<br/>booking type : " . $bktyp;
  } catch(PDOException $e) {
    echo $sql . "<br/>" . $e->getMessage();
  }
} catch(PDOException $e) {
  echo $sql . "<br/>" . $e->getMessage();
}
	//try to insert stages anyhow
/*
echo $outbound_date . " " . $dbname . " anything!";
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
$bktyp = $_POST['bktyp'];
echo $outbound_date . " " . $dbname . "anything!";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "insert into bk_booking(carrier,booking,booked,outbound,outdt,inbound,indt,cost,notes,outst,inst)
values (" . $_POST['carrier'] . 
	",\"" . $_POST['booking'] .
	"\",\"" . $_POST['booked'] . 
	"\"," . $outbound_flight_id . 
	",\"" . $outbound_date . 
	"\"," . $inbound_flight_id . 
	"," . $inbound_date . 
	"," . $_POST['cost'] . 
	",\"" . $_POST['notes'] . "\"," . $_POST['outst'] . "," . $_POST['inst'] . ")";
    $sql = "insert into bk_booking(carrier,ref,booked,cost,notes,outst,inst,type)
values (" . $_POST['carrier'] . 
	",\"" . $_POST['booking'] .
	"\",\"" . $_POST['booked'] . 
	"\"," . $_POST['cost'] . 
	",\"" . $_POST['notes'] . "\"," . $_POST['outst'] . "," . $_POST['inst'] . "," . $bktyp . ")";
echo "<br/>" . $sql;

    // Prepare statement
    $stmt = $conn->prepare($sql);

    try {// execute the query
    	$stmt->execute();

    // echo a message to say the INSERT succeeded
    	$lstid=$conn->lastInsertId();
    echo "<br/>" . $stmt->rowCount() .  "Booking " . $_POST['booking'] . " inserted. ID : " . $lstid ;
    echo "<br/>booking type : " . $bktyp;
	//try to insert stages anyhow
    if ($bktyp==1) {
      $sql="insert into stage(booking,direction,sequence,flight,stage_date,seats) 
          values (" . $lstid . ",0,1," . $_POST['outbound_flight_id_1'] . ",'" . $_POST['outbound_date'] . "'," . $_POST['outst'] . ")"; echo $sql;
      try {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        echo "<br/>might have worked, " . $stmt->rowCount() . " row(s) inserted";
      } catch(PDOException $e) {
        echo $sql . "<br/>" . $e->getMessage();
      }
echo "id_2" . $outbound_flight_id_2;
      if ($outbound_flight_id_2 > 0) {
        $sql="insert into stage(booking,direction,sequence,flight,stage_date,seats) 
          values (" . $lstid . ",0,1," . $_POST['outbound_flight_id_2'] . ",'" . $_POST['outbound_date'] . "'," . $_POST['outst'] . ")"; echo $sql;
        try {
          $stmt = $conn->prepare($sql);
          $stmt->execute();
          echo "<br/>might have worked, " . $stmt->rowCount() . " row(s) inserted";
        } catch(PDOException $e) {
          echo $sql . "<br/>" . $e->getMessage();
        }
      }  
      $sql="insert into stage(booking,direction,sequence,flight,stage_date,seats) 
          values (" . $lstid . ",1,1," . $_POST['inbound_flight_id'] . ",'" . $_POST['inbound_date'] . "'," . $_POST['inst'] . ")"; echo $sql;
      try {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        echo "<br/>might have worked, " . $stmt->rowCount() . " row(s) inserted";
      } catch(PDOException $e) {
        echo $sql . "<br/>" . $e->getMessage();
      }
    }
    
    } catch (PDOException $e) {
	echo $sql . "<br/>" . $e->getMessage();
    }
} catch(PDOException $e) {
    echo $sql . "<br/>" . $e->getMessage();
}
*/
$conn = null;
include 'includes/bk_links.php';
?>

