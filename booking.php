<?php include 'leftmenu.php'; 
include 'connect.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
?>
<h1>booking</h1>
<form method="GET">
<div style="margin: 20 20 20 20;" align="right"><b>options : </b>
<?php
//BOOKING TYPE
if (empty($_GET['bktyp'])) { 
  if (empty($_SESSION['bktyp'])) { 
    $bktyp = 1; 
  } else { 
    $bktyp = ($_SESSION['bktyp']); 
  } 
} else { 
  $bktyp = $_GET['bktyp']; 
} 
$_SESSION['bktyp']=$bktyp;
$sql = "select id,nm from bk_booking_type order by 2";
echo "<select  onchange=\"this.form.submit();\" name=\"bktyp\"><option value=\"\">";
foreach($conn->query($sql) as $rw) {
        if ($rw['id']==$bktyp) {
                echo '<option value="'. $rw['id'] . '" selected>' . $rw['nm'];
        } else {
                echo '<option value="'. $rw['id'] . '">' . $rw['nm'];
        }
}
echo "</select></td></tr>";
$_SESSION['bktyp']=$bktyp;
//RANGE
if (empty($_GET['range'])) { 
  if (empty($_SESSION['range'])) { 
    $range = 99; 
  } else { 
    $range = ($_SESSION['range']); 
  } 
} else { 
  $range = $_GET['range']; 
} 
$_SESSION['range']=$range;
$ranges=[99,1,2,3];
echo "<select onchange=\"this.form.submit();\" name=\"range\">";
foreach($ranges as $r) {
  if ($range==$r) {
    echo "<option value=\"" . $r . "\" selected>" . "last " . $r . " years";
  } else {
    echo "<option value=\"" . $r . "\">" . "last " . $r . " years";
  }
}
echo "</select>";
//SORT BY DATE DIRECTION
if (empty($_GET['sort'])) { 
  if (empty($_SESSION['sort'])) {
    $sort='desc';
  } else {
    $sort=$_SESSION['sort'];
  }
} else {
  $sort=$_GET['sort'];
}
$sorts=["asc","desc"];
echo "<select onchange=\"this.form.submit();\" name=\"sort\">";
foreach($sorts as $s) {
  if ($sort==$s) {
    echo "<option value=\"" . $s . "\" selected>" . $s;
  } else {
    echo "<option value=\"" . $s . "\">" . $s;
  }
}
echo "</select>";
 
//$_SESSION['sort']=$_GET['sort'];
//echo "<br/>session sort : " . $_SESSION['sort'];
?>
</div>
</form>

<?php
	if (empty($_GET['id'])) {
		$whr = " where 1=1 ";
	} else {
		$whr = " where id = " . $_GET['id'];
	}
		if ($bktyp==1){ 
			include 'list_flights_booked_excerpt.php';
		} else if ($bktyp==2){ 
			include 'list_accomodation_booked_excerpt.php';
		} else if ($bktyp==5){ 
			include 'list_performances_booked_excerpt.php';
		} else if ($bktyp==6){ 
			include 'list_vehicle_rental_booked_excerpt.php';
		} else if ($bktyp==7){ 
			include 'list_cinema_booked_excerpt.php';
		}
	echo "</table>";
include 'includes/bk_links.php';
?>
