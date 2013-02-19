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
        $this->parameter['score'] = 0;
        $this->parameter['validate'] = VALIDATE_ALLOW;
    }

    //管理者のみ
    public function setUpdate($uid){
        parent::readyUpdateParameter($uid,TRUE,$this->timestamp);
        $this->parameter['mail'] = $_POST['mail'];
        $this->parameter['given_name'] = $_POST['given_name'];
/*        $hash = $this->static_hashPassword($_POST['password']);
        $this->parameter['password'] = $hash['hash'];
        $this->parameter['salt'] = $hash['salt'];*/
        $this->parameter['validate'] = $_POST['validate'];
    }

    public function setMailUpdate($uid){
        parent::readyUpdateParameter($uid,TRUE,$this->timestamp);
        $this->setMailParameter();
    }

    public function setPasswordUpdate($uid){
        parent::readyUpdateParameter($uid,TRUE,$this->timestamp);
        $this->setPasswordParameter();
    }

    public function setNameUpdate(){
        parent::readyUpdateParameter($_POST['uid'],TRUE,$this->timestamp);
        $this->setNameParameter();
    }

    public function setStatusUpdate($uid,$status){
        parent::readyUpdateParameter($uid,TRUE,$this->timestamp);
        $this->parameter['status'] = $status;
        //busyに変更の場合scoreアップ
        if(strcasecmp($status,STATUS_BUSY) == 0) $this->parameter['score'] = array('increment'=>'col_score+1');//+1更新フォーマット
    }

    public function setDelete(){
        parent::readyDeleteParameter($_POST['uid']);
    }
    
    //checkが済んでいる前提なのでNOチェック
    public function setParameter(){
        $columns = userTable::getInput();//特殊な形できます
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
        $columns = userTable::getMail();//特殊な形できます
        foreach($columns as $column){
            $this->parameter[$column] = $_POST[$column];
        }
    }

    //password
    public function setPasswordParameter(){
        $columns = userTable::getPassword();//特殊な形できます
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
        $columns = userTable::getName();//特殊な形できます
        foreach($columns as $column){
            $this->parameter[$column] = $_POST[$column];
        }
    }
}
?>