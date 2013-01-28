<?php
define('COUPON_SESSION_NAME',  'COUPONSESSID');
class sessionManager
{
    function __construct($cache = FALSE){
        session_name(COUPON_SESSION_NAME);
        session_cache_expire(0);
        $cache ? session_cache_limiter('private_no_expire') : session_cache_limiter('no_cache');
        session_start();
    }
    
    public function set($key,$value){
        $_SESSION[$key] = $value;
    }
    
    public function delete($key){
        unset($_SESSION[$key]);
    }
    
    public function get($key){
        return isset($_SESSION[$key]) ? $_SESSION[$key] : FALSE;
    }
    
}
?>