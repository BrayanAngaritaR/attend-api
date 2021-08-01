<?php
require_once "../config.php";
require_once "class/base/connection.php";

$connection = new connection;

//$query = "SELECT * from lti_user";
//$query = "INSERT into attend_api (link_id, user_id, attend, ipaddr, updated_at) VALUES (1, 3, '2021-07-30', '186.86.32.186', '2021-07-30 21:26:02')";
//print_r($connection->nonQuery($query));
$query = "SELECT * FROM attend";

print_r($connection->getData($query));
echo "This is a getUsers.php file";


?>