<?php
require_once('fw/logicManager.php');
require_once('user/table.php');
class userLogic extends logicManager
{
    function __construct(){
    }

    function getResult($type = COMMON,$alias = null){
        $this->addSelectColumn(userTable::get($type),$alias);
        //$this->setDebug();
        $order = array('column'=>'_id','desc_asc'=>DATABASE_DESC);
        $this->addOrderColumn($order['column'],$order['desc_asc']);
        return parent::getResult(T_USER,$alias);
    }

    function getRow($id,$type = COMMON){
        $this->addSelectColumn(userTable::get($type));
        $this->validateCondition();
        return parent::getRow(T_USER,$id);
    }

    //システムから呼び出し。有効無効問わない
    function getOneUser($uid){
        $this->addSelectColumn(userTable::get());
        $this->setCond('_id',$uid);
        $this->validateCondition();
        //return parent::getDebug(T_USER,A_USER);
        return parent::getResult(T_USER);
    }

    function getUser($uid,$type = COMMON){
        $this->addSelectColumn(userTable::get($type));
        $this->setCond('_id',$uid);
        $this->validateCondition();
        //return parent::getDebug(T_USER,A_USER);
        return parent::getResult(T_USER);
    }

    function getStatusUser(){
        $this->addSelectColumn(userTable::get());
        $this->validateCondition();
        parent::setCond('col_type',TYPE_M_USER);
        parent::setCond('col_status',STATUS_FREE);
        $order = array('column'=>'col_score','desc_asc'=>DATABASE_ASC);
        $this->addOrderColumn($order['column'],$order['desc_asc']);
        $this->limit(0,1);
        //return parent::getDebug(T_USER,A_USER);
        return parent::getResult(T_USER);
    }

    function getTypeUser($type = ALL){
        $this->addSelectColumn(userTable::get($type));
        $this->validateCondition();
        parent::setCond('col_type',TYPE_M_USER,'>=');//user以下
        //return parent::getDebug(T_USER,A_USER);
        return parent::getResult(T_USER);
    }

    function getTypeTeacher($type = ALL){
        $this->addSelectColumn(userTable::get($type));
        $this->validateCondition();
        parent::setCond('col_type',TYPE_M_ADMIN,'<');//adminより小さい
        //return parent::getDebug(T_USER,A_USER);
        return parent::getResult(T_USER);
    }

    function getAllUser($type = COMMON){
        $this->addSelectColumn(userTable::get($type));
        $this->validateCondition();
        //return parent::getDebug(T_USER,A_USER);
        return parent::getResult(T_USER,A_USER);
    }

    public function getRowLoginName($login_name,$type = ALL){
        $this->addSelectColumn(userTable::get($type));
        $this->setCond('col_mail',$login_name);
        $this->validateCondition();
        //$this->setDebug();
        return parent::getResult(T_USER);//オーバーライドしてるので
    }

    protected function makeJoin($target,$on_column = 'col_uid',$base_column = DATABASE_OID_NAME,$type = DATABASE_INNER_JOIN){
        $this->addJoin( constant('T_'.$target), constant('A_'.$target).'.'.$on_column.' = '.A_USER.'.'.$base_column,constant('A_'.$target),$type);
    }

    protected function getCoreUser($from = 0,$to = FIRSTSP,$order = null){
        $this->addSelectColumn(userTable::getAlias());
        $this->validateCondition(A_USER);
        if(!is_null($order)){
            $this->addOrderColumn($order['column'],$order['desc_asc']);
        }else{
            $order = array('column'=>A_USER.'.col_ctime','desc_asc'=>DATABASE_DESC);
            $this->addOrderColumn($order['column'],$order['desc_asc']);
        }
        $this->limit($from,$to);
        return parent::getResult(T_USER,A_USER);
    }
}

class autoLoginLogic extends logicManager
{
    function getRow($id,$type = COMMON){
        $this->addSelectColumn(tmpRegistTable::get($type));
        $this->validateCondition();
        return parent::getRow(T_REGIST,$id);
    }
    
    //有効期限内のPASSPORT値が存在するか
    function getVaridateRow($passport,$expire,$type = COMMON){
        $this->addSelectColumn(autoLoginTable::get($type));
        $this->setCond('col_passport',$passport);
        $validateTime = time() - $expire;
        $this->setCond('col_ctime',$validateTime,'>=');
        //return parent::getDebug(T_AUTO);
        return parent::getResult(T_AUTO);
    }

    //指定のuidが存在するか
    function getUser($uid,$type = COMMON){
        $this->addSelectColumn(autoLoginTable::get($type));
        $this->setCond('col_uid',$uid);
        //return parent::getDebug(T_AUTO);
        return parent::getResult(T_AUTO);
    }

}
?>