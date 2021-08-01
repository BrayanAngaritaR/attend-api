<?php
require_once "../config.php";
require_once "class/base/connection.php";

// The Tsugi PHP API Documentation is available at:
// http://do1.dr-chuck.com/tsugi/phpdoc/namespaces/Tsugi.html

use \Tsugi\Util\U;
use \Tsugi\Core\Settings;
use \Tsugi\UI\SettingsForm;
use \Tsugi\Core\LTIX;
use \Tsugi\Util\Net;

// No parameter means we require CONTEXT, USER, and LINK
$LAUNCH = LTIX::requireData(); 

//Require connection class
$connection = new connection;

//$query = "SELECT * from lti_user";
//$query = "INSERT into attend_api (link_id, user_id, attend, ipaddr, updated_at) VALUES (1, 3, '2021-07-30', '186.86.32.186', '2021-07-30 21:26:02')";
//print_r($connection->nonQuery($query));
$query = "SELECT A.user_id,attend,A.ipaddr, displayname, email
            FROM attend AS A";

print_r($connection->getData($query));

// Model
$old_code = Settings::linkGet('code', '');

// Render view
$OUTPUT->header();
$OUTPUT->bodyStart();
$OUTPUT->topNav();

$php_session_code = U::addSession('student.php');
var_dump($php_session_code);

?>
<p> The old code is </p>
<p><?= __("Enter code:") ?></p>
<form method="post">
    <input type="text" name="code" id="code" value="">
    <input type="submit" class="btn btn-normal" id="attend" name="set" value="<?= __('Record attendance') ?>"><br/>
</form>
<div id="alert"></div>
<?php

$OUTPUT->footerStart();

?>
<script>
$(document).ready(function(){
    $("#attend").click(function(e) {
        e.preventDefault();
        $("#alert").html("");
        var code = $("#code").val();
        var url = '<?= U::addSession('api/attend.php') ?>';
        console.log("The URL is: " + url);
        $.ajax({
            type: "POST",
            url: '<?= U::addSession('api/attend.php') ?>',
            dataType: 'json',
            contentType: 'application/json',
            data: JSON.stringify({ "code": code }),
            success: function (data) {
                console.log('Attend');
                if ( data.status == "success" ) {
                    $("#alert").html("Success");
                } else {
                    $("#alert").html("Incorrect code");
                }
            }
        });
    });
});
</script>
<?php
$OUTPUT->footerEnd();

