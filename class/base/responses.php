<?php

class responses {

   private $response = [
      'status' => 'ok',
      "result" => array()
   ];

   public function error_405(){
      $this->response['status'] = "error";
      $this->response['result'] = array(
         'error_id' => "405",
         'error_message' => 'Method not allowed'
      );
      return $response;
   }

   public function error_200($string = 'Incorrect data'){
      $this->response['status'] = "error";
      $this->response['result'] = array(
         'error_id' => "200",
         'error_message' => $string
      );
      return $response;
   }

   public function error_400(){
      $this->response['status'] = "error";
      $this->response['result'] = array(
         'error_id' => "400",
         'error_message' => "Route not found"
      );
      return $response;
   }
}

?>