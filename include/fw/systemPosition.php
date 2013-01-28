<?php
require_once('fw/positionManager.php');
class systemPosition extends positionManager
{
    static protected $page = array
    (
    'index'=>array('name'=>'サイトトップ','func'=>null,'ssl'=>FALSE,'gnavi'=>'index','snavi'=>null),
    'system'=>array
        (
        'index'=>array('name'=>'管理画面トップ','func'=>null,'access'=>TYPE_M_ADMIN,'ssl'=>TRUE,'gnavi'=>null,'snavi'=>'index'),
        'login'=>array('name'=>'管理画面トップ','func'=>null,'access'=>TYPE_M_ADMIN,'ssl'=>TRUE,'gnavi'=>null,'snavi'=>'index'),
        'logout'=>array('name'=>'管理画面トップ','func'=>null,'access'=>TYPE_M_ADMIN,'ssl'=>TRUE,'gnavi'=>null,'snavi'=>'index'),
        'alipay_debug'=>array
            (
            'index'=>array('name'=>'アリペイデバッグ','func'=>null,'access'=>TYPE_M_ADMIN,'ssl'=>TRUE,'gnavi'=>null,'snavi'=>'index'),
            'alipayto'=>array('name'=>'アリペイデバッグ','func'=>null,'access'=>TYPE_M_ADMIN,'ssl'=>TRUE,'gnavi'=>null,'snavi'=>'index')
            ),
        'manager'=>array
            (
            'index'=>array('name'=>'マネージャー管理','func'=>null,'access'=>TYPE_M_ADMIN,'ssl'=>TRUE,'gnavi'=>null,'snavi'=>'manager'),
            'view'=>array('name'=>'マネージャー詳細','func'=>null,'access'=>TYPE_M_ADMIN,'ssl'=>TRUE,'gnavi'=>null,'snavi'=>'manager'),
            'entry'=>array
                (
                'input'=>array('name'=>'マネージャー追加','func'=>null,'access'=>TYPE_M_ADMIN,'ssl'=>TRUE,'gnavi'=>null,'snavi'=>'manager')
                ),
            'edit'=>array
                (
                'input'=>array('name'=>'マネージャー変更','func'=>null,'access'=>TYPE_M_ADMIN,'ssl'=>TRUE,'gnavi'=>null,'snavi'=>'manager'),
                'password'=>array
                    (
                    'input'=>array('name'=>'パスワード変更','func'=>null,'access'=>TYPE_M_ADMIN,'ssl'=>TRUE,'gnavi'=>null,'snavi'=>'manager')
                    )
                ),
            'drop'=>array
                (
                'input'=>array('name'=>'マネージャー削除','func'=>null,'access'=>TYPE_M_ADMIN,'ssl'=>TRUE,'gnavi'=>null,'snavi'=>'manager')
                )
            ),
        'user'=>array
            (
            'index'=>array('name'=>'ユーザー管理','func'=>null,'access'=>TYPE_M_ADMIN,'ssl'=>TRUE,'gnavi'=>null,'snavi'=>'user'),
            'view'=>array('name'=>'ユーザー詳細','func'=>null,'access'=>TYPE_M_ADMIN,'ssl'=>TRUE,'gnavi'=>null,'snavi'=>'user'),
            'entry'=>array
                (
                'input'=>array('name'=>'ユーザー追加','func'=>null,'access'=>TYPE_M_ADMIN,'ssl'=>TRUE,'gnavi'=>null,'snavi'=>'user'),
                ),
            'edit'=>array
                (
                'input'=>array('name'=>'ユーザー変更','func'=>null,'access'=>TYPE_M_ADMIN,'ssl'=>TRUE,'gnavi'=>null,'snavi'=>'user'),
                'finish'=>array('name'=>'ユーザー再発行完了','func'=>null,'access'=>TYPE_M_ADMIN,'ssl'=>TRUE,'gnavi'=>null,'snavi'=>'user'),
                ),
            ),
        'seo'=>array
            (
            'index'=>array('name'=>'SEO管理','func'=>null,'access'=>TYPE_M_ADMIN,'ssl'=>TRUE,'gnavi'=>null,'snavi'=>'user'),
            'view'=>array('name'=>'SEO詳細','func'=>null,'access'=>TYPE_M_ADMIN,'ssl'=>TRUE,'gnavi'=>null,'snavi'=>'user'),
            'entry'=>array
                (
                'input'=>array('name'=>'SEO追加','func'=>null,'access'=>TYPE_M_ADMIN,'ssl'=>TRUE,'gnavi'=>null,'snavi'=>'user'),
                ),
            'edit'=>array
                (
                'input'=>array('name'=>'SEO変更','func'=>null,'access'=>TYPE_M_ADMIN,'ssl'=>TRUE,'gnavi'=>null,'snavi'=>'user'),
                ),
            'clean'=>array('name'=>'クリーンアップ','func'=>null,'access'=>TYPE_M_ADMIN,'ssl'=>TRUE,'gnavi'=>null,'snavi'=>'user'),
            ),
        )
    );

    static public function makeSitePosition(){
        parent::$page = self::$page;
        parent::makeSitePosition(TRUE);
    }

    static public function makeMessagePosition($msid,$title,$view = TRUE){
        //ユーザー向けのお知らせはお知らせ管理を抜いて作る
        if($view){
            unset(parent::$position[3]);
            parent::$position[2] = parent::makePositionPair('/system/message/view/msid/'.$msid,self::positionTrim($title));
        }else{
            parent::$position[3] = parent::makePositionPair('/system/message/detail/msid/'.$msid,self::positionTrim($title));
        }
        
    }

    static public function makeThirdPosition($url,$title){
        parent::$position[3] = parent::makePositionPair($url,self::positionTrim($title));
    }
    
    static public function makeFourthPosition($url,$title){
        parent::$position[4] = parent::$position[3];
        parent::$position[3] = parent::makePositionPair($url,self::positionTrim($title));
        ksort(parent::$position);
    }

    /*
    店舗用のサイトポジション生成関数
    管理者と学校では画面が異なるため
    ※Admin
    教えてCA！トップ > 管理画面トップ > 学校一覧 > 学校詳細
    ※学校
    教えてCA！トップ > 学校名-管理画面トップ（実際は学校詳細） > 各操作(学校メールアドレス変更等)
    */
    
    static public function makeShopPosition($shop_name,$positions = null){
        global $manager_auth;
        $count = count(parent::$position);

        for ($i=2;$i<$count;$i++){
            if($i > 2 && strcasecmp($manager_auth->manager_type,TYPE_M_MANAGER) == 0) parent::$position[$i-1] = parent::$position[$i];
            if($i == 2){
                parent::$position[$i]['name'] = self::positionTrim($shop_name.parent::$position[$i]['name']);
            }
        }

        ksort(parent::$position);
        
        if(!is_null($positions)){
            $i = $count-2;
            foreach ($positions as $key => $array){
                parent::$position[$i] = parent::makePositionPair($array['url'],self::positionTrim($array['name']));
                $i++;
            }
        }
    }

    static public function makeMessageChildPosition($msid,$title){
        parent::$position[4] = parent::$position[3];
        //question detail
        parent::$position[3] = parent::makePositionPair('/system/message/detail/msid/'.$msid,self::positionTrim($title));
        ksort(parent::$position);
    }

    //アクセス権////////////////////////////////////////
    static function getAccess(){
        parent::$page = self::$page;
        return self::getCurrentValue('access');
    }

    static function getName(){
        parent::$page = self::$page;
        return self::getCurrentValue('name');
    }
}
?>
