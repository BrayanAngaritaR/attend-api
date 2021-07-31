<?php

class connection {

   private $server;
   private $user;
   private $password;
   private $database;
   private $port;
   private $db_connection;

   function __construct() {
      $dataList = $this->connection_data();
      foreach ($dataList as $key => $value ){
         $this->server = $value['server'];
         $this->user = $value['user'];
         $this->password = $value['password'];
         $this->database = $value['database'];
         $this->port = $value['port'];
      }

      //$this->db_connection = new mysqli($this->server, $this->user, $this->password, $this->database, $this->port);
      $this->db_connection = new mysqli("localhost", "brayanangarita", "passAngarita05112021!webdb", "tsugi", "3306");

      if($this->db_connection->connect_errno){
         echo "We are not ready for database connection";
         die();
      } else {
         echo "Database connection has been established";
      }
   }

   private function connection_data() {
      $url = dirname(__FILE__);
      $jsonData = file_get_contents($url . "/../../" . "config");
      return json_decode($jsonData, true);
   }
     
}

echo "Hi, this is a list of users in TSUGI";

?>