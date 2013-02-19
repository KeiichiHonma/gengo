<?php
require_once('common/prepend.php');

/*require_once('manager/logic.php');
$m_logic = new managerLogic();
$free = $m_logic->getStatusManager();*/

/*require_once('manager/handle.php');
$manager_handle = new managerHandle();
$manager_handle->updateStatusRow(1,0);
$con->safeExit();*/

if($con->isStage){
    $con->t->assign('domain','gengo.813.co.jp');
}else{
    $con->t->assign('domain','gengo.apollon.corp.813.co.jp');
}

$con->append();
?>
