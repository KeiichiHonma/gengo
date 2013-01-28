<?php
require_once('fw/parameterManager.php');
require_once('seo/table.php');
class seoParameter extends parameterManager
{
    public $timestamp;

    function __construct(){
        $this->timestamp = time();
    }

    public function setAdd(){
        parent::readyAddParameter(TRUE,$this->timestamp);
        $this->setParameter();
    }

    public function setUpdate($sid){
        parent::readyUpdateParameter($sid,TRUE,$this->timestamp);
        $this->setParameter();
    }

    public function setDelete($sid){
        parent::readyDeleteParameter($sid);
    }
    
    //checkが済んでいる前提なのでNOチェック
    public function setParameter(){
        $columns = seoTable::getInput();//特殊な形できます
        foreach($columns as $column){
            $this->parameter[$column] = $_POST[$column];
        }
    }
}
?>