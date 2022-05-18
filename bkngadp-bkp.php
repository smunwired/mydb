<?php include 'leftmenu.php'; ?>
<h2>booking add post</h2>
<?php
$servername = "localhost";
$username = "stef";
$password = "pass";
$dbname = "mydb";
if (empty($_POST['trd'])) { $trd="null"; } else { $trd= "'" . $_POST['trd'] . "'"; }
if (empty($_POST['outbound_flight_id'])) { $outbound_flight_id='null'; } else { $outbound_flight_id=$_POST['outbound_flight_id']; }
if (empty($_POST['inbound_flight_id'])) { $inbound_flight_id='null'; } else { $inbound_flight_id=$_POST['inbound_flight_id']; }
if (empty($_POST['inbound_date'])) { $inbound_date='null'; } else { $inbound_date=concat('"',$_POST['inbound_date'],'"'); }
if (empty($_POST['outbound_date'])) { $outbound_date='null'; } else { $outbound_date=$_POST['outbound_date']; }
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

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // execute the query
    $stmt->execute();

    // echo a message to say the INSERT succeeded
    echo $stmt->rowCount()
    .
    	"Booking " . $_POST['booking'] . " inserted. ID : " . $conn->lastInsertId() ;

} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
$conn = null;
include 'includes/bk_links.php';
?>

