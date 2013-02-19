<?php
require_once('fw/parameterManager.php');
require_once('call/table.php');
class callParameter extends parameterManager
{
    public $timestamp;

    function __construct(){
        $this->timestamp = time();
    }

    public function setAdd($type,$uid,$mid){
        parent::readyAddParameter(TRUE,$this->timestamp);
        $this->parameter['uid'] = $uid;
        $this->parameter['mid'] = $mid;
        $this->parameter['type'] = $type;
        $this->parameter['confirm'] = 0;
        $this->parameter['finish'] = 0;
    }

    //管理者のみ
    public function setUpdate($cid){
        parent::readyUpdateParameter($mid,TRUE,$this->timestamp);
    }

    public function setManagerUpdate($cid,$mid){
        parent::readyUpdateParameter($cid,TRUE,$this->timestamp);
        $this->parameter['mid'] = $mid;
    }

    public function setDelete(){
        parent::readyDeleteParameter($_POST['mid']);
    }
    
    //checkが済んでいる前提なのでNOチェック
    public function setParameter(){
        $columns = callTable::getInput();//特殊な形できます
        foreach($columns as $column){
            $this->parameter[$column] = $_POST[$column];
        }
    }
}
?>