<?php
//--[ 前処理 ]--------------------------------------------------------------
require_once('manager/prepend.php');

//お知らせ
//require_once('message/logic.php');
//$ms_logic = new messageSystemLogic();
//$message = $ms_logic->getUserMessage();
//$con->t->assign('message',$message);
if(strcasecmp($con->session->get(SESSION_M_TYPE),TYPE_M_ADMIN) == 0){
    $page = 'system/backend';
}else{
    $con->t->assign('mid',$con->session->get(SESSION_M_MID));
    
    $page = 'system/client';
}
$con->append($page);
?>
