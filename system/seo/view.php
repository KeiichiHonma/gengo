<?php
//--[ 前処理 ]--------------------------------------------------------------
require_once('manager/prepend.php');
$sid = $con->base->getPath('sid',TRUE);//リダイレクトあり

//form情報アサイン
require_once('seo/form.php');
$form = new seoForm();
$form->assignForm();

require_once('seo/logic.php');
$s_logic = new seoLogic();
$seo = $s_logic->getOneSeo($sid);

if(!$seo){
    require_once('fw/errorManager.php');
    errorManager::throwError(E_CMMN_SEO_EXISTS);
}

$con->t->assign('seo',$seo);

$_POST['keyword'] = $seo[0]['col_keyword'];
$_POST['description'] = $seo[0]['col_description'];
$_POST['title'] = $seo[0]['col_title'];

$con->append();
?>
