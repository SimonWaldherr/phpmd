<html>
<head>
  <meta charset="utf-8">
  <title></title>
  
  <link href="style.css" rel="stylesheet" type="text/css">
  
</head>
<body>
  
<?php

include("./phpmd.php");

$string = $_POST['textarea'];

echo '<div id="html">'.markdown($string).'</div>';

echo '<hr><div id="md"><form action="" method="post"><p><textarea id="textarea" name="textarea">'.$string.'</textarea><input type="submit" value="Next"></p></form></div>';

?>
  
</body>
</html>