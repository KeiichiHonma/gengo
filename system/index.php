<?php
require_once('manager/prepend.php');

if($con->isStage){
    $con->t->assign('domain','gengo.813.co.jp');
}else{
    $con->t->assign('domain','gengo.apollon.corp.813.co.jp');
}
$con->t->assign('mid',$con->session->get(SESSION_M_MID));
$con->t->assign('manager',$con->session->get(SESSION_M_GIVEN_NAME));

$con->append($page);
?>
