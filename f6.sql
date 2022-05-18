delimiter //
create function 
f6
(p_id int) RETURNS text CHARSET latin1
begin declare str text; select concat(f.nm,' : ',d1.cd,' -> ',d2.cd,' (',time_format(f.dptm,'%H:%i'),'->',time_format(f.artm,'%H:%i'),')') into str from bk_flight f join bk_destination d1 on d1.id=f.dpdst join bk_destination d2 on d2.id=f.ardst where f.id=p_id; return str; end
//
delimiter ;
