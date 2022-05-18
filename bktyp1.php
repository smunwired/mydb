/*    if ($bktyp==1)
	//try to insert stages anyhow
      $sql="insert into stage(booking,direction,sequence,flight,stage_date,seats) 
          values (" . $lstid . ",0,1," . $_POST['outbound_flight_id_1'] . ",'" . $_POST['outbound_date'] . "'," . $_POST['outst'] . ")"; echo $sql;
      try {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        echo "<br/>might have worked, " . $stmt->rowCount() . " row(s) inserted";
      } catch(PDOException $e) {
        echo $sql . "<br/>" . $e->getMessage();
      }
echo "id_2" . $outbound_flight_id_2;
      if ($outbound_flight_id_2 > 0) {
        $sql="insert into stage(booking,direction,sequence,flight,stage_date,seats) 
          values (" . $lstid . ",0,1," . $_POST['outbound_flight_id_2'] . ",'" . $_POST['outbound_date'] . "'," . $_POST['outst'] . ")"; echo $sql;
        try {
          $stmt = $conn->prepare($sql);
          $stmt->execute();
          echo "<br/>might have worked, " . $stmt->rowCount() . " row(s) inserted";
        } catch(PDOException $e) {
          echo $sql . "<br/>" . $e->getMessage();
        }
      }  
      $sql="insert into stage(booking,direction,sequence,flight,stage_date,seats) 
          values (" . $lstid . ",1,1," . $_POST['inbound_flight_id'] . ",'" . $_POST['inbound_date'] . "'," . $_POST['inst'] . ")"; echo $sql;
      try {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        echo "<br/>might have worked, " . $stmt->rowCount() . " row(s) inserted";
      } catch(PDOException $e) {
        echo $sql . "<br/>" . $e->getMessage();
      }
    }
*/
