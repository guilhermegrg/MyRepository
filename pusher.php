<?php

//error_reporting(E_ALL);

//require "/vendor/autoload.php";
$path = $_SERVER['DOCUMENT_ROOT'];
require $path.'/cms/vendor/autoload.php';


$dotenv = Dotenv\Dotenv::createImmutable($path.'/cms/');
$dotenv->load();

//class MyLogger {
//  public function log( $msg ) {
//    print_r( $msg . "<br />" );
//  }
//}

function sendPusherEvent($channel,$event,$message){
    
  $options = array(
    'cluster' => 'eu',
    'useTLS' => true
  );
  $pusher = new Pusher\Pusher(
    getenv('PUSHER_KEY'),
    getenv('PUSHER_SECRET'),
    getenv('PUSHER_ID'),
    $options
  );

//    $logger = new MyLogger();
//    $pusher->set_logger( $logger );
    
    
    
//  $data['name'] = "Sender";
  $data['message'] = $message;
  $result = $pusher->trigger("admin_notifications", "new_user", $data);

//    $logger->log( "---- My Result ---" );
//    $logger->log( $result );
    
}
?>