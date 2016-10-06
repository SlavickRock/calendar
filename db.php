<?php

	$mysqli = new mysqli("localhost","root","41051989","calendar");
     mysqli_set_charset($mysqli,'utf8');
 if(!$mysqli)
 {
    echo mysqli_error();
 }
 ?>
