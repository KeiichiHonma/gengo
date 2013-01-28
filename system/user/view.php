<?php
//--[ 前処理 ]--------------------------------------------------------------
require_once('manager/prepend.php');
$uid = $con->base->getPath('uid',TRUE);//リダイレクトあり

//form情報アサイン
require_once('user/form.php');
$form = new userForm();
$form->assignForm();

require_once('user/logic.php');
$u_logic = new userLogic();
$user = $u_logic->getOneUser($uid);

if(!$user){
    require_once('fw/errorManager.php');
    errorManager::throwError(E_CMMN_USER_EXISTS);
}

$con->t->assign('user',$user);

$_POST['name'] = $user[0]['col_name'];
$_POST['directory'] = $user[0]['col_directory'];
$_POST['url'] = $user[0]['col_url'];
$_POST['depth'] = $user[0]['col_depth'];
$_POST['domain'] = $user[0]['col_domain'];
$_POST['rollover'] = $user[0]['col_rollover'];
$_POST['direct'] = $user[0]['col_direct'];
$_POST['replace'] = $user[0]['col_replace'];
$_POST['validate'] = $user[0]['col_validate'];

$con->append();
?>
