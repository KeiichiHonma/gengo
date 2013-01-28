<?php
//--[ 前処理 ]--------------------------------------------------------------
require_once('manager/prepend.php');
$mid = $con->base->getPath('mid',TRUE);//リダイレクトあり

require_once('manager/logic.php');
$m_logic = new managerLogic();
$manager = $m_logic->getOneManager($mid);
if(!$manager){
    require_once('fw/errorManager.php');
    errorManager::throwError(E_SYSTEM_MANAGER_EXISTS);
}

$con->t->assign('manager',$manager);

//form情報アサイン
require_once('manager/form.php');
$form = new managerPasswordForm();
$form->assignForm();

$page = 'input';
if ( $con->isPost ){
    if($_POST['operation'] == 'check'){
        require_once('manager/check.php');
        checkManagerPasswordEdit::checkError();
        $page = checkManagerPasswordEdit::safeExit() ? 'confirm' : 'input';
    }elseif($_POST['operation'] == 'back'){
        $page = 'input';
    }elseif($_POST['operation'] == 'regist'){
        require_once('manager/handle.php');
        $manager_handle = new managerHandle();
        $mid = $manager_handle->updatePasswordRow($mid);
        
        $con->safeExitRedirect('/system/manager/view/mid/'.$mid,TRUE);
    }
}

//position 店舗及びADMINで見るページが違います
systemPosition::makeShopPosition($shop[0]['col_name_ja']);

//共通処理////////////////////////

$con->append('system/manager/edit/password/'.$page);
?>
