<?php
function smarty_modifier_unserialize_feature($serialize_setting)
{
    if(is_null($serialize_setting) || $serialize_setting == '') return '';
    global $feature_logic;
    $html = '';
    $setting = unserialize($serialize_setting);
    
    foreach ($feature_logic->feature_info as $key => $array){
        if(in_array($array['_id'],$setting['feature'])){
            $html .= '<li><img alt="'.$array['col_name'].'" height="38" src="/locale/'.LOCALE.'/img/coupon/service0'.$array['_id'].'.gif" width="58" /></li>';
        }else{
            $html .= '<li><img alt="'.$array['col_name'].'" height="38" src="/locale/'.LOCALE.'/img/coupon/service_no0'.$array['_id'].'.gif" width="58" /></li>';
        }
    }
    return $html;
}
?>