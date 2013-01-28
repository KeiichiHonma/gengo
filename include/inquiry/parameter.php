<?php
require_once('fw/parameterManager.php');
require_once('inquiry/table.php');
class inquiryParameter extends parameterManager
{
    public function setAdd(){
        parent::readyAddParameter();
        $this->setParameter();
    }

    public function setUpdate($cid){
        parent::readyUpdateParameter($cid);
        $this->setParameter();
    }

    public function setDelete($cid){
        parent::readyDeleteParameter($cid);
    }
    
    //checkが済んでいる前提なのでNOチェック
    public function setParameter(){
        $columns = inquiryTable::getInput();//特殊な形できます
        foreach($columns as $column){
            $this->parameter[$column] = $_POST[$column];
        }
        $trigger = array();
        if(isset($_POST['search_check'])) $trigger['search_check'] = 'search_check';
        if(isset($_POST['sales_check'])) $trigger['sales_check'] = 'sales_check';
        if(isset($_POST['friend_check'])) $trigger['friend_check'] = 'friend_check';
        if(isset($_POST['press_check'])) $trigger['press_check'] = 'press_check';
        if(isset($_POST['media_check'])) $trigger['media_check'] = isset($_POST['media_name']) ? $_POST['media_name'] : '';
        if(isset($_POST['etc_check'])) $trigger['etc_check'] = isset($_POST['etc_name']) ? $_POST['etc_name'] : '';
        
        if(count($trigger) > 0){
            $this->parameter['trigger'] = serialize($trigger);
        }else{
            $this->parameter['trigger'] = '';
        }
    }

}
?>