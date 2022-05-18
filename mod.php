<?php
include 'connect.php';

if (($_GET['actn']=="mdfm")&&($_GET['tbl']=="crd")) {
	//$db = new PDO('mysql:host=hostname;dbname=dbname', 'username', 'password');
	$id = $_GET['id'];
	$stmt = $conn->query("select nm from names where id = " . $id);
	$nm = $stmt->fetchColumn(0);
	if ($nm !== false) {
	    echo $nm;
	}

	?>
	<h1>creditor mod form</h1>
	<form method="post" name="crdmodfm" action="mod.php?tbl=crd&actn=mdpst">
	<input type="hidden" name="id" value="<?php echo $id; ?>"></input>
	<table>
	<tr>
	<td>id</td><td><?php echo $id; ?></td>
	</tr>
	<tr>
	<td>nm</td><td><input name="nm" value="<?php echo $nm; ?>"></input></td>
	</tr>
	<tr>
	<td colspan="2" align="center"><input type="submit" ></input></td>
	</tr>
	</table>
	</form>
<?php
} else if (($_GET['actn']=="mdpst")&&($_GET['tbl']=="crd")) {
	$upd = "update names set nm='" . $_POST['nm'] . "' where id = " . $_POST['id'];
	try {
	//    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	//    // set the PDO error mode to exception
	//    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//    $sql = "UPDATE MyGuests SET lastname='Doe' WHERE id=2";

	    // Prepare statement
//	    $stmt = $conn->prepare($sql);
	    $stmt = $conn->prepare($upd);

	    // execute the query
	    $stmt->execute();

	    // echo a message to say the UPDATE succeeded
	    echo $stmt->rowCount() . " records UPDATED successfully";
	    }
	catch(PDOException $e)
	    {
	    echo $sql . "<br>" . $e->getMessage();
	    }

$conn = null;
  echo "<a href=\"crd.php\">list</a>";



} else {
function fslct($conn,$sql,$whr,$ord,$matchto,$id,$desc,$thisform) {
  echo "<select name=\"" . $id . "\" onchange='this.form.action=\"trnaddfm.php\"; this.form.submit()'><option value=\"0\">";
  foreach($conn->query($sql . $whr . $ord) as $row) {
    if ($matchto==$row[$id]) {
  	echo "<option value=\"". $row[$id] . "\" selected>" . $row[$desc];
    } else {
  	echo "<option value=\"". $row[$id] . "\">" . $row[$desc];
    }
  }
  echo " </select>";
}
function fchkbx($name,$value) {
  if ($value=="on") {
    echo "<input name=\"" . $name . "\" type=\"checkbox\" checked />";
  } else {
    echo "<input name=\"" . $name . "\" type=\"checkbox\" />";
  }
}
$conn = new PDO("pgsql:host=192.168.56.104;dbname=trxndb", 'trxnuser', 'trxnpass');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<form action="crdmodpt.php" method="post">
<table>
<tr>
<td>creditor</td><td><input name="trd" value="<?php echo $_POST['trd']; ?>"></input></td></tr>
<td>tran creditor</td><td><input name="crn" value="<?php echo $_POST['crn']; ?>"></input></td></tr>
<td>desc</td><td><input name="dsc" value="<?php echo $_POST['dsc']; ?>"></input></td></tr>
<tr><td>creditor</td><td>
<?php
echo fslct($conn,"select creditor_id crdd,creditor crd  from creditor"," where 1=1"," order by creditor",$_POST['crdd'],'crdd','crd','func.php');
?>
</td><td>branch</td><td>
<?php
if ($_POST['crdd']==null) {
  $brnwhr = " where creditor_id=0";
} else {
  $brnwhr = " where creditor_id=" . $_POST['crdd'];
}
echo fslct($conn,"select branch_id brnd,branch_name brn from branch",$brnwhr," order by branch_name",$_POST['brnd'],'brnd','brn','func.php');
?>
</td></tr><tr><td>tran type</td><td>
<?php
echo fslct($conn,"select tran_type_id ttyd,tran_type tty from tran_type"," where 1=1"," order by tran_type_id",$_POST['ttyd'],'ttyd','tty','func.php');
?>
</td></tr><tr><td>account</td><td>
<?php
echo fslct($conn,"select account_id accd,account_name acc from account"," where 1=1"," order by account_id",$_POST['accd'],'accd','acc','func.php');
?>
</td></tr><tr><td>frequency</td><td>
<?php
echo fslct($conn,"select freq_id frqd,freq_name frq from frequency"," where 1=1"," order by freq_id",$_POST['frqd'],'frqd','frq','func.php');
?>
</td></tr><tr><td>cost</td><td>
<?php
echo fslct($conn,"select cost_code cstd,cost cst from cost_center"," where 1=1"," order by cost_code",$_POST['cstd'],'cstd','cst','func.php');
?>
</td></tr>
<tr><td>receipt</td><td><?php echo fchkbx("rcpt",$_POST['rcpt']); ?></td></tr>
<tr><td>dd</td><td><?php echo fchkbx("dd",$_POST['dd']); ?></td></tr>
<td>amount</td><td><input name="amt"  value="<?php echo $_POST['amt']; ?>"/></td><td>cr/dr</td><td><input name="crdr" type="radio" value="0"/><input name="crdr" type="radio" value="1" checked /></td></tr>
<tr><td>cheque no</td><td><input name="chq"  value="<?php echo $_POST['chq']; ?>"/></td></tr>
<tr><td>statement date</td><td><input name="std"  value="<?php echo $_POST['std']; ?>"/></td></tr>
<tr><td><input type="submit" /></td></tr>
</table>
</form><h1>modify bike form</h1>
<form name="mod" action="bikepost.php" method="post" >
<table>
<?php
include 'connect.php';
$sql = "select * from bike where odo = " . $_GET['odo'];
foreach($conn->query($sql) as $row) {
	echo "<tr><td>ride date</td><td><input name=\"rdate\" value=\"" . $row['rdate'] . "\"></input></td></tr>";
	echo "<tr><td>time</td><td><input name=\"tm\" value=\"" . $row['tm'] . "\"></input></td></tr>";
	echo "<tr><td>distance</td><td><input name=\"dst\" value=\"" . $row['dst'] . "\"></input></td></tr>";
	echo "<tr><td>average</td><td><input name=\"av\" value=\"" . $row['av'] . "\"></input></td></tr>";
	echo "<tr><td>max speed</td><td><input name=\"mx\" value=\"" . $row['mx'] . "\"></input></td></tr>";
	echo "<tr><td>odometer</td><td><input name=\"odo\" value=\"" . $row['odo'] . "\"></input></td></tr>";
	echo "<tr><td>notes</td><td><input name=\"notes\" value=\"" . $row['notes'] . "\"></input></td></tr>";
	echo "<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\"></input></td></tr>";
}
}
?>
</table>
</form>
