<?php

require_once("./functions.php");
session_start();
require('login.function.php');
$refresh = html_start("greylist",0,false,false);
?>
<iframe src="../sgwi/index.php" width="960px" height="1024px">
 <a href="..\sgwi/index.php">Click here for SQLGrey Web Interface</a>
</iframe>
<?php
html_end();
dbclose();
