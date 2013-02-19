<?php
//--[ 前処理 ]--------------------------------------------------------------
require_once('manager/prepend.php');
$uid = $con->base->getPath('mid',TRUE);//リダイレクトあり

require_once('user/logic.php');
$m_logic = new userLogic();
$user = $m_logic->getOneUser($uid);
if(!$user){
    require_once('fw/errorUser.php');
    errorUser::throwError(E_SYSTEM_MANAGER_EXISTS);
}

$con->t->assign('user',$user);

//form情報アサイン
require_once('user/form.php');
$form = new userPasswordForm();
$form->assignForm();

$page = 'input';
if ( $con->isPost ){
    if($_POST['operation'] == 'check'){
        require_once('user/check.php');
        checkUserPasswordEdit::checkError();
        $page = checkUserPasswordEdit::safeExit() ? 'confirm' : 'input';
    }elseif($_POST['operation'] == 'back'){
        $page = 'input';
    }elseif($_POST['operation'] == 'regist'){
        require_once('user/handle.php');
        $user_handle = new userHandle();
        $uid = $user_handle->updatePasswordRow($uid);
        
        $con->safeExitRedirect('/system/user/view/mid/'.$uid,TRUE);
    }
}

//position 店舗及びADMINで見るページが違います
systemPosition::makeShopPosition($shop[0]['col_name_ja']);

//共通処理////////////////////////

$con->append('system/user/edit/password/'.$page);
?>
