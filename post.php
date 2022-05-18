<!-- 2020-7-26 exciting new concept, one post page to do everything -->
<!-- so far it only does para.php which I barely use and transactions, not sure why this is a good idea -->
<?php include 'leftmenu.php'; ?>
<?php
include 'connect.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


function validateInput($input,$val) {
    if (empty($val)) {
//    DIS DONT DO IT
      throw new Exception($input . " must have a value.");
    }
}
if (isset($_POST['page'])) 
  $page=$_POST['page']; 
else 
  $page="none";

echo "PAGE : " . $page;

if ($page=='para') {
  echo "<h1>insert paragraph</h1>";
  $isrt="insert into paragr (dt,txt) values ('" . $_POST['dt'] . "','" . $_POST['para'] . "')<br/>";
  echo "<br/>dlt " . $isrt;
  // Prepare statement
  $stmt = $conn->prepare($isrt);
  // execute the query
  $stmt->execute();
  // echo a message to say the INSERT succeeded
  echo "<br/>" . $stmt->rowCount() . " row INSERTED successfully<br/><a href=\"list.php\">list</a>";
} else {
   //VALIDATE - deletes will be messy until you tidy this up as request header has no data...
  if (isset($_POST['rcpt'])) { $rcpt='1'; } else { $rcpt=0; }
  if (isset($_POST['dd'])) $dd=1; else $dd=0;
  if (isset($_POST['contactless'])) $contactless=1; else  $contactless=0; 
    $trd = "'" . $_POST['trd'] . "'";
    $dsc = "'" . $_POST['dsc'] . "'";
    $crn = $_POST['crn'];
    $amt = $_POST['amt'];
    $crdr = $_POST['crdr'];
    $ttyd = $_POST['ttyd'];
    $accd = $_POST['accd'];
    if ($_POST['std']==0){$std = "null";}else{$std= "'" . $_POST['std'] . "'";}
    if ($_POST['chq']==0){$chq = "null";}else{$chq=$_POST['chq'];}
    if (isset($_POST['rcpt']))  $rcpt = 1;  else  $rcpt = 0;
    if ($_POST['chq']==0) { $chq="null"; } else { $chq = $_POST['chq']; }
    if ($_POST['frqd']==0) { $frqd="null"; } else { $frqd = $_POST['frqd']; }
    if ($_POST['crdd']==0) { $crdd="null"; } else { $crdd = $_POST['crdd']; }
    if ($_POST['brnd']==0) { $brnd="null"; } else { $brnd = $_POST['brnd']; }
    if ($_POST['cstd']==0) { $cstd="null"; } else { $cstd = $_POST['cstd']; }
    if (empty($_POST['trd'])) { $trd="null"; } else { $trd= "'" . $_POST['trd'] . "'"; }
    if (empty($_POST['std'])) { $std="null"; } else { $std= "'" . $_POST['std'] . "'"; }
    if ($_POST['chq']==0){$chq = "null";}else{$chq=$_POST['chq'];}
    if ($_POST['chq']==0) { $chq="null"; } else { $chq = $_POST['chq']; }
    if ($_POST['frqd']==0) { $frqd="null"; } else { $frqd = $_POST['frqd']; }

//	This page processed three types of request. "add" and "mod" are called from 
//	form.php, parameters will be in the request header and recovered using 
//	POST, del is invoked directly from list.php, appended to the page 
//	request so it arrives in a GET. 
//	Defaults to "mod", no idea if that is a good idea.
if (isset($_GET['addmod'])) {
  $addmod=$_GET['addmod'];
} elseif (isset($_POST['addmod'])) { 
  $addmod=$_POST['addmod']; 
} else { 
  $addmod='mod'; 
} 
//echo $addmod;

if ($addmod=='add') {
  echo "<h1>Add</h1>";
  // TESTING FOR NEW CREDITOR
  if (!empty($_POST['crn'])) 
{ 
//    echo "crn is empty"; 
//  } else { 
    $crn = $_POST['crn']; 
//  if (isset($_POST['crn'])) { 
//    echo "new crn";
// ADDING A NEW CREDITOR
    $isrt = "insert into crdn(crdd,nm) values (1000000,\"" . $crn . "\")"; echo $isrt;
    $isrt = "insert into names(nm) values (\"" . $crn . "\")"; 
echo $isrt;
    try {
      $stmt = $conn->prepare($isrt);
      $stmt->execute();
      $lastcrnd = $conn->lastInsertId();
      echo " last id INSERTED: " . $lastcrnd;
    } catch (Exception $e) {
      echo "<br/>some kind of failure here...";
      echo $e->getMessage();
    }    
  }  
  // TESTING FOR NEW BRANCH
  if (!empty($_POST['brn'])) {
//    echo "brn is empty";
//  } else {
    $brn = $_POST['brn'];
    $isrt = "insert into names(nm,typ) values (\"" . $brn . "\",2)"; 
echo $isrt;
    try {
      $stmt = $conn->prepare($isrt);
      $stmt->execute();
      $lastbrnd = $conn->lastInsertId();
      echo " last branch id INSERTED: " . $lastbrnd;
    } catch (Exception $e) {
      echo "<br/>some kind of failure here...";
      echo $e->getMessage();
    }    
  }  
//VALIDATE 
//              $crn = "'" . $_POST['crn'] . "'"; ONLY ENTERED IF THERE IS A VALUE sm20151017

/* 	2019-07-04 
	what the hell was this supposed to do ?
  $dsc="''";
*/
  if (empty($_POST['trd'])) { $trd="null"; } else { $trd= "'" . $_POST['trd'] . "'"; }
  if (empty($_POST['std'])) { $std="null"; } else { $std= "'" . $_POST['std'] . "'"; }
  if ($_POST['chq']==0){$chq = "null";}else{$chq=$_POST['chq'];}
  if ($_POST['chq']==0) { $chq="null"; } else { $chq = $_POST['chq']; }
  if ($_POST['frqd']==0) { $frqd="null"; } else { $frqd = $_POST['frqd']; }
  //manually entered creditor will have set $crdd already
  if (empty($crn)) {
     if ($_POST['crdd']==0) { $crdd="null"; } else { $crdd = $_POST['crdd']; }
  } else {
    $crdd = $lastcrnd;
  }
//  echo "at tis point you really should know the value of crdd & lastcrnd" . $crdd . " "  . $lastcrnd;
//  echo "<br/>at tis point you really should know the value of brnd & lastbrnd" . $brnd . " "  . $lastbrnd;

//manually enetered branch will have $brnd set already - IS THAT TRUE ?
  if (empty($brn)) {
    if ($_POST['brnd']==0) { $brnd="null"; } else { $brnd = $_POST['brnd']; }
  } else {
    $brnd = $lastbrnd;
  }
  if ($_POST['cstd']==0) { $cstd="null"; } else { $cstd = $_POST['cstd']; }

  $isrt="insert into transdet(tran_date,tran_desc,tran_amount,cr_dr,tran_type_id,account_id,statement_date,cheque_no,
   receipt_ind,dd_ind,date_created,user_created,frequency,crdd,brnd,cost_code,contactless)
   values(" . $trd . "," . $dsc . "," . $amt . "," . $crdr . "," . $ttyd . "," . $accd . "," . $std . "," . $chq . "," .
   $rcpt . "," . $dd . ",current_timestamp,'phpuser'," . $frqd . "," . $crdd . "," . $brnd . "," . $cstd . "," . $contactless . ")";

  echo "isrt " . $isrt;
  try {
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
} elseif ($addmod=='mod') {
echo "<br/> MODIFY";
//      MODIFY
//      MODIFY
//      MODIFY
//  try {
  validateInput('Amount',$_POST['amt']);
  validateInput('Tran Type',$_POST['ttyd']);
  validateInput('Account',$_POST['accd']);
///*              date fields             */
//    if (empty($_POST['trd'])) { $trd="null"; } else { $trd = "'" . $_POST['trd'] . "'"; }
//    if (empty($_POST['std'])) { $std="null"; } else { $std = "'" . $_POST['std'] . "'"; }
////      $crn = "'" . $_POST['crn'] . "'"; echo "<br>new crn ? " . $crn;
////      $crn = "'" . $_POST['crn'] . "'"; ONLY ENTERED IF THERE IS A VALUE sm20151017
//    $crn = $_POST['crn'];
//    $dsc = "'" . $_POST['dsc'] . "'";
//    $amt = $_POST['amt'];
//    echo "crdr : " . $_POST['crdr'];
//    $crdr = $_POST['crdr'];
//    $ttyd = $_POST['ttyd'];
//    $accd = $_POST['accd'];
////      if ($_POST['std']==0){$std = "null";}else{$std= "'" . $_POST['std'] . "'";}
//    if ($_POST['chq']==0){$chq = "null";}else{$chq=$_POST['chq'];}
///*              checkboxes              */
//        //echo "<br/>rcpt " . $_POST['rcpt'] . " & dd " . $_POST['dd'];
//    if (empty($_POST['rcpt'])) { $rcpt = 0; } else { $rcpt = 1; }
//    if (empty($_POST['dd'])) { $dd = 0; } else { $dd = 1; }
//
//    if ($_POST['chq']==0) { $chq="null"; } else { $chq = $_POST['chq']; }
//    if ($_POST['frqd']==0) { $frqd="null"; } else { $frqd = $_POST['frqd']; }
//    if ($_POST['crdd']==0) { $crdd="null"; } else { $crdd = $_POST['crdd']; }
//    if ($_POST['brnd']==0) { $brnd="null"; } else { $brnd = $_POST['brnd']; }
  if ($_POST['cstd']==0) { $cstd="null"; } else { $cstd = $_POST['cstd']; }
  // TESTING FOR NEW BRANCH
  if (empty($_POST['brn'])) {
    echo "brn is empty";
  } else {
    $brn = $_POST['brn'];
    $isrt = "insert into names(nm,typ) values (\"" . $brn . "\",2)"; 
echo $isrt;
    try {
      $stmt = $conn->prepare($isrt);
      $stmt->execute();
      $brnd = $conn->lastInsertId();
      echo " last branch id INSERTED: " . $brnd;
    } catch (Exception $e) {
      echo "<br/>some kind of failure here...";
      echo $e->getMessage();
    }    
  }  
//VALIDATE 
//    //sm20151017
//    $brn = $_POST['brn']; echo "<br/>mod, brn is " . $brn;
//    $brnd = $_POST['brnd']; echo "<br/>mod, brnd is " . $brnd;
//    if ($_POST['contactless']=='on'||$_POST['contactless']==1) { $contactless=1; } else { $contactless=0; }
//
////if (empty($crn)) { echo "<br>crn is empty"; } else ( echo "<br>crn is NOT empty"; }
//
//    if (!empty($crn)) {
////              newCrn($crn);
//      echo "<br/>inserting this crn : " . $crn . ", length : " . strlen($crn);
//      $isrt = "insert into name(nm) values (\"" . $crn . "\")";
//      try {
//        $stmt = $conn->prepare($isrt);
//        // execute the query
//        $stmt->execute();
//       //UPDATING
//       echo "<br/>$brnd : " . $brnd;
//  $updt="update transdet set tran_date=" . $trd .
////",tran_creditor=" . $crn .
//  ",tran_desc=" . $dsc .  ",tran_amount=" . $amt .  ",cr_dr=" . $crdr .  ",tran_type_id=" . $ttyd .  ",account_id=" . $accd .  ",statement_date=" . $std .  ",cheque_no=" . $chq .  ",receipt_ind=" . $rcpt .  ",dd_ind=" . $dd .  ",date_amended=current_timestamp,user_amended='phpuser' ,frequency=" . $frqd .  ",cred_id=" . $crdd .  ",branch_id=" . $brnd .  ",cost_code=" . $cstd . " where tran_id=" . $_POST['tid'];
//
  try {
        $updt="update transdet set tran_date=" . $trd .
        ",tran_desc=" . $dsc .  ",tran_amount=" . $amt .  ",cr_dr=" . $crdr .  ",tran_type_id=" . $ttyd .  ",account_id=" . $accd .  ",statement_date=" . $std .  ",cheque_no=" . $chq .  
	",receipt_ind=" . $rcpt .  ",dd_ind=" . $dd .  ",date_amended=current_timestamp,user_amended='phpuser' ,frequency=" . $frqd .  ",crdd=" . $crdd .  ",brnd=" . $brnd .  
	",contactless=" . $contactless .  ",cost_code=" . $cstd .  " where tran_id=" . $_POST['tid'];

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
//}
//
////if (empty($crn)) { echo "<br>crn is empty"; } else ( echo "<br>crn is NOT empty"; }
//
//        if (!empty($crn)) {
////              newCrn($crn);
//                echo "<br/>inserting this crn : " . $crn . ", length : " . strlen($crn);
//                $isrt = "insert into crdn(nm) values (\"" . $crn . "\")";
//                try {
//                        $stmt = $conn->prepare($isrt);
//
//                        // execute the query
//                        $stmt->execute();
//
//                        // echo a message to say the UPDATE succeeded
//                        echo "<br/>" . $stmt->rowCount() . " record(s) INSERTED creditor into crd successfully";
//                        echo "<br/>" . $conn->lastInsertId() . " last id INSERTED.";
//                        $crdd = $conn->lastInsertId();
//                } catch (Exception $e) {
//                    // Here you can either echo the exception message like:
//                    echo "<br/>some kind of failure here...";
//                        echo $e->getMessage();
//                    /* Or you can throw the Exception Object $e like:
//                        throw $e;
//                    */
//                }
//        }
//        echo "<br/>modding, brn is " . $brnd . " and get is " . $GET['brnd'] . " and post is " . $POST['brnd'];
//
//        if (!empty($brn)) {
//                $isrt = "insert into brnn(nm) values (\"" . $brn . "\")";
// /               echo $isrt;
///                try {
//                        $stmt = $conn->prepare($isrt);
//
//                        // execute the query
//                        $stmt->execute();
//
//                        // echo a message to say the UPDATE succeeded
//                        echo "<br/>" . $stmt->rowCount() . " record(s) INSERTED new branch into crd successfully";
//                        echo "<br/>" . $conn->lastInsertId() . " last id INSERTED.";
// /                       $brnd = $conn->lastInsertId(); echo "<br/>$brnd : " . $brnd;
//                } catch (Exception $e) {
//                    // Here you can either echo the exception message like:
//                    echo "<br/>some kind of failure here...";
//                        echo $e->getMessage();
//                    /* Or you can throw the Exception Object $e like:
//                        throw $e;
//                    */
//                }
//        }
} else {
  echo "<h1>transdet delete post</h1>";
  $dlt="delete from transdet where tran_id=" . $_GET['tid'];
  echo "<br/>dlt " . $dlt;
  // Prepare statement
  $stmt = $conn->prepare($dlt);
  // execute the query
  $stmt->execute();
  // echo a message to say the INSERT succeeded
  echo "<br/>" . $stmt->rowCount() . " record(s) DELETED successfully<br/><a href=\"list.php\">list</a>";
} 
} 
?>
