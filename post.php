<?php
require_once('fw/prepend.php');
require_once('manager/auth.php');
$manager_auth = new managerAuth();
$manager_auth->validateLogin();//認証必須

if ( $con->isPost ){
    require_once('call/handle.php');
    $call_handle = new callHandle();
    $mid = $call_handle->addRow($_POST['gengo'],$_POST['mid']);
    $con->safeExit();
}else{
    //$_POST['mail'] = 'test1@zeus.corp.813.co.jp';
    //debug//
    if($con->isDebug){
        //$_POST['mail'] = 'test1@zeus.corp.813.co.jp';
        //$_POST['given_name'] = 'ビックカメラ';
    }
}
die();
?>