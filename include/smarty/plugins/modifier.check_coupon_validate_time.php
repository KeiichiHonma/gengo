<?php
function smarty_modifier_check_coupon_validate_time($validate_time)
{
    if(!isset($validate_time)) return '';
    $now = time();
    $ng_time =  strtotime("+3 month"); //3か月後
    $ng_year = date("Y",$ng_time);
    $ng_month = date("m",$ng_time);
    $ng_day = date("d",$ng_time);
    
    $ng_date = mktime(0, 0, 0, $ng_month,$ng_day,$ng_year);
    
    $validate_year = date("Y",$validate_time);
    $validate_month = date("m",$validate_time);
    $validate_day = date("d",$validate_time);
    
    $validate_date = mktime(0, 0, 0, $validate_month,$validate_day,$validate_year);
    
    if($validate_date < $ng_date ){
        return 'validate_time_alert';//css class
    }else{
        return 'validate_time_common';//css class
    }
    
}
?>