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

      $this->db_connection = new mysqli($this->server, $this->user, $this->password, $this->database, $this->port);
      
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

   private function convertToUTF8($array){
      array_walk_recursive($array, function(&$item, $key){
         if(!mb_detect_encoding($item, 'utf-8', true)){
            $item = utf8_encode($item);
         }
      });

      return $array;
   }

   //Get data from database
   public function getData($query){
      $results = $this->db_connection->query($query);
      $resultsArray = array();

      foreach($results as $key){
         $resultsArray[] = $key;
      }

      return $this->convertToUTF8($resultsArray);
   }

   //Save data into database
   public function nonQuery($query){
      $results = $this->db_connection->query($query);
      return $this->db_connection->affected_rows;
   }

   //Get the last id of the table
   public function nonQueryId($query){
      $results = $this->db_connection->query($query);
      $rows = $this->db_connection->affected_rows;
      
      if($row >= 1){
         return $this->db_connection->insert_id;
      } else {
         return 0;
      }
   }
     
}

echo "Hi, this is a list of users in TSUGI";

?>