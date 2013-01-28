<?php
if(isset($_GET['target']) && $_GET['target'] == 'system'){
    //--[ 前処理 ]--------------------------------------------------------------
    require_once('manager/prepend.php');
    $manager_auth->logout();
}elseif(isset($_GET['target']) && $_GET['target'] == 'shop'){
    //--[ 前処理 ]--------------------------------------------------------------
    require_once('shop/prepend.php');
    $manager_auth->logout();
}else{
    require_once('manager/prepend.php');
    $manager_auth->logout();
}
die();
?>
