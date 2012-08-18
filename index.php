<?php

include("./phpmd.php");

$string = $_POST['textarea'];

echo markdown($string);

echo '<hr><form action="" method="post"><p><textarea id="textarea" name="textarea">'.$string.'</textarea><input type="submit" value="Next"></p></form>';

?>