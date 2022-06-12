<?php include 'leftmenu.php'; 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php include 'getord.php'; ?>
<?php 
session_start();
echo "SESSIONS VARIABLES - limit : " . $_SESSION["dylmt"] . " date from : " . $_SESSION["dtf"] . " date to : " . $_SESSION["dtt"] . ", order : " . $_SESSION["dyord"] . "<br/>"; 
// // // CONTROLS // // //
// // // CONTROLS // // //
// // // CONTROLS // // //
if (empty($_GET['dyord'])) { 
	if (empty($_SESSION["dyord"])) { 
		$dyord="asc"; 
		$_SESSION["dyord"]="asc";
	} else { 
		$dyord = $_SESSION["dyord"];
	}
} else {
	$dyord = $_GET['dyord']; 
	$_SESSION["dyord"]=$_GET['dyord'];
} 
?>
<form method="GET">
<div size=80%; style="margin: 20 20 20 20;font-size : 100%;" align="right"><b>options : </b> 
<!-- <table><tr><td class="subheading"> -->
<?php           
if (empty($_GET['dylmt'])) { 
	if (empty($_SESSION["dylmt"])) { 
		$dylmt=22; 
		$_SESSION["dylmt"]=$_GET['dylmt'];
	} else {
		$dylmt=$_SESSION["dylmt"];
	}
} else { 
	$dylmt=$_GET['dylmt']; 
	$_SESSION["dylmt"]=$_GET['dylmt'];
}
?>
dylmt<input onChange='this.form.submit();' name="dylmt" value=" <?php echo $dylmt;?> " />
<?php
if (empty($_GET['dtf'])) { 
	if (empty($_SESSION["dtf"])) { 
		$dtf='2015-01-01'; 
		$_SESSION["dtf"]='2015-01-01';
	} else {
		$dtf=$_SESSION["dtf"];
	}
} else { 
	$dtf=$_GET['dtf']; 
	$_SESSION["dtf"]='2015-01-01';
}
?>
date from <input onChange='this.form.submit();' name="dtf" value=" <?php echo trim($dtf);?> " />
<?php
if (empty($_GET['dtt'])) { 
	if (empty($_SESSION["dtt"])) { 
		$dtt=date('Y-m-d'); 
		$_SESSION["dtt"]=$dtt;
	} else {
		$dtt=$_SESSION["dtt"];
		$_SESSION["dtt"]=$dtt;
	}
} else { 
	$dtt=$_GET['dtt']; 
}
?>
date to <input onChange='this.form.submit();' name="dtt" value=" <?php echo trim($dtt);?> " />
        <?php           
		getord($dyord);           
	?>
</div>
<!-- <input type="hidden" name="ord" value="<?php echo $ord; ?>"></input> -->
<!-- </td></tr></table> -->
<h1>daily summary</h1>
<?php
include 'connect.php';
$sql="select dt, yr, mn, dy, str,rdr from (
         select rdate dt,date_format(rdate,'%Y') yr,date_format(rdate,'%M') mn,date_format(rdate,'%W %d') dy,'bike' str, 10 rdr from bike
         union
         select dt dt,date_format(dt,'%Y') yr,date_format(dt,'%M') mn,date_format(dt,'%W %d') dy,'fence' str, 20 rdr from fence
         union
         select booked dt,date_format(booked,'%Y') yr,date_format(booked,'%M') mn,date_format(booked,'%W %d') dy,'booking' str, 30 rdr from bk_booking
	 union
	 select stage_date dt, date_format(stage_date,'%Y') yr, date_format(stage_date,'%M') mn, date_format(stage_date,'%W %d') dy, 'flight', 40 rdr from stage where stage_date != '0000-00-00'
         union
         select rdate dt,date_format(rdate,'%Y') yr,date_format(rdate,'%M') mn,date_format(rdate,'%W %d') dy, 'stay',  50 rdr from (
		select outdt rdate,type from bk_booking union select indt rdate,type from bk_booking) as flights where rdate!='0000-00-00' and type=2
         union
         select rdate dt,date_format(rdate,'%Y') yr,date_format(rdate,'%M') mn,date_format(rdate,'%W %d') dy, 'perf',  60 rdr from (
		select outdt rdate,type from bk_booking union select indt rdate,type from bk_booking) as flights where rdate!='0000-00-00' and type=5
         union
         select listen_date dt,date_format(listen_date,'%Y') yr, date_format(listen_date,'%M') mn,date_format(listen_date,'%W %d') dy,'title' str, 100 rdr from title_listen
         union
         select date_format(dt,'%Y-%m-%d') dt, date_format(dt,'%Y') yr,date_format(dt,'%M') mn,date_format(dt,'%W %d') dy,'para' str, 5 rdr from paragr
         union
         select date_format(dt,'%Y-%m-%d') dt, date_format(dt,'%Y') yr,date_format(dt,'%M') mn,date_format(dt,'%W %d') dy,'standby' str, 1 rdr from standby
)
as combined 
where (dt between '"  .  trim($dtf)  ."' and '"  .  trim($dtt)  .  "') 
group by dt,yr,mn,dy,str,rdr 
order by dt " . $dyord . ",rdr 
limit " . $dylmt;

//echo $sql;

$lasthead="zzz";
$firsthead="true";
$crmn="nomonthyet";
$cryr="noyearyet";
foreach($conn->query($sql) as $row) {
  if ($row['yr']!=$cryr) {
    echo "<h1>" . $row['yr'] . "</h1>";
  }
  if ($row['mn']!=$crmn) {
    echo "<h2>" . $row['mn'] . "</h2>";
  }
  $crmn=$row['mn'];
  $cryr=$row['yr'];
  if ($row['dt']!=$lasthead) {
    if ($firsthead=="true") {
      $firsthead="false";
/*      echo '<div id="wrapper"><h4>' . $row['dt'] . '</h4>';	*/
      echo '<div><h4>' . $row['dy'] . '</h4>';
    } else {
/*      echo '</div><div id="wrapper"><h4>' . $row['dt'] . '</h4>';	*/
      echo '</div><div><h4>' . $row['dy'] . '</h4>';
    }
  }
  $lasthead=$row['dt'];
  if ($row['str']!='title') {
    /*echo '<div id="first">' . $row['str'] . ':' . $row['content'] . '(' . $row['rdr'] . ')</div>';*/
	/* OOH */
/* if stby=1 and hrs=0, no calls... */
    if ($row['str']=='standby') {
      $ql='select stby,hrs,txt,rt from standby where dt = \'' . $row['dt'] . '\'';
      foreach($conn->query($ql) as $rw) {
        if ($rw['stby']==1) {
          if ($rw['hrs']==0) { 
            echo '<div><i>standby: no calls.</i></div>';
          } else {
            echo '<div><i>standby: +' . $rw['hrs'] . 'hrs, ' . $rw['txt'] . ', rate: ' . $rw['rt'] . '</i></div>';
          }
        } else {
          echo '<div><i>overtime: ' . $rw['hrs'] . 'hrs, ' . $rw['txt'] . ', rate : ' . $rw['rt'] . '</i></div>';
        }
      }
	/* BIKE */
    } else if ($row['str']=='bike') {
      $ql="select concat('tm:',tm,',dst:',dst,',av:',av,',mx:',mx,',odo:',round(odo),',notes:',notes,'\n') content from bike where rdate='" . $row['dt'] . "'";
      foreach($conn->query($ql) as $rw) {
        echo $rw['content'];
      }
	/* FENCE */
    } else if ($row['str']=='fence') {
	$sub = 'select id,f_fencing_days(\'' . $row['dt'] . '\') as club from fence where dt=\'2022-06-09\' limit 1';
      foreach($conn->query($sub) as $sb) {
        echo '<div>' . $sb['club'] . '<a href="fncmdf.php?id=' . $sb['id'] . '">mod</a> <a href="fncdlp.php?id=' . $sb['id'] . '">del</a></div>';
      }
	/* BOOKING */
    } else if ($row['str']=='booking') {
      echo "<div>";
      $ql = 'select b.id id,c.nm carrier,ref booking,booked,b.outbound foid,f6(f1.id) outbound,outdt,f6(f2.id) inbound,indt,cost,notes,outst,inst
                from bk_booking b
                left outer join bk_flight f1 on f1.id=b.outbound
                left outer join bk_flight f2 on f2.id=b.inbound
                left outer join bk_carrier c on c.id=b.carrier where booked = \'' . $row['dt'] . '\'';
      foreach($conn->query($ql) as $rw) {
                echo "<tr>
                        <td><i>booking:" . $rw['carrier'] . "</td><td> " .  $rw['booking'] . "</td></td>
                        <td>" . $rw['outdt'] . " " . $rw['outbound'] .  " " . $rw['outst'] . " seat(s)</td>
                        <td>" . $rw['indt'] . " " . $rw['inbound'] . " " . $rw['inst'] . " seat(s)</td>
                        <td>" .  $rw['cost'] . "</td>
                        <td>" .  $rw['notes'] . "</i></td></tr>";
      }
      echo "</div>";	
	/* FLIGHT */	
    } else if ($row['str']=='flight') {
      echo "<div>";
      $sub='select fl,st from (
	select outdt dt,f6_flight(outbound) fl ,outst st from bk_booking union select indt dt,f6_flight(inbound) fl,inst st 
	from bk_booking) as bk 
	where dt=\'' . $row['dt'] . '\'';
/**/
      $sub='select seats st,concat(f.nm,\' : \', d1.cd,\' -> \',d2.cd,\' ( \',dptm,\' -> \',artm,\')(\',seats,\')\')  as flight
	from stage s 
	join bk_flight f on f.id=flight 
	join bk_destination d1 on d1.id=f.dpdst 
	join bk_destination d2 on d2.id=f.ardst 
	where stage_date = \'' . $row['dt'] . '\'';
/**/
        foreach($conn->query($sub) as $sb) {
	/*
          if ($sb['st']>0) {
            echo '<div style="text-align:center;border:1px solid red\">' . $sb['flght'] . '(' . $sb['st'] . ')' . '</div>'; 
          } else {
            echo '<div style="text-align:center;border:1px solid red\"><s>' . $sb['fl'] . '(' . $sb['st'] . ')' . '</s></div>'; 
          }
	*/
          if ($sb['st']>0) {
		echo '<div style="text-align:center;border:1px solid red\">' . $sb['flight'] . ')' . '</div>';
          } else {
		echo '<div style="text-align:center;border:1px solid red\"><s>' . $sb['flight'] . ')' . '</s></div>';
          }
        }
	echo "</div>";
	/* STAY */	
    } else if ($row['str']=='stay') {
      echo "<div>";
      $sub='select fl,st from (
	select outdt dt,f6_flight(outbound) fl ,outst st from bk_booking union select indt dt,f6_flight(inbound) fl,inst st 
	from bk_booking) as bk 
	where dt=\'' . $row['dt'] . '\'';
        foreach($conn->query($sub) as $sb) {
          /*
          if ($sb['st']>0) {
            echo '<div style="text-align:center;border:1px solid red\">' . $sb['fl'] . '(' . $sb['st'] . ')' . '</div>'; 
          } else {
            echo '<div style="text-align:center;border:1px solid red\"><s>' . $sb['fl'] . '(' . $sb['st'] . ')' . '</s></div>'; 
          }
	  */
	  echo "<div>stay</div>";
        }
	echo "</div>";
	/* PERFORMANCE */	
    } else if ($row['str']=='perf') {
      echo "<div>";
      $sub='select fl,st from (
	select outdt dt,f6_flight(outbound) fl ,outst st from bk_booking union select indt dt,f6_flight(inbound) fl,inst st 
	from bk_booking) as bk 
	where dt=\'' . $row['dt'] . '\'';
	$sub = 'select notes from bk_booking where type=5 and outdt=\'' . $row['dt'] . '\'';
        foreach($conn->query($sub) as $sb) {
          /*
          if ($sb['st']>0) {
            echo '<div style="text-align:center;border:1px solid red\">' . $sb['fl'] . '(' . $sb['st'] . ')' . '</div>'; 
          } else {
            echo '<div style="text-align:center;border:1px solid red\"><s>' . $sb['fl'] . '(' . $sb['st'] . ')' . '</s></div>'; 
          }
	  */
	  echo "<div><i>wild times</i> " . $sb['notes'] . " !!!</div>";
        }
	echo "</div>";
      } else if ($row['str']=='para') {
/*        echo "<div id=\"firsti\">";		*/
        echo "<div>";
        $sub='select id,txt from paragr where date_format(rdt,\'%Y-%m-%d\')=\'' . $row['dt'] . '\'';
        $sub='select id,txt from paragr where date_format(dt,\'%Y-%m-%d\')=\'' . $row['dt'] . '\'';
        foreach($conn->query($sub) as $sb) {
          echo '<div>' . $sb['txt'] . '<a href=prmdf.php?id=' . $sb['id'] . '>mod</a> <a href=prdlp.php?id=' . $sb['id'] . '>del</a></div>';
        }
        echo "</div>";
    } else {
      echo '<div id="first">' . $row['str'] . 'this should not happen</div>'; /*THIS SHOULD NOT HAPPEN */
    }
  } else {
/*    echo '<div id="second">';		*/
    $sub='select concat(
			fnfullname(artist,1),
			":",
			concat(prefix,case length(prefix) when 0 then \'\' else \' \' end,t.title)
		) ttl , if(url like \'http%\',url,concat("images/",url)) as url,
			i.id id
		from title t 
		join title_listen tl on tl.title=t.id 
		join image_title it on it.title=t.id
		join image i on i.id=it.image
		where listen_date=\'' . $row['dt'] . '\'';
    echo "<div>";
    foreach($conn->query($sub) as $sb) {
      echo "<a href=image/imgmodfm.php?image=" . $sb['id'] . "><img width=25 height=25 title=\"" .  $sb['ttl'] .  "\" src=\"" . $sb['url'] . "\"></a>";
    }
    echo "</div>";
  }
}
include 'sitemap.php'
?>
</form>
