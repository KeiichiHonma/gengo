<?php
//--[ 前処理 ]--------------------------------------------------------------
require_once('manager/prepend.php');

require_once('manager/logic.php');//manager
$m_logic = new managerLogic();
$m_logic->setIndexColumn(DATABASE_OID_NAME);//index入れ替え
$con->t->assign('manager',$m_logic->getResult());//managerの全て

$con->append();
?>
