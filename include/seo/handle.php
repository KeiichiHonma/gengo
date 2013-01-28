<?php
require_once('fw/handleManager.php');
require_once('seo/parameter.php');
class seoHandle extends handleManager
{
    public $parameter;
    
    function __construct(){
        $this->parameter = new seoParameter();
    }
    
    public function addRow(){
        $this->parameter->setAdd();
        return parent::addRow(T_SEO,$this->parameter);
    }
    
    public function updateRow($sid){
        $this->parameter->setUpdate($sid);
        return parent::updateRow(T_SEO,$this->parameter);
    }

    public function deleteRow($sid){
        $this->parameter->setDelete($sid);
        return parent::deleteRow(T_SEO,$this->parameter);
    }

}
?>
