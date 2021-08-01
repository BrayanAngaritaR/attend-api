<?php
require_once 'connection.php';
require_once 'responses.php';

class auth extends connection{
    
    public function login($json){
        $_responses = new responses;
        $data = json_decode($json, true);

        if(!isset($data["email"]) || !isset($data["user_key"])){
            //Data not sended
            return $_responses->error_400();
        } else {
            //Data is ok
            $email = $data['email'];
            $user_key = $data['user_key'];
            $daa = $this->getUserData($email);

            if($data){
                //Create JWT token
                if($user_key == $data[0]['user_key']){

                } else {
                    return $_responses->error_200("Incorrect key");
                }
            } else {
                return $_responses->error_400();
            }
        }
    }

    private function getUserData($email){
        $query = "SELECT displayname, user_id, user_key FROM lti_user = WHERE email = '$email'";
        $data = parent::getData($query);

        if(isset($data[0]['user_id'])){
            return $data;
        } else {
            return 0;
        }
    }
}

?>