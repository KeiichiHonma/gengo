<?php
//--[ 前処理 ]--------------------------------------------------------------
require_once('manager/prepend.php');


//form情報アサイン
require_once('manager/form.php');
$form = new managerForm();
$form->assignForm();

$page = 'input';
if ( $con->isPost ){
    if($_POST['operation'] == 'check'){
        require_once('manager/check.php');
        checkManagerEntry::checkError();
        $page = checkManagerEntry::safeExit() ? 'confirm' : 'input';
    }elseif($_POST['operation'] == 'back'){
        $page = 'input';
    }elseif($_POST['operation'] == 'regist'){
        require_once('manager/check.php');
        checkManagerEntry::checkError();
        $bl = checkManagerEntry::safeExit();
        if($bl){
            $isAddShop = FALSE;
            if(strcasecmp($_POST['authority'],'shop') == 0 && strlen($_POST['given_name']) > 0){
                $_POST['type'] = TYPE_M_MANAGER;//直指定
                $isAddShop = TRUE;
            }elseif(strcasecmp($_POST['authority'],'manager') == 0){
                $_POST['type'] = TYPE_M_SUPPORT;//直指定
            }else{
                //ありえない。しかも危険
                die();
            }

            //マネージャー登録///////////////////////////
            require_once('manager/handle.php');
            $manager_handle = new managerHandle();
            $mid = $manager_handle->addRow();
            
            //店舗情報登録///////////////////////////
            if($isAddShop){
                
                $_POST['type'] = TYPE_M_MANAGER;//直指定
                require_once('shop/handle.php');
                $shop_handle = new shopHandle();
                $shop_handle->addRowForManager($mid,$_POST['given_name']);//店舗情報は空、無効状態で
            }

            $con->safeExitRedirect('/system/manager/',TRUE);
        }else{
            $con->safeExitRedirect('/system/',TRUE);
        }

    }
}else{
    $_POST['mail'] = 'test1@zeus.corp.813.co.jp';
    //debug//
    if($con->isDebug){
        //$_POST['mail'] = 'test1@zeus.corp.813.co.jp';
        //$_POST['given_name'] = 'ビックカメラ';
    }
}
//共通処理////////////////////////

$con->append('system/manager/entry/'.$page);
?>
