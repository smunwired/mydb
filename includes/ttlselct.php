<?php
        $sql = "select * from title";
        echo "<select name=\"title\">";
        if (empty($_GET['id'])) {
          echo "<option value=\"\">";
        }
        foreach($conn->query($sql) as $row) {
        	echo "<option value=\"1\">";
          if ($row['id']==$_GET['id']) {
          //if (1==2) {
          echo "<option value=" . $row['id'] . " selected>" . $row['title'];
        } else {
          echo "<option value=" . $row['id'] . ">" . $row['title'];
          }
        }
	    echo "</select>";
?>
