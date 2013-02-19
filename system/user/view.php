<?php
//--[ 前処理 ]--------------------------------------------------------------
require_once('manager/prepend.php');
$uid = $con->base->getPath('mid',TRUE);//リダイレクトあり

//form情報アサイン
require_once('user/form.php');
$form = new userForm();
$form->assignForm();

require_once('user/logic.php');//user
$m_logic = new userLogic();
$user = $m_logic->getOneUser($uid);
if(!$user){
    require_once('fw/errorUser.php');
    errorUser::throwError(E_SYSTEM_MANAGER_EXISTS);
}
$con->t->assign('mid',$user[0]['_id']);

$_POST['mail'] = $user[0]['col_mail'];
$_POST['given_name'] = $user[0]['col_given_name'];
$_POST['password'] = '******';
$_POST['validate'] = $user[0]['col_validate'];
$con->append();
?>
