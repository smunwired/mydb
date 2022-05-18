delimiter //
Create Function
f_odo (p_rdate date,p_dst float) RETURNS decimal(9,2)
begin   
  declare v_odo decimal(9,2) default 0;   
  select coalesce(sum(dst),0) into v_odo 
  from bike 
  where dst is not null 
  and rdate < p_rdate
  or (rdate=p_rdate and dst < p_dst);   
  return v_odo; 
end;
//
delimiter ;
