<?php

require_once 'class/base/auth.class.php';
require_once 'class/base/responses.class.php';

// $_auth = new auth;
$_responses = new responses;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $postBody = file_get_contents("php://input");
    print_r($postBody);
} else {
    echo "Method not allowed";
}

?>