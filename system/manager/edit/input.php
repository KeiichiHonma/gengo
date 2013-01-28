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

$page = 'input';
if ( $con->isPost ){
    if($_POST['operation'] == 'check'){
        require_once('manager/check.php');
        checkManagerEdit::checkError();
        $page = checkManagerEdit::safeExit() ? 'confirm' : 'input';
    }elseif($_POST['operation'] == 'back'){
        $page = 'input';
    }elseif($_POST['operation'] == 'regist'){
        require_once('manager/check.php');
        checkManagerEdit::checkError();
        $bl = checkManagerEdit::safeExit();
        if($bl){
            require_once('manager/handle.php');
            $manager_handle = new managerHandle();
            $mid = $manager_handle->updateRow($mid);
            
            $con->safeExitRedirect('/system/manager/view/mid/'.$mid,TRUE);
        }else{
            $con->safeExitRedirect('/system/manager/',TRUE);
        }

    }
}else{
    $_POST['mail'] = $manager[0]['col_mail'];
    $_POST['given_name'] = $manager[0]['col_given_name'];
    $_POST['validate'] = $manager[0]['col_validate'];
    
}

//共通処理////////////////////////

$con->append('system/manager/edit/'.$page);
?>
