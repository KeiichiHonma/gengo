<?php
//管理画面アクセス権クラス
require_once('fw/errorManager.php');
class systemAccess extends errorManager
{
    static private function isAccess(){
        $page_access = systemPosition::getAccess();
        if(($page_access = systemPosition::getAccess()) === FALSE) return FALSE;
        global $con;
        $type = $con->session->get(SESSION_M_TYPE);
        switch ($page_access){
            case TYPE_M_SHOP:
                return strcasecmp($type,TYPE_M_ADMIN) == 0 || strcasecmp($type,TYPE_M_SHOP) == 0 ? TRUE : FALSE;
            break;
            default:
                return $type !== FALSE && $type >= $page_access ? TRUE : FALSE;
            break;
        }
    }
    
    static public function checkAccess(){
        global $con;
        if($con->pagename != 'login' && self::isAccess() === FALSE) parent::throwError(E_MANAGER_ACCESS_WRONG);
        return TRUE;
    }

}
class applicationAccess extends errorManager
{
    //shop系///////////////////
    //アクセス可能な店舗アイテムかどうか
    public function isShopItem($siid){
        require_once('shop/logic.php');
        $logic = new shopItemLogic();
        if($logic->checkOwner($siid) === FALSE) parent::throwError(E_SHOP_ACCESS_WRONG);
    }

    public function isShopCoupon($cid){
        require_once('coupon/logic.php');
        $logic = new couponLogic();
        if($logic->checkOwner($cid) === FALSE) parent::throwError(E_COUPON_ACCESS_WRONG);
    }
}
?>