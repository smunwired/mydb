<?php include 'leftmenu.php'; ?>

<h1>transdet modify post</h1>
<?php
echo "contactless : " . $_POST['contactless'] . "<br/>";
function newCrn($crn) {
	$isrt = "insert into crd(nm) values (\"" . $crn . "\")";
	$isrt = "insert into crd(crdd,nm) values (" . lastInsertId() . ",\"" . $crn . "\")";
	try {
		$stmt = $conn->prepare($isrt);
			// execute the query
		$stmt->execute();
			// echo a message to say the UPDATE succeeded
		echo "<br/>" . $stmt->rowCount() . " record(s) INSERTED creditor into crd successfully";
		echo "<br/>" . $conn->lastInsertId() . " last id INSERTED.";
		$crdd = $conn->lastInsertId();
	} catch (Exception $e) {
	    // Here you can either echo the exception message like:
	    echo "<br/>some kind of failure here...";
		echo $e->getMessage();
	    /* Or you can throw the Exception Object $e like:
	        throw $e;
	    */
	}
}
function crdn($conn,$id){echo "<p>function crdn, called with id : " . $id;
  foreach($conn->query("select crdd from crdn where id = " . $id) as $row) {
    return $row[$crdd];
  }
}
//THIS APPEARS TO BE THE ACTIVE FUNCTION (2019-06-13)
function fn1($conn,$tx) {
		echo "<p>inserting this crn (TX) : " . $tx;
		$isrt = "insert into crdn(nm) values (\"" . $tx . "\")";
//this fix (fix?) makes id and crdd the same, no longer remember why I ever split them out.
		$isrt = "insert into crd(crdd,nm) values (" . lastInsertId() . ",\"" . $crn . "\")";
		$isrt = "insert into crd(crdd,nm) values (1000000,\"" . $crn . "\")";
		echo "<p>" . $isrt;
		try {
			$stmt = $conn->prepare($isrt);
//
//			// execute the query
			$stmt->execute();
//
//			// echo a message to say the UPDATE succeeded
			//echo "<br/>" . $stmt->rowCount() . " record(s) INSERTED creditor into crd successfully";
			$lastcrnd = $conn->lastInsertId();
			echo " last id INSERTED: " . $lastcrnd;
			//$crdd = $conn->lastInsertId();
		} catch (Exception $e) {
//		    // Here you can either echo the exception message like:
		    echo "<br/>some kind of failure here...";
			echo $e->getMessage();
//		    /* Or you can throw the Exception Object $e like:
//		        throw $e;
//		    */
		}
		return $lastcrnd;
//	return "<br> this the ths formatted line in fn1 " . $tx . " it is not clever ut it works!";
}




function validateInput($input,$val) {
    if (empty($val)) {
//    DIS DONT DO IT
      throw new Exception($input . " must have a value.");
    }
}
echo "<br/>addmod post " . $_POST['addmod'];
echo "<br/><b>brnd<b> : " . $_POST['brnd'];
//echo "<br/>addmod post " . $_POST['addmod'] . "<br/> get " . $_GET['addmod'];
//echo "<br/>addmod post " . $_POST['addmod'] . "<br/> get " . $_GET['addmod'];
//echo "<br/>addmod post " . $_POST['addmod'] . "<br/> get " . $_GET['addmod'];
//echo "<br/>addmod post " . $_POST['addmod'] . "<br/> get " . $_GET['addmod'];
//echo "<br/>addmod post " . $_POST['addmod'] . "<br/> get " . $_GET['addmod'];
//echo "<br/>dd : " . $_POST['dd'];
//echo "<br/>rcpt : " . $_POST['rcpt'];


// THAT'S ALL THE FUNCTIONS DEFINED, NOW PROCESS...

//WHAT ARE WE DOING HERE ?
echo "addmod : " . $_GET['addmod'];

if (isset($_GET['addmod'])) { echo "<br/>addmod is set";
	if ($_GET['addmod']=="del") {
		echo "<br/>delete selected";
	?>
	<h1>transdet delete post</h1>
	<?php
		include 'connect.php';
//DONT NEED ALL THIS VALIDATION FOR A DELETE DO I ?
//DONT NEED ALL THIS VALIDATION FOR A DELETE DO I ?
//DONT NEED ALL THIS VALIDATION FOR A DELETE DO I ?
		echo "<br/>trd " . $_POST['trd'] . ", std " . $_POST['std'] . ", chq " . $_POST['chq'];
		$trd = "'" . $_POST['trd'] . "'";
//		$crn = "'" . $_POST['crn'] . "'"; ONLY ENTERED IF THERE IS A VALUE sm20151017
		$crn = $_POST['crn'];
		$dsc = "'" . $_POST['dsc'] . "'";
		$amt = $_POST['amt'];
		$crdr = $_POST['crdr'];
		$ttyd = $_POST['ttyd'];
		$accd = $_POST['accd'];
		if ($_POST['std']==0){$std = "null";}else{$std= "'" . $_POST['std'] . "'";}
		if ($_POST['chq']==0){$chq = "null";}else{$chq=$_POST['chq'];}

		if ($_POST['rcpt']=="on") { $rcpt=1; } else { $rcpt=0; }

		if ($_POST['dd']=="on") { $dd=1; } else { $dd=0; }


		if ($_POST['chq']==0) { $chq="null"; } else { $chq = $_POST['chq']; }
		if ($_POST['frqd']==0) { $frqd="null"; } else { $frqd = $_POST['frqd']; }
		if ($_POST['crdd']==0) { $crdd="null"; } else { $crdd = $_POST['crdd']; }
		if ($_POST['brnd']==0) { $brnd="null"; } else { $brnd = $_POST['brnd']; }
		if ($_POST['cstd']==0) { $cstd="null"; } else { $cstd = $_POST['cstd']; }
	//	/*
	//	$isrt="insert into transdet(tran_date,tran_creditor,tran_desc,tran_amount,cr_dr,tran_type_id,account_id,statement_date,cheque_no,
	//	receipt_ind,dd_ind,date_created,user_created,frequency,cred_id,branch_id,cost_code)
	//	values(" . $trd . "," . $crn . "," . $dsc . "," . $amt . "," . $crdr . "," . $ttyd . "," . $accd . "," . $std . "," . $chq . "," .
	//	$rcpt . "," . $dd . ",current_timestamp,'phpuser'," . $frqd . "," . $crdd . "," . $brnd . "," . $cstd . ")";
	//	*/
		$dlt="delete from transdet where tran_id=" . $_GET['tid'];

		echo "<br/>dlt " . $dlt;


		// Prepare statement
		$stmt = $conn->prepare($dlt);

		// execute the query
		$stmt->execute();

		// echo a message to say the INSERT succeeded
		echo "<br/>" . $stmt->rowCount() . " record(s) DELETED successfully<br/><a href=\"list.php\">list</a>";
		} //end of delete block

//	ADD
//	ADD
//	ADD
//		no longer adding vales in tran_creditor on transdet table
} else if ($_POST['addmod']=='add') {
	//echo "addmod, do nothing!!!";
	?>
	<h1>transdet add post</h1>
	<!-- validation -->
	<?php
	echo "crn " . $_POST['crn'];
	echo " brn " . $_POST['brn'];
	echo "<br/>" . $_POST['addmod'] . " brnd: " . $_POST['brnd'];
	try {echo "validating input";
	  	validateInput('Amount',$_POST['amt']);
	  	validateInput('Tran Type',$_POST['ttyd']);
	  	validateInput('Account',$_POST['accd']);
	  	echo "post 	validating input";
		include 'connect.php';
		//echo "trd " . $_POST['trd'] . ", std " . $_POST['std'] . ", chq " . $_POST['chq'];
		$trd = "'" . $_POST['trd'] . "'";
		//$crn = "'" . $_POST['crn'] . "'";
		$crn = $_POST['crn'];
		$brn = $_POST['brn'];
		$dsc = "'" . $_POST['dsc'] . "'";
		$amt = $_POST['amt'];
		$crdr = $_POST['crdr'];
		//echo "crdr : " . $crdr;
		$ttyd = $_POST['ttyd'];
		$accd = $_POST['accd'];


//echo "<br/>crd " . $crn;

//THESE NEED TO BECOME FUNCTIONS THAT THE MODIFY SECTION CAN USE TOO
//THESE NEED TO BECOME FUNCTIONS THAT THE MODIFY SECTION CAN USE TOO
//THESE NEED TO BECOME FUNCTIONS THAT THE MODIFY SECTION CAN USE TOO


	if (!empty($crn)) {
#echo "<p> crn is NOT empty, about to call function fn1 using " . $crn;
		$id = fn1($conn,$crn);
//                $crdd = crdn($conn,$id);
//		echo "<br>new crdd:" . $crdd;
//		echo "<br>new crdd:" . $id;
$crdd = $id;
////		newCrn($crn);
//		echo "inserting this crn : " . $crn;
//		$isrt = "insert into crd(nm) values (\"" . $crn . "\")";
//		try {
//			$stmt = $conn->prepare($isrt);
//
//			// execute the query
//			$stmt->execute();
//
//			// echo a message to say the UPDATE succeeded
//			echo "<br/>" . $stmt->rowCount() . " record(s) INSERTED creditor into crd successfully";
//			echo "<br/>" . $conn->lastInsertId() . " last id INSERTED.";
//			$crdd = $conn->lastInsertId();
//		} catch (Exception $e) {
//		    // Here you can either echo the exception message like:
//		    echo "<br/>some kind of failure here...";
//			echo $e->getMessage();
//		    /* Or you can throw the Exception Object $e like:
//		        throw $e;
//		    */
//		}
	}
// INSERT A NEW BRANCH
	if (!empty($brn)) {
		$isrt = "insert into brnn(nm) values (\"" . $brn . "\")";
		echo $isrt;
		try {
			$stmt = $conn->prepare($isrt);

			// execute the query
			$stmt->execute();

			// echo a message to say the UPDATE succeeded
			echo "<br/>" . $stmt->rowCount() . " record(s) INSERTED new branch into crd successfully";
			echo "<br/>" . $conn->lastInsertId() . " last id INSERTED.";
			$brnd = $conn->lastInsertId();
		} catch (Exception $e) {
		    // Here you can either echo the exception message like:
		    echo "<br/>some kind of failure here...";
			echo $e->getMessage();
		    /* Or you can throw the Exception Object $e like:
		        throw $e;
		    */
		}
	}


echo "<br/>echo";

		if (empty($_POST['trd'])) { $trd="null"; } else { $trd= "'" . $_POST['trd'] . "'"; }
		if (empty($_POST['std'])) { $std="null"; } else { $std= "'" . $_POST['std'] . "'"; }

		if ($_POST['chq']==0){$chq = "null";}else{$chq=$_POST['chq'];}

		if (($_POST['rcpt']=="on")||($_POST['rcpt']=="1")) { $rcpt=1; } else { $rcpt=0; }
		echo "contactless " . $_POST['contactless']; if (($_POST['contactless']=="on")||($_POST['contactless']=="1")) { $contactless=1; } else { $contactless=0; }

		if (($_POST['dd']=="on")||($_POST['dd']=="1")) { $dd=1; } else { $dd=0; }


		if ($_POST['chq']==0) { $chq="null"; } else { $chq = $_POST['chq']; }
		if ($_POST['frqd']==0) { $frqd="null"; } else { $frqd = $_POST['frqd']; }
		//manually entered creditor will have set $crdd already
		if (empty($crn)) {
			if ($_POST['crdd']==0) { $crdd="null"; } else { $crdd = $_POST['crdd']; }
		}
		//manually enetered branch will have $brnd set already
		if (empty($brn)) {
			if ($_POST['brnd']==0) { $brnd="null"; } else { $brnd = $_POST['brnd']; }
		}
		if ($_POST['cstd']==0) { $cstd="null"; } else { $cstd = $_POST['cstd']; }

		$isrt="insert into transdet(tran_date,tran_creditor,tran_desc,tran_amount,cr_dr,tran_type_id,account_id,statement_date,cheque_no,
		receipt_ind,dd_ind,date_created,user_created,frequency,cred_id,branch_id,cost_code)
		values(" . $trd . "," . $crn . "," . $dsc . "," . $amt . "," . $crdr . "," . $ttyd . "," . $accd . "," . $std . "," . $chq . "," .
		$rcpt . "," . $dd . ",current_timestamp,'phpuser'," . $frqd . "," . $crdd . "," . $brnd . "," . $cstd . ")";

		$isrt="insert into transdet(tran_date,tran_creditor,tran_desc,tran_amount,cr_dr,tran_type_id,account_id,statement_date,cheque_no,
		receipt_ind,dd_ind,date_created,user_created,frequency,crdd,brnd,cost_code)
		values(" . $trd . "," . $crn . "," . $dsc . "," . $amt . "," . $crdr . "," . $ttyd . "," . $accd . "," . $std . "," . $chq . "," .
		$rcpt . "," . $dd . ",current_timestamp,'phpuser'," . $frqd . "," . $crdd . "," . $brnd . "," . $cstd . ")";

		$isrt="insert into transdet(tran_date,tran_desc,tran_amount,cr_dr,tran_type_id,account_id,statement_date,cheque_no,
		receipt_ind,dd_ind,date_created,user_created,frequency,crdd,brnd,cost_code,contactless)
		values(" . $trd . "," . $dsc . "," . $amt . "," . $crdr . "," . $ttyd . "," . $accd . "," . $std . "," . $chq . "," .
		$rcpt . "," . $dd . ",current_timestamp,'phpuser'," . $frqd . "," . $crdd . "," . $brnd . "," . $cstd . "," . $contactless . ")";

		echo "isrt " . $isrt;


		// Prepare statement
		$stmt = $conn->prepare($isrt);

		// execute the query
		$stmt->execute();

		// echo a message to say the INSERT succeeded
		echo "<br/>" . $stmt->rowCount() . " record(s) INSERTED successfully<br/><a href=\"list.php\">list</a>";
		} catch(PDOException $e) {
		  //  echo "Connection failed: " . $e->getMessage();
		  echo "<br/> PDO failure <br/>" . $e->getMessage();
		}
} else { echo "<br/>Modding";
		//	MODIFY
		//	MODIFY
		//	MODIFY
	try {
  		validateInput('Amount',$_POST['amt']);
  		validateInput('Tran Type',$_POST['ttyd']);
  		validateInput('Account',$_POST['accd']);
		include 'connect.php';
		/*		date fields		*/


	if (empty($_POST['trd'])) { $trd="null"; } else { $trd = "'" . $_POST['trd'] . "'"; }
	if (empty($_POST['std'])) { $std="null"; } else { $std = "'" . $_POST['std'] . "'"; }
//	$crn = "'" . $_POST['crn'] . "'"; echo "<br>new crn ? " . $crn;
//		$crn = "'" . $_POST['crn'] . "'"; ONLY ENTERED IF THERE IS A VALUE sm20151017
		$crn = $_POST['crn'];
	$dsc = "'" . $_POST['dsc'] . "'";
	$amt = $_POST['amt'];
	echo "crdr : " . $_POST['crdr'];
	$crdr = $_POST['crdr'];
	$ttyd = $_POST['ttyd'];
	$accd = $_POST['accd'];
//	if ($_POST['std']==0){$std = "null";}else{$std= "'" . $_POST['std'] . "'";}
	if ($_POST['chq']==0){$chq = "null";}else{$chq=$_POST['chq'];}
/*		checkboxes		*/
	//echo "<br/>rcpt " . $_POST['rcpt'] . " & dd " . $_POST['dd'];
    if (empty($_POST['rcpt'])) { $rcpt = 0; } else { $rcpt = 1; }
    if (empty($_POST['dd'])) { $dd = 0; } else { $dd = 1; }

	if ($_POST['chq']==0) { $chq="null"; } else { $chq = $_POST['chq']; }
	if ($_POST['frqd']==0) { $frqd="null"; } else { $frqd = $_POST['frqd']; }
	if ($_POST['crdd']==0) { $crdd="null"; } else { $crdd = $_POST['crdd']; }
	if ($_POST['brnd']==0) { $brnd="null"; } else { $brnd = $_POST['brnd']; }
	if ($_POST['cstd']==0) { $cstd="null"; } else { $cstd = $_POST['cstd']; }
	//sm20151017
	$brn = $_POST['brn']; echo "<br/>mod, brn is " . $brn;
	$brnd = $_POST['brnd']; echo "<br/>mod, brnd is " . $brnd;
	if ($_POST['contactless']=='on'||$_POST['contactless']==1) { $contactless=1; } else { $contactless=0; }

//if (empty($crn)) { echo "<br>crn is empty"; } else ( echo "<br>crn is NOT empty"; }

	if (!empty($crn)) {
//		newCrn($crn);
		echo "<br/>inserting this crn : " . $crn . ", length : " . strlen($crn);
		$isrt = "insert into crdn(nm) values (\"" . $crn . "\")";
		try {
			$stmt = $conn->prepare($isrt);

			// execute the query
			$stmt->execute();

			// echo a message to say the UPDATE succeeded
			echo "<br/>" . $stmt->rowCount() . " record(s) INSERTED creditor into crd successfully";
			echo "<br/>" . $conn->lastInsertId() . " last id INSERTED.";
			$crdd = $conn->lastInsertId();
		} catch (Exception $e) {
		    // Here you can either echo the exception message like:
		    echo "<br/>some kind of failure here...";
			echo $e->getMessage();
		    /* Or you can throw the Exception Object $e like:
		        throw $e;
		    */
		}
	}
	echo "<br/>modding, brn is " . $brnd . " and get is " . $GET['brnd'] . " and post is " . $POST['brnd'];

	if (!empty($brn)) {
		$isrt = "insert into brnn(nm) values (\"" . $brn . "\")";
		echo $isrt;
		try {
			$stmt = $conn->prepare($isrt);

			// execute the query
			$stmt->execute();

			// echo a message to say the UPDATE succeeded
			echo "<br/>" . $stmt->rowCount() . " record(s) INSERTED new branch into crd successfully";
			echo "<br/>" . $conn->lastInsertId() . " last id INSERTED.";
			$brnd = $conn->lastInsertId(); echo "<br/>$brnd : " . $brnd;
		} catch (Exception $e) {
		    // Here you can either echo the exception message like:
		    echo "<br/>some kind of failure here...";
			echo $e->getMessage();
		    /* Or you can throw the Exception Object $e like:
		        throw $e;
		    */
		}
	}


//starts - dont know if this will work
/*
		if (empty($_POST['trd'])) { $trd="null"; } else { $trd= "'" . $_POST['trd'] . "'"; }
		if (empty($_POST['std'])) { $std="null"; } else { $std= "'" . $_POST['std'] . "'"; }

		if ($_POST['chq']==0){$chq = "null";}else{$chq=$_POST['chq'];}

		if (($_POST['rcpt']=="on")||($_POST['rcpt']=="1")) { $rcpt=1; } else { $rcpt=0; }

		if (($_POST['dd']=="on")||($_POST['dd']=="1")) { $dd=1; } else { $dd=0; }


		if ($_POST['chq']==0) { $chq="null"; } else { $chq = $_POST['chq']; }
		if ($_POST['frqd']==0) { $frqd="null"; } else { $frqd = $_POST['frqd']; }
		//manually entered creditor will have set $crdd already
		if (empty($crn)) {
			if ($_POST['crdd']==0) { $crdd="null"; } else { $crdd = $_POST['crdd']; }
		}
		//manually enetered branch will have $brnd set already
		if (empty($brn)) {
			if ($_POST['brnd']==0) { $brnd="null"; } else { $brnd = $_POST['brnd']; }
		}
		if ($_POST['cstd']==0) { $cstd="null"; } else { $cstd = $_POST['cstd']; }
		if ($_POST['contactless']=='on'||$_POST['contactless']==1) { $contactless=1; } else { $contactless = 0; }
*/
//ends


echo "<br/>$brnd : " . $brnd;
	$updt="update transdet set tran_date=" . $trd .
	//",tran_creditor=" . $crn .
	",tran_desc=" . $dsc .
	",tran_amount=" . $amt .
	",cr_dr=" . $crdr .
	",tran_type_id=" . $ttyd .
	",account_id=" . $accd .
	",statement_date=" . $std .
	",cheque_no=" . $chq .
	",receipt_ind=" . $rcpt .
	",dd_ind=" . $dd .
	",date_amended=current_timestamp,user_amended='phpuser'
	,frequency=" . $frqd .
	",cred_id=" . $crdd .
	",branch_id=" . $brnd .
	",cost_code=" . $cstd . " where tran_id=" . $_POST['tid'];

	$updt="update transdet set tran_date=" . $trd .
//NOT USING TRAN_CREDITOR ANY MORE 20151017sm
//	",tran_creditor=" . $crn .
	",tran_desc=" . $dsc .
	",tran_amount=" . $amt .
	",cr_dr=" . $crdr .
	",tran_type_id=" . $ttyd .
	",account_id=" . $accd .
	",statement_date=" . $std .
	",cheque_no=" . $chq .
	",receipt_ind=" . $rcpt .
	",dd_ind=" . $dd .
	",date_amended=current_timestamp,user_amended='phpuser'
	,frequency=" . $frqd .
	",crdd=" . $crdd .
	",brnd=" . $brnd .
	",contactless=" . $contactless . 
	",cost_code=" . $cstd . 
	" where tran_id=" . $_POST['tid'];

echo "<p>" . $updt;

	// Prepare statement
	$stmt = $conn->prepare($updt);

	// execute the query
	$stmt->execute();

	// echo a message to say the UPDATE succeeded
	echo "<br/>" . $stmt->rowCount() . " record(s) UPDATED successfully";
	echo "<br/><a href=\"list.php\">list</a>";
} catch (Exception $e) {
    // Here you can either echo the exception message like:
	echo $e->getMessage();
    /* Or you can throw the Exception Object $e like:
        throw $e;
    */
}
}
?>
