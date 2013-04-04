<?php
require_once('user/prepend.php');
if(!$user_auth->validateLogin()) $con->safeExitRedirect('/user/login',TRUE);



$con->t->assign('user_type',$con->session->get(SESSION_M_TYPE));
if($con->isStage){
    $con->t->assign('domain','gengo.813.co.jp');
}else{
    $con->t->assign('domain','gengo.apollon.corp.813.co.jp');
}

$uid = $con->session->get(SESSION_U_UID);
$con->t->assign('uid',$uid);

require_once('user/logic.php');
$user_logic = new userLogic();
$user = $user_logic->getOneUser($uid);
$con->t->assign('user',$user);

if ( $con->isPost ){
    require_once('user/check.php');
    checkUserFacetimeEdit::checkError();
    $bl = checkUserFacetimeEdit::safeExit();
    if($bl){
        require_once('user/handle.php');
        $user_handle = new userHandle();
        $user_handle->updateFacetimeRow($uid);
        $con->safeExitRedirect('/user/setting',TRUE);
    }else{
        $con->safeExitRedirect('/user/',TRUE);
    }
}else{
    $_POST['facetime'] = $user[0]['col_facetime'];
}

$con->append($page);
?>
