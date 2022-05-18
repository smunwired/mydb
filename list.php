<?php include 'leftmenu.php'; ?>

<?php
function checkordcol($ordcolchk) {
	echo "tid<input onChange='this.form.submit();' type=\"radio\" name=\"ordcol\" value=\"tran_id\"/>";
	echo "trd<input onChange='this.form.submit();' type=\"radio\" name=\"ordcol\" value=\"tran_date\" checked  />";
	echo "std<input onChange='this.form.submit();' type=\"radio\" name=\"ordcol\" value=\"statement_date\" />";
	$arr = array("tran_id", "tran_date", "statement_date","date_created","date_amended");

	foreach ($arr as $value) {
		if ($ordcolchk==$value) { $checked="checked"; } else { $checked=""; }
	    echo $value . "<input onChange='this.form.submit();' type=\"radio\" name=\"ordcol\" value=\"" . $value . "\" " . $checked . "/>";
	}
}
function fslct($ttl,$lbl,$conn,$sql,$id,$cl){
	echo " " . $ttl . " <select name=\"" . $lbl . "\" onChange='this.form.submit();' >";
//	if (empty($id)) { echo "<option value=\"\">all"; }
	echo "<option value=\"\">all";
	foreach($conn->query($sql) as $row) {
		if ($row['id']==$id) {
    		echo "<option value=" . $row['id'] . " selected>" . $row['nm'];
    		$id=$row['id'];
    		$_SESSION[ttl]=$id;
//    		$whr = " and account_id = " . $row['id'] ;
//    		return " and account_id = " . $row['id'] ;
		} else {
			echo "<option value=" . $row['id'] . ">" . $row['nm'];
		}
	}
	echo "</select>";
	if (empty($id)) { return " and 1=1  "; } else { return " and transdet." . $cl . " = " . $id; }
}

function selectordcol($ordcol) {
	$arr = array("tran_id", "tran_date", "statement_date","date_created","date_amended");
	echo "<select name=\"ordcol\" onChange='this.form.submit();' >";
	foreach ($arr as $value) {
		if ($ordcol==$value) {
			echo "<option value=\"" . $value . "\" selected >" . $value;
			$_SESSION["ordcol"]=$value;
		} else {
			echo "<option value=\"" . $value . "\">" . $value;
		}
	}
	echo "</select>";
}
//echo "post accd" . $_POST['accd'] . " ordcol " . $_POST['ordcol'];
?>
<!--////START OF THE FORM////-->
<form name="list.php" method="post">
  <table width="100%">
    <tr>
      <td><h1>transactions</h1></td>
      <td width="40%" align="center">
	<table width="100%">
		<tr>
			<td><b>filter</b></td>
			<td>
				<?php
					session_start();
					include 'connect.php';
					//if (empty($_POST['tty'])) { $
					if (isset($_POST['accd'])) { $whr = fslct("account","accd",$conn,"select account_id id,account_name nm from account order by 2",$_POST['accd'],"account_id"); }
				?>
			</td><td>
				<?php
					if (isset($whr)) {$whr = $whr . fslct("tran type","ttyd",$conn,"select tran_type_id id,tran_type nm from tran_type order by 2",$_POST['ttyd'],"tran_type_id");}
				?>
			</td>
		</tr>
	</table>
    <td width="40%" align="right">
	<table width="100%">
		<tr>
			<td>order by</td>
			<td>
			<?php
			if (empty($_POST['ordcol'])) {
				if (empty($_SESSION["ordcol"])) {
					$ordcol="tran_id";
				} else {
					$ordcol=$_SESSION["ordcol"];
				}
			} else {
				$ordcol=$_POST['ordcol'];
			}
			selectordcol($ordcol);
			?>
			</td>
			<td>asc/desc</td>
			<td>
			<?php
			if (empty($_POST['orddr'])) { if (empty($_SESSION["orddr"])) { $orddr="desc"; } else { $orddr=$_SESSION["orddr"]; }} else { $orddr=$_POST['orddr']; }
			if (isset($_POST['orddr'])) { 
				if ($_POST['orddr']=="asc") {
					echo "<input onChange='this.form.submit();' type=\"radio\" name=\"orddr\" value=\"asc\" checked />";
					echo "<input onChange='this.form.submit();' type=\"radio\" name=\"orddr\" value=\"desc\" />";
					$_SESSION["orddr"]="asc";
				} else {
					echo "<input onChange='this.form.submit();' type=\"radio\" name=\"orddr\" value=\"asc\" />";
					echo "<input onChange='this.form.submit();' type=\"radio\" name=\"orddr\" value=\"desc\" checked />";
					$_SESSION["orddr"]="desc";
				}
			}
			if (empty($_POST['limit'])) { if (empty($_SESSION["limit"])) { $limit=22; } else {$limit=$_SESSION["limit"];}} else { $limit=$_POST['limit']; }
			?>
			</td><td>limit</td><td width="40px"><input onChange='this.form.submit();' name="limit" value=" <?php echo $limit; ?> " />
	</td>
      </tr></table>
    </td>
  </tr></table>
</form>

<div id="subright">
<table style=" width : 100%; border : 1; font-size : 14px; ">
<!--
<tr><th>date<th>creditor<th>desc<th>tran type<th>account<th>amount<th>receipt<th>ctls<th>dd<th>statement<th>cheque<th>freq<th>cost<td><a href="form.php">add</a></td></tr>
-->
	<?php
//	echo " whr " . $whr;
//	if (empty($_GET['whr'])) { $whr = " and 1=1 "; } else { $whr =  $_GET['whr']; }
	if (!empty($_GET['whr'])) { $whr = $whr . $_GET['whr']; }
	if (!empty($_GET['crdd'])) { echo $whr = " and crdd = " . $_GET['crdd']; }
	if (!empty($_GET['brnd'])) { echo $whr = " and brnd = " . $_GET['brnd']; }
	$sql="select tran_id tid,tran_date trd,
		case when coalesce(brnn.nm,'XXX') = 'XXX' then names.nm else concat(names.nm,', ',brnn.nm) end as crd,
		tran_type.tran_type tty,account.account_name acc,tran_desc dsc, 
		tran_amount*cr_dr amt, receipt_ind rcpt, dd_ind dd, contactless ctls, 
		statement_date std,cheque_no chq,date_created dtc, date_amended dta,
		null frq, null cst, transdet.crdd crdd, transdet.brnd brnd
		from transdet
		join account on transdet.account_id=account.account_id
		join tran_type on transdet.tran_type_id=tran_type.tran_type_id
		join names on transdet.crdd=names.id and transdet.tran_date between names.dtf and names.dtt and names.typ=1
		left join names brnn on brnn.id=transdet.brnd and brnn.typ=2
		where " . $ordcol . " is not null " . $whr . " order by " . $ordcol . " " . $orddr .
		" limit " . $limit;
		echo "<p/>" . $sql; 
	foreach($conn->query($sql) as $row) {
		if ($row['rcpt']==1) {$rcpt="checked";} else {$rcpt="";}
		if ($row['dd']==1) {$dd="checked";}else{$dd="";}
		if ($row['ctls']==1) {$ctls="checked";}else{$ctls="";}
		echo "<tr>
			<!-- <td>" . $row['tid'] . "</td> -->
				<td style=\"width:20px; height:20px;\">" . $row['trd'] . "</td>
				<td style=\"width:100px; height:20px;\">" . $row['crd'] . "</td>
				<td style=\"width:100px; height:20px;\">" . $row['dsc'] . "</td>
				<td>" . $row['tty'] . "</td>
				<td>" . $row['acc'] . "</td>
				<td align=center>" . $row['amt'] . "</td>
				<td><input type=\"checkbox\" " . $rcpt . "></input></td>
				<td><input type=\"checkbox\" " . $ctls . "></input></td>
  				<td><input type=\"checkbox\" " . $dd . "></input></td>
  				<td style=\"width:20px; height:20px;\">" . $row['std'] . "</td>
  				<td>" . $row['chq'] . "</td>
  				<td>" . $row['frq'] . "</td>
  				<td>" . $row['cst'] . "</td>
  				<!-- <td>" . $row['dtc'] . "</td><td>" . $row['dta']. "</td> -->
  				<td><a href=\"form.php?tid=" . $row['tid'] . "\">mod</a></td>
				<td><a href=\"post.php?addmod=del&tid=" . $row['tid'] . "\">del</a></td>
			</tr>";

	}
?>
</table>
</form>
</div>
<!--
<div id="footer">
<?php include('dir.php'); ?>
</div>
-->
</div>
</body>
</html>
