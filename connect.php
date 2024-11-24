<?php
$host = 'localhost';
$dbname = 'hotel_db';
$dbusername = 'root';
$dbpassword = '';
date_default_timezone_set("Asia/Calcutta");
$time = date('d-m-Y H:i:s');
$today = date('Y-m-d');

try {
    
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    #echo "Connection proceed";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
   function create_unique_id(){
      $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
      $rand = array();
      $length = strlen($str) - 1;

      for($i = 0; $i < 20; $i++){
         $n = mt_rand(0, $length);
         $rand[] = $str[$n];
      }
      return implode($rand);
   }
?>