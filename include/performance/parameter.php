<?php
require_once('fw/parameterManager.php');
require_once('performance/table.php');
class performanceParameter extends parameterManager
{
    public function setAdd($url,$seconds,$result){
        parent::readyAddParameter();
        $this->setParameter($url,$seconds,$result);
    }

    public function setUpdate($pid){
        parent::readyUpdateParameter($pid);
        $this->setParameter();
    }

    public function setDelete($pid){
        parent::readyDeleteParameter($pid);
    }
    
    //checkが済んでいる前提なのでNOチェック
    public function setParameter($url,$seconds,$result){
        $this->parameter['url'] = $url;
        $this->parameter['seconds'] = $seconds;
        $this->parameter['result'] = $result;
    }

}
?>