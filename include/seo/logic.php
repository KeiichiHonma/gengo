<?php
require_once('fw/logicManager.php');
require_once('seo/table.php');
class seoLogic extends logicManager
{
    protected function getCoreSeo($from = 0,$to = FIRSTSP,$order = null){
        $this->addSelectColumn(seoTable::get());
        if(!is_null($order)){
            $this->addOrderColumn($order['column'],$order['desc_asc']);
        }else{
            $order = array('column'=>'col_ctime','desc_asc'=>DATABASE_DESC);
            $this->addOrderColumn($order['column'],$order['desc_asc']);
        }
        if(!is_null($from) && !is_null($to))$this->limit($from,$to);
        $this->setFound();
        return parent::getResult(T_SEO);
    }

    //count core
    protected function getCoreCount(){
        $this->addCountColumn('_id','col_seo_count');
        return parent::getCount(T_SEO,'col_seo_count');
    }

    function getOneSeo($sid){
        $this->setCond('_id',$sid);
        return $this->getCoreSeo(0,1,null);
    }

    function getOneSeoForDir($seo_dir){
        $this->setCond('col_directory',$seo_dir);
        return $this->getCoreSeo(0,1,null);
    }

    function getSeo($uid,$order = null){
        $this->setCond('col_uid',$uid);
        return $this->getCoreSeo(null,null,$order);
    }
}
?>