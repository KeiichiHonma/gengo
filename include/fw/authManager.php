<?php
define('SECRET_KEY',                 'ILUNAKEY');

//user
define('SESSION_U_LOGIN',            'GENGOULOGIN');
define('SESSION_U_HASH',             'GENGOUHASH');
define('SESSION_U_UID',              'GENGOUUID');
define('SESSION_U_GIVEN_NAME',       'GENGOUNAME');
define('SESSION_U_CUSTOMER_NO',      'GENGOUCUSTOMERNO');
define('SESSION_U_VALIDATE_TIME',    'GENGOUVALIDATETIME');

//manager
define('SESSION_M_LOGIN',            'GENGOMLOGIN');
define('SESSION_M_HASH',             'GENGOMHASH');
define('SESSION_M_MID',              'GENGOMMID');
define('SESSION_M_GIVEN_NAME',       'GENGOMNAME');
define('SESSION_M_TYPE',             'GENGOMTYPE');
define('SESSION_M_SID',              'GENGOMSID');

class authManager
{
    //session key
    public $session_key_login_name;
    public $session_key_login_hash;
    public $session_key_login_type;
    public $session_key_oid;//uid or mid
    public $session_key_given_name;
    public $session_key_customer_no;
    public $session_key_validate_time;
    
    //以下認証後のみセットされる
    //user
    public $account;
    public $uid;
    public $given_name;
    public $customer_no;
    public $validate_time;
    
    //manager
    public $mid;
    public $sid;
    public $manager;
    public $manager_type;
    
    function __construct($isUser = TRUE){
        if($isUser){
            $this->session_key_login_name       = SESSION_U_LOGIN;//account
            $this->session_key_login_hash       = SESSION_U_HASH;
            $this->session_key_oid              = SESSION_U_UID;//uid
            $this->session_key_given_name       = SESSION_U_GIVEN_NAME;//given_name
            $this->session_key_customer_no      = SESSION_U_CUSTOMER_NO;
            $this->session_key_validate_time    = SESSION_U_VALIDATE_TIME;
        }else{
            $this->session_key_login_name       = SESSION_M_LOGIN;//mail
            $this->session_key_login_hash       = SESSION_M_HASH;
            $this->session_key_oid              = SESSION_M_MID;
            $this->session_key_given_name       = SESSION_M_GIVEN_NAME;
            $this->session_key_login_type       = SESSION_M_TYPE;
            $this->session_key_sid              = SESSION_M_SID;
        }
    }

    public function makeHash($login_name){
        return md5($login_name.SECRET_KEY);
    }

    public function validatePassword( $password, $salt, $hash )
    {
        return (strcasecmp(sha1($salt.$password), $hash) === 0);
    }

    //------------------------------------------------------
    // セッションベースログインチェック
    //------------------------------------------------------
    protected function isLogin() {
/*var_dump($_SESSION);
die();*/
        global $con;
        if($con->session->get($this->session_key_login_name) !== FALSE && $con->session->get($this->session_key_login_hash) !== FALSE){
            return strcasecmp($con->session->get($this->session_key_login_hash),self::makeHash($con->session->get($this->session_key_login_name))) == 0 ? TRUE : FALSE;
        }else{
            return FALSE;
        }
    }

    public function validateLogin(){
        if(!auth::isLogin()){
            global $con;
            $con->base->redirectPage('login');
        }
    }
    
    //------------------------------------------------------
    // ログイン情報セット
    //------------------------------------------------------

    public function setLogin($login_object){
        global $con;
        //common
        $con->session->set($this->session_key_oid,$login_object[0]['_id']);
        $con->session->set($this->session_key_given_name,$login_object[0]['col_given_name']);
        
        //manager
        if(isset($login_object[0]['col_type'])){
            $con->session->set($this->session_key_login_type,$login_object[0]['col_type']);
            $con->session->set($this->session_key_login_name,$login_object[0]['col_mail']);
            $con->session->set($this->session_key_login_hash,self::makeHash($login_object[0]['col_mail']));
        //user
        }else{
        }
        
    }
    public function unsetLogin(){
        if (isset($_COOKIE[GENGO_SESSION_NAME])) {
            setcookie(GENGO_SESSION_NAME, '', time() - 1800, '/');
        }
        $_SESSION = array();
        session_destroy();
    }

    //------------------------------------------------------
    // ログイン変数セット
    //------------------------------------------------------

    public function readyUser()
    {
        global $con;
        $this->uid = $con->session->get(SESSION_U_UID);
        $this->account = $con->session->get(SESSION_U_LOGIN);
        $this->given_name = $con->session->get(SESSION_U_GIVEN_NAME);
        $this->customer_no = $con->session->get(SESSION_U_CUSTOMER_NO);
        $this->validate_time = $con->session->get(SESSION_U_VALIDATE_TIME);

        $con->t->assign('login_uid',$this->uid);
        $con->t->assign('login_account',$this->account);
        $con->t->assign('login_given_name',$this->given_name);
        $con->t->assign('login_customer_no',$this->customer_no);
        $con->t->assign('login_validate_time',$this->validate_time);
        
        //変数を取得できなかったログインを認めない=セッション、クッキー必須
        return !$this->uid || !$this->account || !$this->given_name || !$this->customer_no || !$this->validate_time ? FALSE : TRUE;
    }

    public function readyManager()
    {
        global $con;
        $this->mid = $con->session->get(SESSION_M_MID);
        $this->manager = $con->session->get(SESSION_M_GIVEN_NAME);
        $this->manager_type = $con->session->get(SESSION_M_TYPE);
        $con->t->assign('login_mid',$this->mid);
        $con->t->assign('login_manager',$this->manager);
        $con->t->assign('login_type',$this->manager_type);
        if(strcasecmp($this->manager_type,TYPE_M_SHOP) == 0 || strcasecmp($this->manager_type,TYPE_M_ADMIN) == 0){
            $this->sid = $con->session->get(SESSION_M_SID);
            $con->t->assign('sid',$this->sid);
        }
        return !$this->mid || !$this->manager ? FALSE : TRUE;
    }

}
?>