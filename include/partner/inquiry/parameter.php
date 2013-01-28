<?php
require_once('fw/parameterManager.php');
require_once('partner/inquiry/table.php');
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
    }

}
?>