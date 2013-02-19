<?php
//--[ 前処理 ]--------------------------------------------------------------
require_once('manager/prepend.php');
$uid = $con->base->getPath('mid',TRUE);//リダイレクトあり

//form情報アサイン
require_once('user/form.php');
$form = new userForm();
$form->assignForm();

require_once('user/logic.php');//user
$m_logic = new userLogic();
$user = $m_logic->getUser($uid);
if(!$user){
    require_once('fw/errorUser.php');
    errorUser::throwError(E_MANAGER_EXISTS);
}
$con->t->assign('mid',$user[0]['_id']);

$page = 'input';
if ( $con->isPost ){
    if($_POST['operation'] == 'check'){
        $page = 'confirm';
    }elseif($_POST['operation'] == 'back'){
        $page = 'input';
    }elseif($_POST['operation'] == 'regist'){
        $bl = TRUE;
        if($bl){
            //クーポン登録///////////////////////////
            require_once('user/handle.php');
            $user_handle = new userHandle();
            $uid = $user_handle->deleteRow($uid);
            
            $con->safeExitRedirect('/system/user/',TRUE);
        }else{
            $con->safeExitRedirect('/system/',TRUE);
        }

    }
}else{
    $_POST['mail'] = $user[0]['col_mail'];
    $_POST['given_name'] = $user[0]['col_given_name'];
    $_POST['password'] = '******';
}
//共通処理////////////////////////

$con->append('system/user/drop/'.$page);
?>
