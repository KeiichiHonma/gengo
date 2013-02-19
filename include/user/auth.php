<?php
require_once('fw/authManager.php');
class userAuth extends authManager
{
    
    function __construct($isUser = TRUE){
        parent::__construct($isUser);
    }

    private function isAutoCookie(){
        return isset($_COOKIE[$this->coupon_passport]);
    }
    
    //手動ログイン時 - ユーザ名とパスワードを入力してログイン////////////////////////////////////////////////////////
    public function login($login_name,$password){
        //認証開始前にチェック
        require_once('user/check.php');
        checkLogin::checkError();
        if(checkLogin::safeExit()){
            global $con;
            require_once('user/logic.php');//user
            $m_logic = new userLogic();
            $user = $m_logic->getRowLoginName($login_name,ALL);
            if(!$user){
                require_once('fw/error_code.php');
                checkLogin::$error['all'] = constant(E_AUTH_NG);
            }elseif(!$this->validatePassword( $password, $user[0]['col_salt'], $user[0]['col_password'] )){
                require_once('fw/error_code.php');
                checkLogin::$error['all'] = constant(E_AUTH_NG);
            }

            if(checkLogin::safeExit()){
                //認証成功
                $this->setLogin($user);

                $con->safeExitRedirect('/user/',TRUE);
            }
        }
        return FALSE;
    }

    public function loginDebug($login_name){
        global $con;
        require_once('user/logic.php');//user
        $m_logic = new userLogic();
        $user = $m_logic->getRowLoginName($login_name,ALL);
        if(!$user){
            require_once('fw/error_code.php');
            checkLogin::$error['all'] = constant(E_AUTH_NG);
        }
        //認証成功
        $this->setLogin($user);
        $con->safeExitRedirect('/user/',TRUE);
        return FALSE;
    }

    public function logout(){
        $this->unsetLogin();
        global $con;
        $con->safeExitRedirect('/user/login',TRUE);
    }

    //認証チェック
    public function validateLogin(){
        global $con;
        if($con->pagename == 'login'){
            return TRUE;
        }elseif(parent::isLogin()){
            return $this->readyUser();//user変数セット
        }
        return FALSE;
    }
}
?>