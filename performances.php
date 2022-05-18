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

	if ($bktyp==5){ 
		include 'perf.php';
	} else if ($bktyp==1){ 
		include 'list_flights_booked_excerpt.php';
	}
	echo "</table>";
include 'includes/bk_links.php';
?>
