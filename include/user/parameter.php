<?php
require_once('fw/parameterManager.php');
require_once('user/table.php');
class userParameter extends parameterManager
{
    public $timestamp;

    function __construct(){
        $this->timestamp = time();
    }

    public function setAdd(){
        parent::readyAddParameter(TRUE,$this->timestamp);
        $this->setParameter();
    }

    public function setUpdate($uid){
        parent::readyUpdateParameter($uid,TRUE,$this->timestamp);
        $this->setParameter();
    }

    public function setDelete($uid){
        parent::readyDeleteParameter($uid);
    }
    
    //checkが済んでいる前提なのでNOチェック
    public function setParameter(){
        $columns = userTable::getInput();//特殊な形できます
        foreach($columns as $column){
            $this->parameter[$column] = $_POST[$column];
        }
    }
}
?>