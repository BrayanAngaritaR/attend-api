<?php

class students {

   private $server;
   private $user;
   private $password;
   private $database;
   private $port;
   private $connection;

   function __construct() {
      $dataList = $this->connection_data();
      foreach ($dataList as $key => $value ){
         $this->server = $value['server'];
         $this->user = $value['user'];
         $this->password = $value['password'];
         $this->database = $value['database'];
         $this->port = $value['port'];
      }

      $this->connection = new mysqli($this->server, $this->user, $this->password, $this->database, $this->port);

      if($this->connection->connect_errno){
         echo "Can not ready for database connection";
         die();
      }
   }

   private function connection_data() {
      $url = dirname(__FILE__);
      $jsonData = file_get_contents($url . "/" . "config");
      return json_decode($jsonData, true);
   }
     
}

echo "Hi, this is a list of users in TSUGI";

?>