<?php
require_once('user/prepend.php');
if(!$user_auth->validateLogin()) $con->safeExitRedirect('/user/login',TRUE);
$con->t->assign('user_type',$con->session->get(SESSION_M_TYPE));

if($con->isStage){
    $con->t->assign('domain','gengo.813.co.jp');
}else{
    $con->t->assign('domain','gengo.apollon.corp.813.co.jp');
}
$uid = $con->session->get( SESSION_U_UID );
$con->t->assign('uid',$uid);

//param set
$con->t->assign('message_en',json_encode( array('type'=>'call','lang'=>TYPE_LANG_EN,'uid'=>$uid ) ) );
$con->t->assign('message_cn',json_encode( array('type'=>'call','lang'=>TYPE_LANG_CN,'uid'=>$uid ) ) );
$con->t->assign('message_kr',json_encode( array('type'=>'call','lang'=>TYPE_LANG_KR,'uid'=>$uid ) ) );

$con->append($page);
?>
