<?php
  $orddr = " ";
  $whr = " and 1=1 ";
  $ordcol = "coalesce(statement_date,tran_date)";
  $limit = 222;

  if ($grp=="ttyd") {
    $slct = "select tran_type.tran_type_id ttyd, tran_type.tran_type tty,sum(transdet.tran_amount*cr_dr) amt ";
    $grpby = " group by ttyd,tty order by ttyd ";
  } else if ($grp=="accd") {
    $slct = "select account.account_id ttyd, account.account_name tty,sum(transdet.tran_amount*cr_dr) amt ";
    $grpby = " group by ttyd,tty order by ttyd ";
  } else {
    $slct = "select  tran_id tid,tran_date trd, crdd,	brnd,
        		concat_ws(', ',c1.nm,c2.nm) crd,
        		tran_type.tran_type_id ttyd,
        		tran_type.tran_type tty,
        		account.account_name acc,
        		account.account_id accd,
        		transdet.tran_desc dsc,
        		transdet.tran_amount*transdet.cr_dr amt,
        		receipt_ind rcpt, dd_ind dd,
        		date_format(statement_date,'%Y-%m-%d') std,
        		date_format(date_created,'%Y-%m-%d') dtc,
        		if(date_format(date_amended,'%Y')='0000','n/a',date_format(date_amended,'%Y-%m-%d')) as dta ";
    $grpby = " order by tran_date ";
  }
  $sql = $slct . "
		from transdet
		left join frequency on transdet.frequency = frequency.freq_id
		left join cost_center on transdet.cost_code = cost_center.cost_code
		left join crdn c1 on transdet.crdd=c1.crdd
		left join brnn c2 on brnd=c2.id
		join account on transdet.account_id=account.account_id
		join tran_type on transdet.tran_type_id=tran_type.tran_type_id
		where " . $ordcol . " is not null " . $whr . "
		and date_format(coalesce(statement_date,tran_date),'%M %Y')='" . date("F Y", strtotime("+" . $_GET['chng'] . " months")) . "' " . $grpby . $orddr .
		" limit " . $limit;
  $sql = $slct . "
		from transdet
		left join frequency on transdet.frequency = frequency.freq_id
		left join cost_center on transdet.cost_code = cost_center.cost_code
		left join names c1 on transdet.crdd=c1.id and c1.typ=1
		left join names c2 on brnd=c2.id and c2.typ=2
		join account on transdet.account_id=account.account_id
		join tran_type on transdet.tran_type_id=tran_type.tran_type_id
		where " . $ordcol . " is not null " . $whr . "
		and date_format(coalesce(statement_date,tran_date),'%M %Y')='" . date("F Y", strtotime("+" . $_GET['chng'] . " months")) . "' " . $grpby . $orddr .
		" limit " . $limit;
	#echo $grp;
	#echo $sql;
?>

