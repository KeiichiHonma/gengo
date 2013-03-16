<?php
require_once('fw/authManager.php');
class managerAuth extends authManager
{
    
    function __construct($isUser = FALSE){
        parent::__construct($isUser);
    }

    private function isAutoCookie(){
        return isset($_COOKIE[$this->coupon_passport]);
    }
    
    //手動ログイン時 - ユーザ名とパスワードを入力してログイン////////////////////////////////////////////////////////
    public function login($login_name,$password){
        //認証開始前にチェック
        require_once('manager/check.php');
        checkLogin::checkError();
        if(checkLogin::safeExit()){
            global $con;
            //require_once('manager/logic.php');
            //$logic = new managerLogic();
            //$manager = $logic->getRowLoginName($login_name,ALL);
            require_once('manager/logic.php');//manager
            $m_logic = new managerLogic();
            $manager = $m_logic->getRowLoginName($login_name,ALL);
            if(!$manager){
                require_once('fw/error_code.php');
                checkLogin::$error['all'] = constant(E_AUTH_NG);
            }elseif(!$this->validatePassword( $password, $manager[0]['col_salt'], $manager[0]['col_password'] )){
                require_once('fw/error_code.php');
                checkLogin::$error['all'] = constant(E_AUTH_NG);
            }

            if(checkLogin::safeExit()){
                //認証成功
                $this->setLogin($manager);
                if(strcasecmp($manager[0]['col_type'],TYPE_M_ADMIN) == 0){
                    $con->safeExitRedirect('/system/user/',TRUE);
                }else{
                    $con->safeExitRedirect('/system/',TRUE);
                }
                
            }
        }
        return FALSE;
    }

    public function logout(){
        $this->unsetLogin();
        global $con;
        $con->safeExitRedirect('/system/login',TRUE);
    }

    //認証チェック
    public function validateLogin(){
        global $con;
        if($con->pagename == 'login'){
            return TRUE;
        }elseif(parent::isLogin()){
            return $this->readyManager();//manager変数セット
        }
        $con->safeExitRedirect('/system/login',TRUE);
        //return FALSE;
    }
}
?>