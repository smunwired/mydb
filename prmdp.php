<?php
include 'connect.php';
include 'leftmenu.php'; ?>
<h1>Paragraph Modify Post</h1>

<?php

$slashed=addslashes($_POST['txt']);
$updt = "update paragr set dt='" . $_POST['dt'] . "',txt='" . $slashed . "<br/>' where id=" . $_POST['id'];

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
/*
include 'includes/bk_links.php';
*/
?>
<br><a href=day.php>day</a>
