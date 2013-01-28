<?php
require_once('fw/parameterManager.php');
require_once('manager/table.php');
class managerParameter extends parameterManager
{
    public $timestamp;

    function __construct(){
        $this->timestamp = time();
    }

    public function setAdd(){
        parent::readyAddParameter(TRUE,$this->timestamp);
        //$this->parameter['validate'] = STATUS_MANAGER_ON;//on
        $this->parameter['validate'] = STATUS_MANAGER_OFF;//off
        $this->setParameter();
    }

    //管理者のみ
    public function setUpdate($mid){
        parent::readyUpdateParameter($mid,TRUE,$this->timestamp);
        $this->parameter['mail'] = $_POST['mail'];
        $this->parameter['given_name'] = $_POST['given_name'];
/*        $hash = $this->static_hashPassword($_POST['password']);
        $this->parameter['password'] = $hash['hash'];
        $this->parameter['salt'] = $hash['salt'];*/
        $this->parameter['validate'] = $_POST['validate'];
    }

    public function setMailUpdate($mid){
        parent::readyUpdateParameter($mid,TRUE,$this->timestamp);
        $this->setMailParameter();
    }

    public function setPasswordUpdate($mid){
        parent::readyUpdateParameter($mid,TRUE,$this->timestamp);
        $this->setPasswordParameter();
    }

    //学校の表示名を変更可能
    public function setNameUpdate(){
        parent::readyUpdateParameter($_POST['mid'],TRUE,$this->timestamp);
        $this->setNameParameter();
    }

    public function setDelete(){
        parent::readyDeleteParameter($_POST['mid']);
    }
    
    //checkが済んでいる前提なのでNOチェック
    public function setParameter(){
        $columns = managerTable::getInput();//特殊な形できます
        foreach($columns as $column){
            if($column == 'password'){
                $hash = $this->static_hashPassword($_POST[$column]);
                $this->parameter[$column] = $hash['hash'];
                $this->parameter['salt'] = $hash['salt'];
            }else{
                $this->parameter[$column] = $_POST[$column];
            }
        }
    }

    //mail
    public function setMailParameter(){
        $columns = managerTable::getMail();//特殊な形できます
        foreach($columns as $column){
            $this->parameter[$column] = $_POST[$column];
        }
    }

    //password
    public function setPasswordParameter(){
        $columns = managerTable::getPassword();//特殊な形できます
        foreach($columns as $column){
            if($column == 'password'){
                $hash = $this->static_hashPassword($_POST[$column]);
                $this->parameter[$column] = $hash['hash'];
                $this->parameter['salt'] = $hash['salt'];
            }else{
                $this->parameter[$column] = $_POST[$column];
            }
        }
    }
    
    //name
    public function setNAmeParameter(){
        $columns = managerTable::getName();//特殊な形できます
        foreach($columns as $column){
            $this->parameter[$column] = $_POST[$column];
        }
    }
}
?>