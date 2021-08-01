<?php

require_once 'class/base/auth.class.php';
require_once 'class/base/responses.class.php';

// $_auth = new auth;
$_responses = new responses;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $postBody = file_get_contents("php://input");
    $dataArray = $_auth->login($postBody);
    print_r(json_decode($dataArray));
    
} else {

    $user = $data['user'];
    $password = $data['password'];
    echo "Method not allowed";
}

?>