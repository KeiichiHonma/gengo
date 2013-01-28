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
$manager = $m_logic->getOneManager($mid);
if(!$manager){
    require_once('fw/errorManager.php');
    errorManager::throwError(E_SYSTEM_MANAGER_EXISTS);
}
$con->t->assign('mid',$manager[0]['_id']);

$_POST['mail'] = $manager[0]['col_mail'];
$_POST['given_name'] = $manager[0]['col_given_name'];
$_POST['password'] = '******';
$_POST['validate'] = $manager[0]['col_validate'];
$con->append();
?>
