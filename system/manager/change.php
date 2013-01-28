<?php
//--[ 前処理 ]--------------------------------------------------------------
require_once('manager/prepend.php');
$mid = $con->base->getPath('mid',TRUE);//リダイレクトあり

//学校情報
require_once('shop/logic.php');//manager
$co_logic = new shopLogic(TRUE);
$shop = $co_logic->getOneShopForMID($mid);
if($shop){
    //店舗になりすますための情報をセット
    $con->session->set($manager_auth->session_key_oid,$shop[0]['col_mid']);
    $con->session->set($manager_auth->session_key_sid,$shop[0]['_id']);
    $con->safeExitRedirect('/system/shop/',TRUE);
}

$con->append();
?>
