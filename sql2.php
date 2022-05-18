
			$sql2="select  tran_id tid,tran_date trd, tran_desc dsc, t.crdd crdd,	brnd,
			f_nm(crdd,brnd,tran_date) crd,  
        		tran_type.tran_type_id ttyd,
        		tran_type.tran_type tty,
        		account.account_id accd,
        		account.account_name acc,
        		t.tran_amount*t.cr_dr amt,
        		receipt_ind rcpt,
        		dd_ind dd,
        		date_format(statement_date,'%Y-%m-%d') std,
        		cheque_no chq,
        		date_format(date_created,'%Y-%m-%d') dtc,
        		if(date_format(date_amended,'%Y')='0000','n/a',date_format(date_amended,'%Y-%m-%d')) as dta,
			contactless
			from transdet t
			left join frequency
			on t.frequency = frequency.freq_id
			left join cost_center on t.cost_code = cost_center.cost_code
			join account on t.account_id=account.account_id
			join tran_type on t.tran_type_id=tran_type.tran_type_id
			where tran_id is not null
			and " . $cls . "=" . $show .
			" and date_format(coalesce(statement_date,tran_date),'%M %Y')='" . date("F Y", strtotime("+" . $_GET['chng'] . " months")) .
			"' order by coalesce(statement_date,tran_date)";
