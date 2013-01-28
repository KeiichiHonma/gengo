<?php
require_once('fw/logicManager.php');
require_once('user/table.php');
class userLogic extends logicManager
{
    protected function getCoreUser($from = 0,$to = FIRSTSP,$order = null){
        $this->addSelectColumn(userTable::get());
        if(!is_null($order)){
            $this->addOrderColumn($order['column'],$order['desc_asc']);
        }else{
            $order = array('column'=>'col_ctime','desc_asc'=>DATABASE_DESC);
            $this->addOrderColumn($order['column'],$order['desc_asc']);
        }
        $this->limit($from,$to);
        $this->setFound();
        return parent::getResult(T_USER);
    }

    //count core
    protected function getCoreCount(){
        $this->addCountColumn('_id','col_user_count');
        return parent::getCount(T_USER,'col_user_count');
    }

    function getOneUser($uid){
        $this->setCond('_id',$uid);
        return $this->getCoreUser(0,1,null);
    }

    function getOneUserForDir($user_dir){
        $this->setCond('col_directory',$user_dir);
        return $this->getCoreUser(0,1,null);
    }

    function getUser($from = 0,$to = FIRSTSP,$order = null){
        return $this->getCoreUser($from,$to,$order);
    }
}
?>