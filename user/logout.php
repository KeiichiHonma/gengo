<?php
require_once('user/prepend.php');
$user_auth->logout(FALSE);//リダイレクトはjavascriptで
// display it
$con->append();
?>
