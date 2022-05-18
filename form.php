<?php include 'leftmenu.php'; ?>
<?php

ini_set('display_errors',1);
error_reporting(E_ALL);

function fchkbx($name,$value) {
  echo $name . $value;
  if ($value=="on") {
    echo "<input name=\"" . $name . "\" type=\"checkbox\" checked />";
  } elseif ($value=="1") {
    echo "<input name=\"" . $name . "\" type=\"checkbox\" checked />";
  } else {
    echo "<input name=\"" . $name . "\" type=\"checkbox\" />";
  }
}
function setter($postparm){
	if (isset($_POST[$postparm])) { echo $_POST[$postparm]; }
}
function fslct($conn,$sql,$whr,$ord,$matchto,$id,$desc,$thisform) {
//	echo "fslct : " . $sql . $whr . $ord . " id: " . $id . " desc: " . $desc . " matchto: " . $matchto;
  echo "<select name=\"" . $id . "\" onchange='this.form.action=\"form.php\"; this.form.submit()'><option value=\"0\">";
  foreach($conn->query($sql . $whr . $ord) as $row) {
    if ($matchto==$row[$id]) {
  	echo "<option value=\"". $row[$id] . "\" selected>" . $row[$desc];
    } else {
  	echo "<option value=\"". $row[$id] . "\">" . $row[$desc];
    }
  }
  echo " </select>";
}

include 'connect.php';
if (isset($_GET['tid'])) { $tid = $_GET['tid']; } if (isset($_POST['tid'])) { $tid=$_POST['tid']; }
//if (isset($_GET['crdd'])) { $crdd = $_GET['crdd']; } if (isset($_POST['crdd'])) { $crdd=$_POST['crdd']; } echo "line 20 $crdd : " . $crdd;

/*echo "<br/>tid is " . $tid;*/

//		ADD
//		ADD
//		ADD
//		ADD
if (empty($tid)) { /* echo "tid is empty"; echo "add one"; */
	?>
	<h1>transdet add form</h1>
	<form action="post.php" method="post">
	<input name="addmod" value="add" type="hidden">
	<table>
		<tr>
			<td>tran date</td><td><input name="trd" value="<?php echo setter('trd'); ?>"></input></td></tr>
			<td>new creditor</td><td><input name="crn" value="<?php echo setter('crn') ?>"></input></td>
			<td>new branch</td><td><input name="brn" value="<?php echo setter('brn'); ?>"></input></td></tr>
			<td>desc</td><td><input name="dsc" value="<?php echo setter('dsc'); ?>"></input></td></tr>
			<tr>
				<td>creditor</td><td>
				<?php
				if (isset($_POST['crdd'])) { $crdd = $_POST['crdd']; } else { $crdd = 0; }
/*				echo fslct($conn,"select crdd,nm crd  from crdn "," where 1=1 "," group by crdd,crd order by 1",$crdd,'crdd','crd','func.php');			*/
				echo fslct($conn,"select id crdd,nm crd from names "," where typ=1 "," group by id,nm order by 1",$crdd,'crdd','crd','func.php');
				?>
				</td>
				<td>branch</td><td>
				<?php
				// BRANCH MADE MORE COMPLEX BY BEING DEPENDENT ON VALUE OF CREDITOR
				if (isset($_POST['crdd'])) {
				// crdd was being set independedntly before (below)
  					$crdd = $_POST['crdd'];
  					$brnwhr = " where c2.id=" . $_POST['crdd'];
				} else {
  					$brnwhr = " where c2.id=0";
				}
		//	echo "brnd : " . $_POST['brnd'];	
				if (isset($_POST['brnd'])) { $brnd = $_POST['brnd']; } else { $brnd = 0; }
				echo fslct(	$conn,
						/*"select c1.id brnd,c1.nm brn  from transdet join brnn c1 on brnd=c1.id join crdn c2 on c2.crdd=transdet.crdd",*/
						"select c1.id brnd,c1.nm brn  from transdet join names c1 on brnd=c1.id and c1.typ=2 join names c2 on c2.id=transdet.crdd and c2.typ=1",
						$brnwhr,
						" group by brnd,brn order by brn",
						$brnd,
						'brnd',
						'brn',
						'func.php');
				?>
				</td>
			</tr>
			<tr>
				<td>tran type</td>
				<td>
				<?php
				if (isset($_POST['ttyd'])) { $ttyd = $_POST['ttyd']; } else { $ttyd = 0; }
				echo fslct($conn,"select tran_type_id ttyd,tran_type tty from tran_type"," where 1=1"," order by tran_type_id",$ttyd,'ttyd','tty','func.php');
				?>
				</td>
			</tr>
			<tr>
				<td>account</td>
				<td>
				<?php
				if (isset($_POST['accd'])) { $accd = $_POST['accd']; } else { $accd = 0; }
				echo fslct($conn,"select account_id accd,account_name acc from account"," where 1=1"," order by account_id",$accd,'accd','acc','func.php');
				?>
				</td>
			</tr>
			<tr>
				<td>frequency</td>
				<td>
				<?php
				if (isset($_POST['frqd'])) { $frqd = $_POST['frqd']; } else { $frqd = 0; }
				echo fslct($conn,"select freq_id frqd,freq_name frq from frequency"," where 1=1"," order by freq_id",$frqd,'frqd','frq','func.php');
				?>
				</td>
			</tr>
			<tr>
				<td>cost</td>
				<td>
				<?php
				if (isset($_POST['cstd'])) { $cstd = $_POST['cstd']; } else { $cstd = 0; }
				echo fslct($conn,"select cost_code cstd,cost cst from cost_center"," where 1=1"," order by cost_code",$cstd,'cstd','cst','func.php');
				?>
				</td>
			</tr>
			<tr><td>receipt</td><td><?php echo fchkbx("rcpt",setter('rcpt')); ?></td></tr>
			<tr><td>contactless</td><td><?php echo fchkbx("contactless",setter('contactless')); ?></td></tr>
			<tr>
				<td>dd</td><td><?php echo fchkbx("dd",setter('dd')); ?></td></tr>
				<td>amount</td><td><input name="amt"  value="<?php echo setter('amt'); ?>"/></td>
				<td>cr/dr</td><td><input name="crdr" type="radio" value="1"/><input name="crdr" type="radio" value="-1" checked /></td></tr>
			<tr><td>cheque no</td><td><input name="chq"  value="<?php echo setter('chq'); ?>"/></td></tr>
			<tr><td>statement date</td><td><input name="std"  value="<?php echo setter('std'); ?>"/></td></tr>
			<tr>
				<td>booking</td>
				<td>
				<?php
				if (isset($_POST['bkd'])) { $bkd = $_POST['bkd']; } else { $bkd = 0; }
				echo fslct($conn,"select id bkd,ref bk from bk_booking"," where 1=1"," order by id",$bkd,'bkd','bk','func.php');
				?>
				</td>
			</tr>
			<tr><td><input type="submit" /></td></tr>
		</table>
	</form>

<!-- BECAUSE TID HAS A VALUE, PROCESS IS MODIFYING, IF PARAMATER PLUS=1 THEN INCREMENT TRAN AND STATEMENT DATES BY 1 MONTH-->
<?php

} else {
			//	MODIFY
			//	MODIFY
			//	MODIFY
//						CANNOT DEAL WITH NEW BRACHES ON EXISTING CREDITORS YET - MONDAY 17TH JUNE 2019
//						CANNOT DEAL WITH NEW BRACHES ON EXISTING CREDITORS YET - MONDAY 17TH JUNE 2019
//						CANNOT DEAL WITH NEW BRACHES ON EXISTING CREDITORS YET - MONDAY 17TH JUNE 2019
	$sql="select tran_id tid,tran_date trd,
	    c1.nm crd,c1.crdd crdd,tran_creditor crn,c2.id brnd,transdet.frequency frqd,transdet.cost_code cstd,
		transdet.tran_type_id ttyd, transdet.account_id accd,tran_type.tran_type tty,account.account_name acc,tran_desc dsc, tran_amount amt,
		cr_dr crdr,receipt_ind rcpt, dd_ind dd, statement_date std,cheque_no chq,
		user_created utc, user_amended uta,date_created dtc, date_amended dta,contactless
		from transdet
		left join crdn c1 on transdet.crdd=c1.crdd
		left join brnn c2 on brnd=c2.id
		join account on transdet.account_id=account.account_id
		join tran_type on transdet.tran_type_id=tran_type.tran_type_id where tran_id=" . $tid ;
//new query uses name table instead of old crdn.
	$sql="select tran_id tid,tran_date trd,
	    c1.nm crd,c1.crdd crdd,tran_creditor crn,c2.id brnd,transdet.frequency frqd,transdet.cost_code cstd,
		transdet.tran_type_id ttyd, transdet.account_id accd,tran_type.tran_type tty,account.account_name acc,tran_desc dsc, tran_amount amt,
		cr_dr crdr,receipt_ind rcpt, dd_ind dd, statement_date std,cheque_no chq,
		user_created utc, user_amended uta,date_created dtc, date_amended dta,contactless
		from transdet
		left join name c1 on transdet.crdd=c1.crdd and transdet.tran_date between c1.dtf and c1.dtt
		left join brnn c2 on brnd=c2.id
		join account on transdet.account_id=account.account_id
		join tran_type on transdet.tran_type_id=tran_type.tran_type_id where tran_id=" . $tid ;
//new query uses nameis table for creditors and branches
	$sql="select tran_id tid,tran_date trd,
	    c1.nm crd,c1.id crdd,tran_creditor crn,c2.id brnd,transdet.frequency frqd,transdet.cost_code cstd,
		transdet.tran_type_id ttyd, transdet.account_id accd,tran_type.tran_type tty,account.account_name acc,tran_desc dsc, tran_amount amt,
		cr_dr crdr,receipt_ind rcpt, dd_ind dd, statement_date std,cheque_no chq,
		user_created utc, user_amended uta,date_created dtc, date_amended dta,contactless
		from transdet
		left join names c1 on transdet.crdd=c1.id and transdet.tran_date between c1.dtf and c1.dtt and c1.typ=1
		left join names c2 on brnd=c2.id and c2.typ=2
		join account on transdet.account_id=account.account_id
		join tran_type on transdet.tran_type_id=tran_type.tran_type_id where tran_id=" . $tid ;
	if ($_GET['plus']==1) 
	$sql="select tran_id tid,date_add(tran_date,interval 1 month) trd,
	    c1.nm crd,c1.id crdd,tran_creditor crn,c2.id brnd,transdet.frequency frqd,transdet.cost_code cstd,
		transdet.tran_type_id ttyd, transdet.account_id accd,tran_type.tran_type tty,account.account_name acc,tran_desc dsc, tran_amount amt,
		cr_dr crdr,receipt_ind rcpt, dd_ind dd, date_add(statement_date,interval 1 month) std,cheque_no chq,
		user_created utc, user_amended uta,date_created dtc, date_amended dta,contactless
		from transdet
		left join names c1 on transdet.crdd=c1.id and transdet.tran_date between c1.dtf and c1.dtt and c1.typ=1
		left join names c2 on brnd=c2.id and c2.typ=2
		join account on transdet.account_id=account.account_id
		join tran_type on transdet.tran_type_id=tran_type.tran_type_id where tran_id=" . $tid ;
	foreach($conn->query($sql) as $row) {
		?>
			<h1>transdet modify form</h1>
			<form action="post.php" method="post">
			<input name="tid" value="<?php echo $tid; ?>"  type="hidden" />
			<table>
				<tr>
					<td>tran date</td>
					<td><input name="trd" value="<?php echo $row['trd']; ?>"></input></td>
				</tr>
					<td>desc</td>
					<td><input name="dsc" value="<?php echo $row['dsc']; ?>"></input></td>
				</tr>
				<tr>
					<td>creditor</td>
					<td>
						<?php 
							if (isset($_POST['crdd'])) { 
								$crdd = $_POST['crdd']; 
							} else { 
								$crdd = $row['crdd']; 
							}
							echo fslct(	$conn,
						/*		SWAPPED CRDN TABLE FOR NAME TABLE	
									"select crdn.crdd crdd ,nm crd  from transdet join crdn on transdet.crdd=crdn.crdd ",
									" where 1=1",
									" group by crdn.crdd, crdn.nm order by crd",	
								SWAPPED NAMES TO FOR CRD AND BRN
									"select name.crdd crdd ,nm crd  from transdet join name on transdet.crdd=name.crdd ",
									" where 1=1",
									" group by name.crdd, name.nm order by crd", */
									"select names.id crdd ,nm crd  from transdet join names on transdet.crdd=names.id and names.typ=1 ",
									" where 1=1",
									" group by names.id, names.nm order by nm",
									$crdd,
							/*		'crdd',
									'crd',		*/
									'crdd',
									'crd',
									'func.php');
						?>
					</td>
					<td>branch</td>
					<td>
						<?php
							if ($crdd==null) {
							  $brnwhr = " where c2.id=0";
							} else {
							  $brnwhr = " where c2.crdd=" . $crdd;
							  $brnwhr = " where c2.id=" . $crdd;
							}
							echo "brnd : " . $_POST['brnd'];
							//if (empty($_POST['brnd'])) { $brnd = $row['brnd']; } else { $brnd = $_POST['brnd']; }
							if (isset($_POST['brnd'])) { 
								$brnd = $_POST['brnd']; 
							} else { 
								$brnd = $row['brnd']; 
							}
							echo fslct(	$conn,
					/*				NAME TABLE REPLACES CRDN.
									"select c1.id brnd,c1.nm brn  from transdet join brnn c1 on brnd=c1.id join crdn c2 on c2.crdd=transdet.crdd",		
									NAMES TABLE REPLACES CRDN AND BRNN
									"select c1.id brnd,c1.nm brn  from transdet join brnn c1 on brnd=c1.id join name c2 on c2.crdd=transdet.crdd",		*/
									"select c1.id brnd,c1.nm brn  from transdet join names c1 on brnd=c1.id and c1.typ=2 join names c2 on c2.id=transdet.crdd and c2.typ=1",
									$brnwhr,
									" group by brnd,brn order by brn",
									$brnd,
									'brnd',
									'brn',
									'func.php');
						?>
			<tr>
				<td>new creditor</td><td><input name="crn" value="<?php echo setter('crn'); ?>"></input></td>
				<td>new branch</td><td><input name="brn" value="<?php echo setter('brn'); ?>"></input></td>
			</tr>
			</tr>

			</td></tr><tr><td>tran type</td><td>
			<?php
				if (empty($_POST['ttyd'])) { $ttyd = $row['ttyd']; } else { $ttyd = $_POST['ttyd']; }
				echo fslct($conn,"select tran_type_id ttyd,tran_type tty from tran_type"," where 1=1"," order by tran_type_id",$ttyd,'ttyd','tty','func.php');
			?>
			</td></tr><tr><td>account</td><td>
			<?php
				if (empty($_POST['accd'])) { $accd = $row['accd']; } else { $accd = $_POST['accd']; }
				echo fslct($conn,"select account_id accd,account_name acc from account"," where 1=1"," order by account_id",$accd,'accd','acc','func.php');
			?>
			</td></tr><tr><td>frequency</td><td>
			<?php
				if (empty($_POST['frqd'])) { $frqd = $row['frqd']; } else { $frqd = $_POST['frqd']; }
				echo fslct($conn,"select freq_id frqd,freq_name frq from frequency"," where 1=1"," order by freq_id",$frqd,'frqd','frq','func.php');
			?>
			</td></tr><tr><td>cost</td><td>
			<?php
				if (empty($_POST['cstd'])) { $cstd = $row['cstd']; } else { $cstd = $_POST['cstd']; }
				echo fslct($conn,"select cost_code cstd,cost cst from cost_center"," where 1=1"," order by cost_code",$cstd,'cstd','cst','func.php');
			?>
			</td></tr><?php echo "rcpt " . $row['rcpt'] . " dd " . $row['dd']; ?>
			<tr><td>receipt</td><td>
				<?php if (empty($_POST['rcpt'])) {$rcpt=$row['rcpt'];}else{$rcpt=$_POST['rcpt'];}
				if ($rcpt==1) {$checked="checked";}else{$checked="";} ?>
				<input type="checkbox" name="rcpt" value="1" <?php echo $checked; ?> />
			</td></tr>
			<tr>
				<td>contactless</td>
				<td>
					<!-- <td><?php echo fchkbx("contactless",setter('contactless')); ?></td> -->
					<?php if (empty($_POST['contactless'])) {$contactless=$row['contactless'];} else {$contactless=$_POST['contactless'];}
					if ($contactless==1) {$checked="checked";}else{$checked="";} ?>
					<input type="checkbox" name="contactless" value="1" <?php echo $checked; ?> />
				</td>
			</tr>
			<tr><td>dd</td><td>
				<?php if (empty($_POST['dd'])) {$dd=$row['dd'];}else{$dd=$_POST['dd'];}
				if ($dd==1) {$checked="checked";}else{$checked="";} ?>
				<input type="checkbox" name="dd" value="1" <?php echo $checked; ?> />
			</td></tr>
			<td>amount</td><td><input name="amt"  value="<?php echo $row['amt']; ?>"/></td>
			<?php if ($row['crdr']==-1) { ?>
				<td>cr/dr</td><td><input name="crdr" type="radio" value="1" /><input name="crdr" type="radio" value="-1" checked /></td>
			<?php } else { ?>
				<td>cr/dr</td><td><input name="crdr" type="radio" value="1" checked /><input name="crdr" type="radio" value="-1" /></td>
			<?php } ?>
			</tr>
			<tr><td>cheque no</td><td><input name="chq"  value="<?php echo $row['chq']; ?>"/></td></tr>
			<tr><td>statement date</td><td><input name="std"  value="<?php echo $row['std']; ?>"/></td></tr>
			<tr>
				<td>user created</td><td bgcolor="lightgray"><?php echo $row['utc']; ?></td>
				<td>user amended</td><td bgcolor="lightgray"><?php echo $row['uta']; ?></td>
			</tr>
			<tr>
				<td>date created</td><td bgcolor="lightgray"><?php echo $row['dtc']; ?></td>
				<td>date amended</td><td bgcolor="lightgray"><?php echo $row['dta']; ?></td>
			</tr>
			<!-- <tr><td><input type="submit" /></td></tr>	-->
			<tr><td><input type="submit" name="addmod" value="mod"/></td><td><input type="submit" name="addmod" value="add" /></td></tr>
		</table>
		</form>


<?php
	}
}
?>
