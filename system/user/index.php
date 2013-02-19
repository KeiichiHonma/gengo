<?php
//--[ 前処理 ]--------------------------------------------------------------
require_once('manager/prepend.php');

require_once('user/logic.php');//user
$m_logic = new userLogic();
$m_logic->setIndexColumn(DATABASE_OID_NAME);//index入れ替え
$con->t->assign('user',$m_logic->getResult());//userの全て

$con->append();
?>
