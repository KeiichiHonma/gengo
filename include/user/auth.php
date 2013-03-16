<?php
define('SESSION_POSITION',  'POSITION');
define('COOKIE_PASSPORT',          'PASSPORT');
define('COOKIE_PASSPORT_EXPIRE',   7776000);//90日

require_once('fw/authManager.php');
class userAuth extends authManager
{
    
    function __construct($isUser = TRUE){
        parent::__construct($isUser);
    }

    private function isAutoCookie(){
        return isset($_COOKIE[COOKIE_PASSPORT]);
    }
    
    //手動ログイン時 - ユーザ名とパスワードを入力してログイン////////////////////////////////////////////////////////
    public function login($login_name,$password){
        //認証開始前にチェック
        require_once('user/check.php');
        checkLogin::checkError();
        global $con;
        if(checkLogin::safeExit()){
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
                //auto login
                $this->resetPassport($user[0]['_id']);//auto login 設定

                //認証成功
                $this->setLogin($user);
                $con->safeExitRedirect('/user/',TRUE);
            }
        }
        //自動submit対応
        if($_POST['auto_login'] == 1){
            $con->t->assign('is_auto_login',TRUE);
        }
        $con->t->assign('is_auto_login_stop',TRUE);
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

    public function logout($istRedirect = TRUE){
        $this->unsetPassport();
        $this->unsetLogin();
        global $con;
        if($istRedirect) $con->safeExitRedirect('/user/login',TRUE);
    }

    private function autoLogin(){

        if(!$this->isAutoCookie()){
            return FALSE;
        }
        require_once('user/logic.php');
        $logic = new autoLoginLogic();
        $row = $logic->getVaridateRow($_COOKIE[COOKIE_PASSPORT],COOKIE_PASSPORT_EXPIRE);

        if($row === FALSE) return FALSE;//有効なパスポートが存在しない
        //auto login 成功とみなしメンバー情報を取得
        $logic = new userLogic();
        $user = $logic->getUser($row[0]['col_uid']);
        if(!$user) return FALSE;
        $this->resetPassport($row[0]['col_uid']);//リセット
        parent::setLogin($user);
        //最終ログイン時間更新
        //$this->setLastLogin($user[0]['_id']);
        global $con;
        $con->redraw();
    }

    //passportクッキーのセット
    private function setPassport($uid){
        //レコード追加
        require_once('user/handle.php');
        $handle = new autoLoginHandle();
        $handle->addRow($uid);
        setcookie(COOKIE_PASSPORT,$handle->parameter->passport, time() + COOKIE_PASSPORT_EXPIRE,'/' );

    }

    //passportクッキーの削除
    private function unsetPassport(){
        //レコード削除
        require_once('user/handle.php');
        $handle = new autoLoginHandle();
        if($this->isAutoCookie()){
            $handle->deletePassport($_COOKIE[COOKIE_PASSPORT]);
        }
        setcookie(COOKIE_PASSPORT,'',time() - 60);
    }

    //passportクッキーのリセット
    private function resetPassport($uid){
        $this->unsetPassport();
        $this->setPassport($uid);
    }

    //認証チェック
    public function validateLogin(){

        if(!parent::isLogin()){
            //auto login確認
            if(!$this->autoLogin()) return FALSE;
        }
        //return TRUE;
        return $this->readyUser();//user変数セット
    }
    
/*    public function validateLogin(){
        global $con;

        if($con->pagename == 'login'){
            return TRUE;
        }elseif(parent::isLogin()){
            return $this->readyUser();//user変数セット
        }

        if(!parent::isLogin()){
var_dump(123);
die();
            //auto login確認
            if(!$this->autoLogin()) return FALSE;
        }

        //$con->safeExitRedirect('/user/login',TRUE);
        return FALSE;
    }*/
}
?>