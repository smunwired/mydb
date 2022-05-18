<!-- <html> <head> <title>creditors</title> <style> h1, h2, p { text-align: center; color: red; } table.center { margin-left:auto; margin-right:auto; } </style> </head> <body> -->
<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'leftmenu.php'; ?>
<?php include 'connect.php'; ?>
<?php if ((empty($_GET['yrs']))) { $yrs="1000"; } else { $yrs = $_GET['yrs']; } ?>
<form method="GET">
<div style="margin: 20 20 20 20;" align="right"><b>yrs : </b>
	<?php
			echo "<input name=\"yrs\" value=\"" . $yrs . "\" onchange=\"this.form.submit();\" >";
	?>
</div>


<h1>assigned creditors</h1>
<div>
<table width="100%">
  <tr>
    <th>id
    <th width="50%" align="left" >creditor
    <th align="center">branches
    <th align="center\">trans
    <td colspan="2"><a href="crdaddfm.php"></td>
  </tr>
  <?php

  $sql="select c.crdd crdd,nm crd,f_branch_count(c.id) bcnt,count(*) count from crdn c join transdet t on t.crdd=c.crdd group by c.crdd,nm,f_branch_count(c.id) order by 2";
  $sql="select name.crdd crdd,nm crd,null as bcnt,count(*) count from name join transdet on transdet.crdd=name.crdd group by name.crdd,nm,bcnt";
  $sql="select names.id crdd,names.nm crd,null as bcnt,count(*) count from names join transdet on transdet.crdd=names.id where names.typ=1 group by names.id,names.nm,bcnt";
  //echo $sql;

  foreach($conn->query($sql) as $row) {
    echo "<tr valign=\"top\">
    <td align=\"center\">" . $row['crdd'] . "</td>
    <td align=\"left\"><a href=list.php?crdd=" . $row['crdd'] . ">" . $row['crd'] . "</a></td>";
    if ($row['bcnt']>0) {
/*
      if (isset($_GET['action'])) {
        if (($_GET['action']=="show")&&($_GET['crdd']==$row['crdd'])) {
          echo "<td align=\"center\"><a href=\"crd.php?action=hide&crdd=" . $row['crdd'] . "\">hide</a></td>";
	} else {
	  echo "<td align=\"center\"><a href=\"crd.php?action=show&crdd=" . $row['crdd'] . "\">show</a></td>";
	}
      }
*/
      echo "<td>" . $row['bcnt'] . "</td>";
    } else {
      echo "<td>&nbsp;</td>";
    }
//	} else { //		echo "<td><a href=\"crd.php?action=show&crdd=" . $row['crdd'] . "\">show</a></td>"; //} else {echo "<td>&nbsp;</td>"; //	} //	}
    echo "<td align=\"center\">" . $row['count'] . "</td>";
    echo "<td><a href=\"mod.php?actn=mdfm&tbl=crd&id=" . $row['crdd'] . "\">mod</a></td>
	<td><a href=\"crddelpt.php?crdd=" . $row['crdd'] . "\">del</a></td>";
  if (isset($_GET['action'])){
    if ($_GET['action']=="show") {
      if ($_GET['crdd']==$row['crdd']) {
        $bsql = "select id brnd,nm brn,count(*) rws from transdet join crdn on brnd=id where crdd=" . $row['crdd'] . " group by brnd,brn";
        echo "<tr>
		<td colspan=6 align=center><table width=\"80%\">";
	foreach($conn->query($bsql) as $brow) {
	    echo "<tr>
		<td>" . $brow['brnd'] . "</td>
		<td><a href=\"list.php?whr= and brnd=" . $brow['brnd'] . "\">" . $brow['brn'] . "</a></td>
		<td>" . $brow['rws'] . "</td>
		<td><a href=crd.php?action=mod&brnd=" . $brow['brnd'] . ">mod</a> <a href=crd.php?action=del&brnd=" . $brow['brnd'] . ">del</a></td>
		</tr>";
        }
	  echo "</table></td>
        </tr>";
      }
    }
  }
}
?>
</table>
</div>
</form>
</body>
</html>
