<?php
class utilManager
{
    static public function checkPrefix($column,$as = null,$alias = null){
        if(preg_match("/^_id/", $column) == 1){
            if(!is_null($alias)){
                return is_null($as) ? $alias.'.'.$column : $alias.'.'.$column.' AS '.$as;
            }else{
                return $column;//そのまま _id
            }
        }else{
            if(!is_null($alias)){
                return is_null($as) ? $alias.'.'.DATABASE_COLUMN_PREFIX.$column : $alias.'.'.DATABASE_COLUMN_PREFIX.$column.' AS '.$as;
            }elseif(!is_null($as)){//locale
                return DATABASE_COLUMN_PREFIX.$column.' AS '.$as;
            }else{
                return DATABASE_COLUMN_PREFIX.$column;
            }
        }
    }
    
    static public function makePrefixParameter($param = array(),$alias = null){
        foreach ($param as $key => $value){
            $new = self::checkPrefix($key,$alias);
            $param[$new] = $value;
            if($new != $key) unset($param[$key]);//_idｊは消さない
        }
        return $param;
    }
    
    //locale変数をPOSTにセットする汎用関数
    //DBから取得された変数を各言語用パラメータにセットする
    static public function setLocalePostPram($param_name,$param,$someone_key = FALSE){
        if(!$someone_key) $someone_key = $param_name;
        $_POST[$param_name.'_'.LOCALE_JA] = $param['col_'.$someone_key.'_'.LOCALE_JA];
        $_POST[$param_name.'_'.LOCALE_CN] = $param['col_'.$someone_key.'_'.LOCALE_CN];
        $_POST[$param_name.'_'.LOCALE_TW] = $param['col_'.$someone_key.'_'.LOCALE_TW];
    }
    
    //店舗ITEMを店舗ID->アイテム種類->ファイル情報に変換する
    static public function getShopItemArray($shop_item){
        $photos = array();
        $texts = array();
        foreach ($shop_item as $key => $value){
            //$sid = $value['col_sid'];
            
            switch ($value['col_type']){
            case SHOP_TYPE_PRODUCT:
                $new[$value['col_type']][] = $value;
            break;
            case SHOP_TYPE_GALLERY:
                $new[$value['col_type']][] = $value;
            break;
            default:
                $new[$value['col_type']] = $value;
            break;
            }
            
            
        }
        return $new;
    }
    
    //クーポン管理番号
    static public function encodePrintCouponTime(){
        /*
        管理番号
        format sid + お客様番号 + (印刷日時 - ハチワン起業日時)
        sid =1
        客様番号 = 101325
        印刷日時
        2010/11/5
        1288882800

        ・ハチワン起業日時
        2008/7/14
        1215961200
        
        

        1291600265(time) - 1215961200 = 72921600;
        1291600265(time) - 1292338800 = 72921600;

        1-101325-72921600
        */
        return time() - 1215961200;

    }
    
    static public function decodePrintCouponTime($int){
        return $int + 1215961200;
    }
    
    //ログに記録すべきクーポンか比較チェック
    static public function compareCoupon($old,$new){
        if(
            strcasecmp($old['col_discount_value'],$new['discount_value']) == 0 &&
            strcasecmp($old['col_discount_ja'],$new['discount_ja']) == 0 &&
            strcasecmp($old['col_discount_cn'],$new['discount_cn']) == 0 &&
            strcasecmp($old['col_discount_tw'],$new['discount_tw']) == 0 &&
            strcasecmp($old['col_title_ja'],$new['title_ja']) == 0 &&
            strcasecmp($old['col_title_cn'],$new['title_cn']) == 0 &&
            strcasecmp($old['col_title_tw'],$new['title_tw']) == 0 &&
            strcasecmp($old['col_condition_ja'],$new['condition_ja']) == 0 &&
            strcasecmp($old['col_condition_cn'],$new['condition_cn']) == 0 &&
            strcasecmp($old['col_condition_tw'],$new['condition_tw']) == 0 &&
            strcasecmp($old['col_validate_time'],$new['validate_time']) == 0
        ){
            return FALSE;//変更する必要ない
        }
        return TRUE;
    }
    
    //アリペイパラメーター生成
    static public $isCheck = TRUE;
    static public $alipay_param = array
    (
        'trade_no'=>array('must'=>TRUE,'check'=>'int','param'=>0),
        'out_trade_no'=>array('must'=>FALSE,'check'=>'int','param'=>0),
        'total_fee'=>array('must'=>TRUE,'check'=>'int','param'=>0),
        'subject'=>array('must'=>FALSE,'check'=>null,'param'=>''),
        'seller_email'=>array('must'=>FALSE,'check'=>null,'param'=>''),
        'seller_id'=>array('must'=>FALSE,'check'=>'int','param'=>0),
        'buyer_email'=>array('must'=>FALSE,'check'=>null,'param'=>''),
        'buyer_id'=>array('must'=>TRUE,'check'=>'int','param'=>0),
        'trade_status'=>array('must'=>FALSE,'check'=>null,'param'=>''),
        'notify_id'=>array('must'=>FALSE,'check'=>null,'param'=>0),
        'notify_time'=>array('must'=>FALSE,'check'=>null,'param'=>0),
        'notify_type'=>array('must'=>FALSE,'check'=>null,'param'=>''),
        'is_success'=>array('must'=>FALSE,'check'=>null,'param'=>''),
        'body'=>array('must'=>FALSE,'check'=>null,'param'=>''),
        'extra_common'=>array('must'=>FALSE,'check'=>null,'param'=>'')
    );
    static public function makeAlipayParam(){
        foreach (self::$alipay_param as $name => $value){
            if($value['must']){
                if(isset($_GET[$name])){
                    if($value['check'] == 'int'){
                        if(is_numeric($_GET[$name])){
                            self::$alipay_param[$name]['param'] = $_GET[$name];
                        }else{
                            self::$isCheck = FALSE;
                        }
                    }else{
                        self::$alipay_param[$name]['param'] = $_GET[$name];
                    }
                }else{
                    self::$isCheck = FALSE;
                }
            }else{
                if(isset($_GET[$name])){
                    if($value['check'] == 'int'){
                        if(is_numeric($_GET[$name])){
                            self::$alipay_param[$name]['param'] = $_GET[$name];
                        }
                    }else{
                        self::$alipay_param[$name]['param'] = $_GET[$name];
                    }
                }
            }
        }
    }
}
?>