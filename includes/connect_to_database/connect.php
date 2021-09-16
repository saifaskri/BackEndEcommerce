<?php 
//  connect_to_database function
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname=("halava");
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname;", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      if( basename($_SERVER['PHP_SELF'])=="databaseFunction.php"){
        echo "Connected successfully";
      }
    } catch(PDOException $e) {
    if( basename($_SERVER['PHP_SELF'])=="databaseFunction.php"){
     echo "Connection failed: " . $e->getMessage();
    }
      
    }
?>