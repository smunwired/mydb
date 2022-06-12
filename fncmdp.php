<?php
include 'connect.php';
include 'leftmenu.php'; ?>
<h1>Fence Modify Post</h1>

<?php

$slashed=addslashes($_POST['txt']);
if (isset($_POST['lesson'])){ $lsn=1; } else { $lsn=0; }
$updt = "update fence set dt='" . $_POST['dt'] . "',venue='" . $_POST['venue'] . "',lesson=" . $lsn . ",txt='" . $slashed . "' where id=" . $_POST['id'];
echo $updt;
  echo "<p>" . $updt;
        try {
                        $stmt = $conn->prepare($updt);
                        $stmt->execute();
                        echo " <p>rows updated ";
        } catch (Exception $e) {
                    echo "<br/>some kind of failure here...";
                    echo $e->getMessage();
                      throw $e;
        }
?>
<br><a href=day.php>day</a>
