<?php
function getSel($grp,$opt1,$opt2,$opt3){
		if ($grp==$opt1) {
			$chk1 = " checked";
			$chk2 = "";
			$chk3 = "";
		} else if ($grp==$opt2){
			$chk1 = "";
			$chk2 = " checked";
			$chk3 = "";
		} else {
			$chk1 = "";
			$chk2 = "";
			$chk3 = " checked";
		}
		echo 
			$opt1	. '
			<input type="radio" onchange="this.form.submit();" name="grp" value="' . $opt1 . '"' . $chk1 . '></input>
			'. $opt2 .' 	
			<input type="radio" onchange="this.form.submit();" name="grp" value="' . $opt2 . '"' . $chk2 . '></input>
			'. $opt3 .'	
			<input type="radio" onchange="this.form.submit();" name="grp" value="' . $opt3 . '"' . $chk3 . '></input>
		';
}
?>
