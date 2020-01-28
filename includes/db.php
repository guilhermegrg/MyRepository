<?php

$path = $_SERVER['DOCUMENT_ROOT'];
require $path . '/cms/vendor/autoload.php';

 if(defined('DB_CONSTANTS')){
     
 }else{
     
     define('DB_CONSTANTS',"exists");
     



$dotenv = Dotenv\Dotenv::createImmutable($path . "/cms/");
$dotenv->load();
     
$db['db_host'] = getenv("DB_HOST");
$db['db_user'] =  getenv("DB_USER");
$db['db_pass'] = getenv("DB_PASS");
$db['db_database'] =  getenv("DB_DATABASE");

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