<?php


 if(defined('DB_CONSTANTS')){
     
 }else{
     
     define('DB_CONSTANTS',"exists");
     
$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] ="";
$db['db_database'] = "cms";

foreach($db as $key => $value){
//    echo "key: $key Value: $value<br>";
    define(strtoupper($key),$value);
}


$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_DATABASE);

if(!$conn){
    die("Error connecting to databased " . mysqli_error($conn));
}
//     else
//    echo "we are connected!";




function query($query){
    global $conn;
    $rows = mysqli_query($conn,$query);
    if($rows){
        return $rows;
    }else{
        die("Error on query! " . mysqli_error($conn));
    }
  }
     
}

?>