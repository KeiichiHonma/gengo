<?php
//--[ 前処理 ]--------------------------------------------------------------
require_once('manager/prepend.php');

$uid = $con->base->getPath('uid',TRUE);//リダイレクトあり

require_once('user/logic.php');
$u_logic = new userLogic();
$user = $u_logic->getOneUser($uid);

if(!$user){
    require_once('fw/errorManager.php');
    errorManager::throwError(E_CMMN_USER_EXISTS);
}

$con->t->assign('user',$user);

//form情報アサイン
require_once('seo/form.php');
$form = new seoForm();
$form->assignForm();

$page = 'input';
if ( $con->isPost ){
    if($_POST['operation'] == 'check'){
        require_once('seo/check.php');
        checkSeo::checkError();
        $page = checkSeo::safeExit() ? 'confirm' : 'input';
    }elseif($_POST['operation'] == 'back'){
        $page = 'input';
    }elseif($_POST['operation'] == 'regist'){

        require_once('seo/check.php');
        checkSeo::checkError();
        $bl = checkSeo::safeExit();
        if($bl){
            require_once('seo/handle.php');
            $seo_handle = new seoHandle();
            $sid = $seo_handle->addRow();

            $con->safeExitRedirect('/system/seo/view/uid/'.$uid.'/sid/'.$sid,TRUE);

        }else{
            $con->safeExitRedirect('/system/seo/index/uid/'.$uid,TRUE);
        }

    }
}else{
    //debug//
    if($con->isDebug){
        $_POST['keyword']      = 'keyword';
        $_POST['description'] = 'description';
        $_POST['title']       = 'title';
    }
}

//共通処理////////////////////////

$con->append('system/seo/entry/'.$page);
?>
