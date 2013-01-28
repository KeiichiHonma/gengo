<?php
require_once('fw/prepend.php');
require_once('manager/auth.php');
$manager_auth = new managerAuth();

$manager_auth->validateLogin();//認証必須
systemPosition::makeSitePosition();
//アクセス権
$con->t->assign('manager_type',$con->session->get(SESSION_M_TYPE));
//$con->readyPostCsrf();

?>