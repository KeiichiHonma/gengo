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

$page = 'input';
if ( $con->isPost ){
    if($_POST['operation'] == 'check'){
        require_once('user/check.php');
        checkUserEdit::checkError();
        $page = checkUserEdit::safeExit() ? 'confirm' : 'input';
    }elseif($_POST['operation'] == 'back'){
        $page = 'input';
    }elseif($_POST['operation'] == 'regist'){
        require_once('user/check.php');
        checkUserEdit::checkError();
        $bl = checkUserEdit::safeExit();
        if($bl){
            require_once('user/handle.php');
            $user_handle = new userHandle();
            $uid = $user_handle->updateRow($uid);
            
            $con->safeExitRedirect('/system/user/view/mid/'.$uid,TRUE);
        }else{
            $con->safeExitRedirect('/system/user/',TRUE);
        }

    }
}else{
    $_POST['mail'] = $user[0]['col_mail'];
    $_POST['given_name'] = $user[0]['col_given_name'];
    $_POST['validate'] = $user[0]['col_validate'];
    
}

//共通処理////////////////////////

$con->append('system/user/edit/'.$page);
?>
