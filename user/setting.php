<?php
require_once('user/prepend.php');
if(!$user_auth->validateLogin()) $con->safeExitRedirect('/user/login',TRUE);
$con->t->assign('user_type',$con->session->get(SESSION_M_TYPE));
if($con->isStage){
    $con->t->assign('domain','gengo.813.co.jp');
}else{
    $con->t->assign('domain','gengo.apollon.corp.813.co.jp');
}
$con->t->assign('uid',$con->session->get(SESSION_U_UID));
$con->append($page);
?>
