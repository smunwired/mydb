<?php
function getord($ord){
		if ($ord=="asc") {
			$chk1 = " checked";
			$chk2 = "";
		} else {
			$chk1 = "";
			$chk2 = " checked";
		}
		echo "
			asc
			<input type=\"radio\" onchange=\"this.form.submit();\" name=\"dyord\" value=\"asc\"" . $chk1 .  "></input>
			desc
			<input type=\"radio\" onchange=\"this.form.submit();\" name=\"dyord\" value=\"desc\"" . $chk2 . "></input>
		";
}
?>
