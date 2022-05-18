<?php include '../trxnmenu.php'; ?>
<h1>look!</h1>
<?php
$dir          = '../images';
$file_display = array(
    'jpg',
    'jpeg',
    'png',
    'gif'
);

if (file_exists($dir) == false) {
    echo 'Directory \'', $dir, '\' not found!';
} else {
    $dir_contents = scandir($dir);

    foreach ($dir_contents as $file) {
        $file_type = strtolower(end(explode('.', $file)));

        if ($file !== '.' && $file !== '..' && in_array($file_type, $file_display) == true) {
        	echo $dir . $file;
            echo '<img src="', $dir, '/', $file, '" alt="', $file, '" />';
        }
    }
}

?>

<img width="100" height="100" title="impuros fanáticos"src="https://img.discogs.com/viJddu1xUXDgWNzMMesEeaGK9kw=/fit-in/300x300/filters:strip_icc():format(jpeg):mode_rgb():quality(40)/discogs-images/R-8378901-1460458272-3101.jpeg.jpg"/>
<h1>copied</h1>
<img width="100" height="100" title="hail him"src="images/burningspearhailhim.jpg"/>