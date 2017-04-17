<?php
$servername = "aac04bee6kk2cw.cvwrkeif9dtm.ap-south-1.rds.amazonaws.com";
$username = "fladmin";
$password = "Welcome!23";
$dbname = "ebdb";
/*
$servername = "localhost";
$username = "foot_footnew";
$password = "Welcome!23";
$dbname = "footlounge_120116";*/

$con = @mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$con)
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
echo "sdfdsf"; die; 
?>  