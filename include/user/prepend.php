<?php
require_once('fw/prepend.php');
require_once('user/auth.php');
$user_auth = new userAuth();

$user_auth->validateLogin();//認証必須
$con->t->assign('user_type',$con->session->get(SESSION_M_TYPE));
?>