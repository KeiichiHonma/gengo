<?php
require_once('manager/prepend.php');

if($con->isStage){
    $con->t->assign('domain','gengo.813.co.jp');
}else{
    $con->t->assign('domain','gengo.apollon.corp.813.co.jp');
}
$con->t->assign('mid',$con->session->get(SESSION_M_MID));
$con->t->assign('manager_given_name',$con->session->get(SESSION_M_GIVEN_NAME));
$con->t->assign('manager_type',$con->session->get(SESSION_M_TYPE));

require_once('call/logic.php');
$c_logic = new callLogic();
$call = $c_logic->getActiveCall();

$con->t->assign('call',$call);
$con->append($page);
?>
