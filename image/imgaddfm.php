<?php include '../leftmenu.php'; ?>
<?php echo "get id" . $_GET['title']; ?>
<h1>add image url here</h1>

<?php include '../connect.php'; ?>

<form method="post" action="imgaddpt.php">
<table>
  <tr>
    <td>link to title</td>
    <td><select name="title">
    <?php
    $sql2="select id,title,concat(replace(title,' ',''),'.jpg') as url from title order by title";
    foreach($conn->query($sql2) as $row2) { 
      if ($row2['id']==$_GET['title']) {
        echo "<option selected value=" . $row2['id'] . ">" . $row2['title'];
        $alt = $row2['title'];
        $url = $row2['url'];
      } else {
        echo "<option value=" . $row2['id'] . ">" . $row2['title'];
      }
    }
    ?>
    </select></td>
  </tr>
<!--<tr><td>heading</td><td><input type="text" name="hd"></input></td></tr>-->
<tr><td>heading</td><td><select name="hdng"><option value="">
<?php
	$sql3 = "select id,nm from heading order by nm";
	foreach($conn->query($sql3) as $row3) {
	  echo "<option value=" . $row3['id'] . ">" . $row3['nm'];
	}
?>
</select></td><tr>
<tr><td>image</td><td><select name="img"><option value="">
<?php
	$sql4 = "select * from image order by alt";
	foreach($conn->query($sql4) as $row4) {
	  echo "<option value=" . $row4['id'] . ">" . $row4['alt'];
	}
?>
</select></td><tr>
<!-- <tr><td>url</td><td><input type="text" name="url"></input></td></tr> -->
<tr><td>url</td><td><input type="text" name="url" value="<?php echo $url; ?>"></input></td></tr>
<tr><td>alt</td><td><input type="text" name="alt" value="<?php echo $alt; ?>"></input></td></tr>
<!-- <tr><td>display sequence</td><td><input type="text" name="dseq"></input></td></tr> -->
<tr><td colspan="2" align="center"><input type="submit"></td></tr></table>
</form>
<?php include '../sitemap.php'; ?>
