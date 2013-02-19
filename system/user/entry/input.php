<?php
//--[ 前処理 ]--------------------------------------------------------------
require_once('manager/prepend.php');


//form情報アサイン
require_once('user/form.php');
$form = new userForm();
$form->assignForm();

$page = 'input';
if ( $con->isPost ){
    if($_POST['operation'] == 'check'){
        require_once('user/check.php');
        checkUserEntry::checkError();
        $page = checkUserEntry::safeExit() ? 'confirm' : 'input';
    }elseif($_POST['operation'] == 'back'){
        $page = 'input';
    }elseif($_POST['operation'] == 'regist'){
        require_once('user/check.php');
        checkUserEntry::checkError();
        $bl = checkUserEntry::safeExit();
        if($bl){
            //ユーザー登録///////////////////////////
            require_once('user/handle.php');
            $user_handle = new userHandle();
            $uid = $user_handle->addRow();
            $con->safeExitRedirect('/system/user/',TRUE);
        }else{
            $con->safeExitRedirect('/system/',TRUE);
        }

    }
}else{
    $_POST['mail'] = 'test1@zeus.corp.813.co.jp';
    //debug//
    if($con->isDebug){
        $_POST['mail'] = 'test1@zeus.corp.813.co.jp';
        $_POST['given_name'] = 'user';
        $_POST['skype_name'] = 'keiichi_81';
    }
}
//共通処理////////////////////////

$con->append('system/user/entry/'.$page);
?>
