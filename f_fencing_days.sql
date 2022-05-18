delimiter //
drop function f_fencing_days;
/*
Create Function
f_fencing_days
*/
/* |          | 
*/
CREATE DEFINER=`stef`@`localhost` FUNCTION `f_fencing_days`
/* */
(p_dt date) RETURNS varchar(255) CHARSET utf8
    DETERMINISTIC
begin
  declare done int default false;
  declare str varchar(255);
  declare trgt int;
  declare actl int;
  declare lssn int;
  declare v_str varchar(255);
  declare fence_cursor cursor for select venue,lesson from fence where dt = p_dt;
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
  
  open fence_cursor;
  get_fence: loop
  
  fetch fence_cursor into str,lssn;
  if done then
    leave get_fence;
  end if; 
  if str != 'haverstock' then
    set v_str = concat(ifnull(v_str,''),str);
  else 				
    select round(datediff('2018-06-03',p_dt)/7)*-1 into trgt;
    select count(*) into actl from fence where venue='haverstock' and dt between '2018-06-03' and p_dt;

    set v_str = concat(ifnull(v_str,''),str,' ',actl,'(',trgt,')');
					
    if lssn=1 then set v_str = concat(v_str, ' - lesson '); end if;
  end if;
   
  set v_str = concat(v_str,'<br/>');
  end loop get_fence;
  
  close fence_cursor;
  
  return v_str;
end;
//
delimiter ;
