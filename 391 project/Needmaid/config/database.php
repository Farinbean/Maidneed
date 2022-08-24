<?php
  define('DB_HOST', 'localhost');
  define('DB_USER', 'uwu');
  define('DB_PASS', '1234');
  define('DB_NAME', 'maidneed');


  //Create connection
  $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

  //Check connection
  if($conn->connect_error){
    die('Connection Failed' .$conn->connect_error);
  }

//   echo 'CONNECTED!';