<?php
require_once('user/prepend.php');

if($con->isStage){
    $con->t->assign('domain','gengo.813.co.jp');
}else{
    $con->t->assign('domain','gengo.apollon.corp.813.co.jp');
}
$con->t->assign('uid',$con->session->get(SESSION_U_UID));
$con->append($page);
?>
