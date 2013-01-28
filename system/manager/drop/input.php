<?php
//--[ 前処理 ]--------------------------------------------------------------
require_once('manager/prepend.php');
$mid = $con->base->getPath('mid',TRUE);//リダイレクトあり

//form情報アサイン
require_once('manager/form.php');
$form = new managerForm();
$form->assignForm();

require_once('manager/logic.php');//manager
$m_logic = new managerLogic();
$manager = $m_logic->getManager($mid);
if(!$manager){
    require_once('fw/errorManager.php');
    errorManager::throwError(E_MANAGER_EXISTS);
}
$con->t->assign('mid',$manager[0]['_id']);

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
            require_once('manager/handle.php');
            $manager_handle = new managerHandle();
            $mid = $manager_handle->deleteRow($mid);
            
            $con->safeExitRedirect('/system/manager/',TRUE);
        }else{
            $con->safeExitRedirect('/system/',TRUE);
        }

    }
}else{
    $_POST['mail'] = $manager[0]['col_mail'];
    $_POST['given_name'] = $manager[0]['col_given_name'];
    $_POST['password'] = '******';
}
//共通処理////////////////////////

$con->append('system/manager/drop/'.$page);
?>
