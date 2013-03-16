<?php
require_once('fw/logicManager.php');
require_once('user/table.php');
require_once('manager/table.php');
require_once('call/table.php');
class callLogic extends logicManager
{
    function __construct(){
    }

    function getResult($type = COMMON,$alias = null){
        $this->addSelectColumn(callTable::get($type),$alias);
        //$this->setDebug();
        $order = array('column'=>'_id','desc_asc'=>DATABASE_DESC);
        $this->addOrderColumn($order['column'],$order['desc_asc']);
        return parent::getResult(T_CALL,$alias);
    }

    function getRow($id,$type = COMMON){
        $this->addSelectColumn(callTable::get($type));
        $this->validateCondition();
        return parent::getRow(T_CALL,$id);
    }

    function getOneCall($cid){
        $this->addSelectColumn(callTable::get());
        $this->setCond('_id',$cid);
        //return parent::getDebug(T_CALL,A_CALL);
        return parent::getResult(T_CALL,A_CALL);
    }
    
    //デフォルトは1日
    function getActiveCall($from_time = 86400){
        $this->addSelectColumn(callTable::getAlias());
        $this->addSelectColumn(userTable::getAlias());
        $this->addSelectColumn(managerTable::getAlias());
        
        $this->makeJoin('USER','_id','col_uid');
        $this->makeJoin('MANAGER','_id','col_mid');
        
        $this->setCondAlias('col_finish',1,A_CALL);
        $this->setCondAlias('col_ctime',$from_time,A_CALL,'>=');
        //return parent::getDebug(T_CALL,A_CALL);
        return parent::getResult(T_CALL,A_CALL);
    }

    protected function makeJoin($target,$on_column = 'col_cid',$base_column = DATABASE_OID_NAME,$type = DATABASE_INNER_JOIN){
        $this->addJoin( constant('T_'.$target), constant('A_'.$target).'.'.$on_column.' = '.A_CALL.'.'.$base_column,constant('A_'.$target),$type);
    }

    protected function getCoreCall($from = 0,$to = FIRSTSP,$order = null){
        $this->addSelectColumn(callTable::getAlias());
        $this->validateCondition(A_CALL);
        if(!is_null($order)){
            $this->addOrderColumn($order['column'],$order['desc_asc']);
        }else{
            $order = array('column'=>A_CALL.'.col_ctime','desc_asc'=>DATABASE_DESC);
            $this->addOrderColumn($order['column'],$order['desc_asc']);
        }
        $this->limit($from,$to);
        return parent::getResult(T_CALL,A_CALL);
    }
}
?>
