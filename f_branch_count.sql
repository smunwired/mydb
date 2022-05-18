delimiter //
create Function
f_branch_count
(c int) RETURNS int(11)
begin
  declare v_bcnt int;
  select count(distinct brnd) into v_bcnt from transdet where crdd=c and brnd != 'NULL';
  return v_bcnt;
end
//
delimiter ;
