<?php
require_once('fw/logicManager.php');
require_once('manager/table.php');
class managerLogic extends logicManager
{
    function __construct(){
    }

    function getResult($type = COMMON,$alias = null){
        $this->addSelectColumn(managerTable::get($type),$alias);
        //$this->setDebug();
        $order = array('column'=>'_id','desc_asc'=>DATABASE_DESC);
        $this->addOrderColumn($order['column'],$order['desc_asc']);
        return parent::getResult(T_MANAGER,$alias);
    }

    function getRow($id,$type = COMMON){
        $this->addSelectColumn(managerTable::get($type));
        $this->validateCondition();
        return parent::getRow(T_MANAGER,$id);
    }

    //システムから呼び出し。有効無効問わない
    function getOneManager($mid){
        $this->addSelectColumn(managerTable::get());
        $this->setCond('_id',$mid);
        //return parent::getDebug(T_MANAGER,A_MANAGER);
        return parent::getResult(T_MANAGER,A_MANAGER);
    }

    function getManager($mid,$type = COMMON){
        $this->addSelectColumn(managerTable::get($type));
        $this->setCond('_id',$mid);
        $this->validateCondition();
        //return parent::getDebug(T_MANAGER,A_MANAGER);
        return parent::getResult(T_MANAGER,A_MANAGER);
    }

    function getStatusManager(){
        $this->addSelectColumn(managerTable::get());
        $this->validateCondition();
        parent::setCond('col_type',TYPE_M_MANAGER);
        parent::setCond('col_status',STATUS_FREE);
        $order = array('column'=>'col_score','desc_asc'=>DATABASE_ASC);
        $this->addOrderColumn($order['column'],$order['desc_asc']);
        $this->limit(0,1);
        //return parent::getDebug(T_MANAGER,A_MANAGER);
        return parent::getResult(T_MANAGER);
    }

    function getTypeManager($type = ALL){
        $this->addSelectColumn(managerTable::get($type));
        $this->validateCondition();
        parent::setCond('col_type',TYPE_M_MANAGER,'>=');//manager以下
        //return parent::getDebug(T_MANAGER,A_MANAGER);
        return parent::getResult(T_MANAGER);
    }

    function getTypeTeacher($type = ALL){
        $this->addSelectColumn(managerTable::get($type));
        $this->validateCondition();
        parent::setCond('col_type',TYPE_M_ADMIN,'<');//adminより小さい
        //return parent::getDebug(T_MANAGER,A_MANAGER);
        return parent::getResult(T_MANAGER);
    }

    function getAllManager($type = COMMON){
        $this->addSelectColumn(managerTable::get($type));
        $this->validateCondition();
        //return parent::getDebug(T_MANAGER,A_MANAGER);
        return parent::getResult(T_MANAGER,A_MANAGER);
    }

    public function getRowLoginName($login_name,$type = ALL){
        $this->addSelectColumn(managerTable::get($type));
        $this->setCond('col_mail',$login_name);
        $this->validateCondition();
        //$this->setDebug();
        return parent::getResult(T_MANAGER);//オーバーライドしてるので
    }

    protected function makeJoin($target,$on_column = 'col_mid',$base_column = DATABASE_OID_NAME,$type = DATABASE_INNER_JOIN){
        $this->addJoin( constant('T_'.$target), constant('A_'.$target).'.'.$on_column.' = '.A_MANAGER.'.'.$base_column,constant('A_'.$target),$type);
    }

    protected function getCoreManager($from = 0,$to = FIRSTSP,$order = null){
        $this->addSelectColumn(managerTable::getAlias());
        $this->validateCondition(A_MANAGER);
        if(!is_null($order)){
            $this->addOrderColumn($order['column'],$order['desc_asc']);
        }else{
            $order = array('column'=>A_MANAGER.'.col_ctime','desc_asc'=>DATABASE_DESC);
            $this->addOrderColumn($order['column'],$order['desc_asc']);
        }
        $this->limit($from,$to);
        return parent::getResult(T_MANAGER,A_MANAGER);
    }
}
?>