<?php include 'leftmenu.php'; ?>
<h1>Add Title Medium Form</h1>

<?php
include '../leftmenu.php';
include '../connect.php';
  echo "<form name=\"ttlmdafm\" action=\"ttmaddpt.php\" method=\"post\"><input type=\"hidden\" name=\"artist\" value=\"" . $_GET['artist'] . "\"></input>
    <table>
      <tr>
        <td>title</td>";
        $sql = "select * from title";
        echo "<td><select name=\"title\">";
        if (empty($_GET['id'])) {
          echo "<option value=\"\">";
        }
        foreach($conn->query($sql) as $row) {
          if ($row['id']==$_GET['id']) {
          //if (1==2) {
          echo "<option value=" . $row['id'] . " selected>" . $row['title'];
        } else {
          echo "<option value=" . $row['id'] . ">" . $row['title'];
          }
        }
	    echo "</select></td></tr>

      <tr><td>medium</td><td>";
	    $sql = "select * from medium";
        echo "<select name=\"medium\">";
        echo "<option value=\"\">";
	    foreach($conn->query($sql) as $row) {
		  echo "<option value=" . $row['id'] .
		  ">" . $row['medium'];
	    }
	    echo "</select></td></tr>
      <tr><td>release year</td><td><input name=\"released\"></input></td></tr>
      <tr><td>label</td><td><input name=\"label\"></input></td></tr>
      <tr><td align=\"center\"colspan=\"2\"><input type=\"submit\"></input></td></tr>
    </table>
  </form>";
?>
