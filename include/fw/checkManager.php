<?php
define('WIDTH_HEIGHT_EQUAL',  0);//横幅、縦幅一致
define('WIDTH_HEIGHT_WITHIN',  1);//横幅、縦幅以内
define('WIDTH_EQUAL_HEIGHT_WITHIN',  2);//横幅一致、縦幅以内
define('WIDTH_WITHIN_HEIGHT_EQUAL',  3);//横幅以内、縦幅一致
define('WIDTH_HEIGHT_OVER',          4);//横幅、縦幅以上

class checkManager
{
    
    static public $error = array();
    static private $stop = FALSE;
    static private $deny_word = null;
    
    static public function safeExit(){
        if(count(self::$error) > 0){
            global $con;
            $con->t->assign('error',self::$error);
            return FALSE;
        }else{
            return TRUE;
        }
    }

    static protected function checkMust($param,$arg){
        if(!isset($param)){
            return FALSE;
        }else{
            if(is_array($param)){
                if(count($param) == 0) return FALSE;
                
            }else{
                if(strlen($param) == 0) return FALSE;
            }
        }
        return TRUE;
    }

    static protected function checkEigo($param,$arg){
        if(!isset($param)){
            return FALSE;
        }else{
            if(preg_match("/^[a-zA-Z\s　]+$/", $param)){
                return TRUE;
            }
        }
        return FALSE;
    }

    static protected function checkKana($param,$arg){
        mb_regex_encoding("UTF-8");
        if(mb_ereg("^[ァ-ヶー－―]+$", $param)){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    static protected function checkInt($param,$arg){
        if($param == '') return TRUE;
        if(is_numeric($param)){
            if(!is_null($arg)){
                if($arg['start'] <= $param && $arg['end'] >= $param){
                    return TRUE;
                }
            }else{
                return TRUE;
            }
        }
        return FALSE;
    }

    static protected function checkEigoInt($param,$arg){
        if(!isset($param)){
            return FALSE;
        }else{
            if(preg_match("/^[0-9a-zA-Z\s　]+$/", $param)){
                return TRUE;
            }
        }
        return FALSE;
    }

    static protected function checkSkypeName($param,$arg){
        if(!isset($param)){
            return FALSE;
        }else{
            if (preg_match("/^[a-zA-Z0-9,.-_]{6,32}$/", $param)) {
                return TRUE;
            }
        }
        return FALSE;
    }

    static protected function checkDate($param,$arg){
        if(is_null($param)) return TRUE;//nullだったらOK
        //現在時間でチェック
        if(is_null($arg)){
            $time = time();
            $date = mktime(date("H",$time), 0, 0, date("m",$time),date("d",$time),date("Y",$time));
        //指定時間でチェック
        }else{
            $date = $arg;
        }
        
        return $param <= $date ? FALSE : TRUE;
    }

    //有効期限エラー
    static protected function checkReportDate($param,$arg){
        if(is_null($param)) return TRUE;//nullだったらOK

        $now = time();
        $now_year = date("Y",$now);
        $now_month = date("m",$now);
        $now_day = date("d",$now);
        
        $validate_year = date("Y",$param);
        $validate_month = date("m",$param);
        $validate_day = date("d",$param);

        $ng_time = mktime(23, 59, 59, $now_month,$now_day,$now_year);

        if($now_year == $validate_year && $now_month == $validate_month && $now_day == $validate_day){
            //当日NG
            return FALSE;
        }elseif($param <= $ng_time){
            //前日より前NG
            return FALSE;
        }else{
            return TRUE;
        }
    }

    //今日の日付のまま、時間等指定せずに登録ボタンを押した場合のエラー
    static protected function checkTodayDateBlank($param,$arg){
        //今日
        if(date("Y",$_POST['from']) == date("Y",time()) && date("n",$_POST['from']) == date("n",time()) && date("j",$_POST['from']) == date("j",time())){
            if(date("H",$_POST['from']) == '00' && date("i",$_POST['from']) == '00' && date("H",$_POST['to']) == '23' && date("i",$_POST['to']) == '59'){
                //画面に0時00分等を表示させない
                unset($_POST['from']);
                unset($_POST['to']);
                return FALSE;
            }
        }
        return TRUE;
    }


    static protected function checkDateInt($param,$arg){
        if(is_null($param)) return TRUE;//時刻のnullには意味がある
        if(is_numeric($param)){
            return TRUE;
        }
        return FALSE;
    }

    static protected function checkDateEnd($param,$arg){
        if((!isset($_POST['from']) || is_null($_POST['from'])) && !is_null($param)) return FALSE;
        if(is_null($param)) return TRUE;//終了がnullだったらOK
        
        return $param <= $_POST['from'] ? FALSE : TRUE;
    }

    static protected function checkLength($param,$arg){
        if(strlen($param) == 0) return TRUE;//必須ではない
        $string = str_replace(array("\r\n","\n","\r"), '', $param);//改行除去.除去しないと正確な文字数が取れない
        global $con;
        //$int = mb_strlen($string);
        $int = strlen($con->base->convertSpecial($string));
        return $int >= $arg['start'] && $int <= $arg['end'] ? TRUE : FALSE;
    }

    static protected function checkPassword($param,$arg){
        if(preg_match("/^[a-zA-Z0-9]+$/", $param)){
            return TRUE;
        } else {
          return FALSE;
        }
    }

    static protected function checkValidatePassword($param,$arg){
        if(strcasecmp($_POST[$arg['key']],$param) == 0) return FALSE;
        $tmp = explode('@',$_POST[$arg['key']]);

        if(strcasecmp($tmp[0],$param) == 0) return FALSE;
        return TRUE;
    }

    static protected function checkUserLogin($param,$arg){
        global $user_auth;
        require_once('user/logic.php');
        $logic = new userLogic();
        $user = $logic->getUser($user_auth->mid,ALL);

        require_once('fw/authManager.php');
        $authManager = new authManager();
        $bl = $authManager->validatePassword( $_POST[$arg['old_password']], $user[0]['col_salt'], $user[0]['col_password'] );

        return $bl;
    }

    static protected function checkManagerLogin($param,$arg){
        require_once('manager/logic.php');
        $logic = new managerLogic();
        $manager = $logic->getManager($_POST[$arg['uid']],ALL);

        require_once('fw/authManager.php');
        $authManager = new authManager();
        $bl = $authManager->validatePassword( $_POST[$arg['old_password']], $manager[0]['col_salt'], $manager[0]['col_password'] );

        return $bl;
    }

    static protected function checkMail($mailaddress,$arg)
    {
        if(strlen($mailaddress) == 0) return TRUE;//must処理が通っている前提。必須項目ではない場合、OKとする
        $email_pattern = '([a-zA-Z0-9!#$%&\'*+\\-/=^_`{|}~]+([a-zA-Z0-9!#$%&\'*+\\-/=^_`{|}~\\.]+)*@[a-zA-Z0-9!#$%&\'*+\\-/=^_`{|}~]+(\\.[a-zA-Z0-9!#$%&\'*+\\-/=^_`{|}~]+)*)';
        if (preg_match($email_pattern,$mailaddress)) {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    //逆チェック。携帯のアドレスは@とかが含まれている場合、エラーとする
/*    static protected function checkMailReverse($mailaddress,$arg)
    {
        if(strlen($mailaddress) == 0) return TRUE;//must処理が通っている前提。必須項目ではない場合、OKとする
        $email_pattern = '([a-zA-Z0-9!#$%&\'*+\\-/=^_`{|}~]+(\\.[a-zA-Z0-9!#$%&\'*+\\-/=^_`{|}~]+)*@[a-zA-Z0-9!#$%&\'*+\\-/=^_`{|}~]+(\\.[a-zA-Z0-9!#$%&\'*+\\-/=^_`{|}~]+)*)';
        if (preg_match($email_pattern,$mailaddress)) {
            return FALSE;
        }else{
            return TRUE;
        }
    }*/

    //携帯のアドレスに@を含めることができない。且つ、@が記載される可能性が高いため、独立してチェック
    static protected function checkAtmark($mailaddress,$arg)
    {
        if(strlen($mailaddress) == 0) return TRUE;//must処理が通っている前提。必須項目ではない場合、OKとする
        return strrchr($mailaddress,'@') !== FALSE ? FALSE : TRUE;
    }

    //携帯アドレスの前の文字列だけチェック
    static protected function checkHeadMail($mailaddress,$arg)
    {
        if(strlen($mailaddress) == 0) return TRUE;//must処理が通っている前提。必須項目ではない場合、OKとする
        //@より前をチェックしたいため、キャリアの指定、未指定に依存しないために、dummyを付与する
        $mail = $mailaddress.'@dummy.co.jp';//チェック用にdummyをぶち込む
        return self::checkMail($mail,null);
    }

    //異なっていたらFALSE
    static protected function checkMatch($param,$arg){
        return strcasecmp($param,$_POST[$arg['key']]) == 0 ? TRUE : FALSE;
    }

    static protected function checkUserDuplication($param,$arg){
        require_once('user/logic.php');
        $logic = new userLogic();
        if(!is_null($arg)){
           //現行アドレスのチェック
            //現行のアドレスと同じだったらノーチェックでOK
            if(isset($arg['mail_current']) && isset($_POST[$arg['mail_current']]) && strcasecmp($param,$_POST[$arg['mail_current']]) == 0) return TRUE;
            $user = $logic->isLoginName($param);
        }else{
            $user = $logic->isLoginName($param);
        }
        return $user === FALSE ? TRUE : FALSE;
    }

    static protected function checkUserDirectoryDuplication($param,$arg){
        if(is_dir(WGET_DIR.'/'.$param) || is_dir(SHELL_DIR.'/'.$param)){
            return FALSE;
        }
        return TRUE;
    }

    static protected function checkManagerDuplication($param,$arg){
        require_once('manager/logic.php');
        $logic = new managerLogic();
        $manager = $logic->getRowLoginName($param);
        return $manager === FALSE ? TRUE : FALSE;
    }

    //URL
    static protected function checkUrl($param,$arg){
        $url_pattern = '(https?://[a-zA-Z0-9/_.?#&;=$+:@%~,\\-]+)';
        if (preg_match($url_pattern,$param)) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    //URLだったらNG
    static protected function checkUrlReverse($param,$arg){
        $url_pattern = '(https?://[a-zA-Z0-9/_.?#&;=$+:@%~,\\-]+)';
        if (preg_match($url_pattern,$param)) {
            return FALSE;
        }else{
            return TRUE;
        }
    }

    //ドメイン
    static protected function checkDomain($param,$arg){
        $url_pattern = '/^(.+?)(.co.jp|.com|.jp|.net|.co|.org|.info|.me|.so|.jpn.com)$/';
        if (preg_match($url_pattern,$param)) {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    //NGワード
    static protected function checkDenyWord($param,$arg){
        global $ng_pattern;
        if(!isset($ng_pattern)){
            require_once('fw/denyWord.php');//なぜか動作しない
        }
        $n = count($ng_pattern);
        for($i = 0; $i < $n ; $i++){
            $deny_flag = preg_match('('.$ng_pattern[$i].')',$param,$match);
            if( $deny_flag != 0){
                self::$deny_word = $match[0];
                self::$extends .= '「'.self::$deny_word.'」';
                //メール送信///////////////////////////
                require_once('fw/mailManager.php');
                $mailManager = new mailManager();
                $mailManager->sendDenyWord(self::$deny_word);
                return FALSE;
            }
        }

        return TRUE;
    }

    /*define('STATUS_STOP',  0);
    define('STATUS_READY',  1);
    define('STATUS_PUBLIC',  2);
    define('STATUS_FINISH',  3);*/
    //チェックがかかるのはSTATUS_STOPかSTATUS_PUBLICだけ
    static protected function checkStatus($param,$arg){
        return is_numeric($param) && $param == STATUS_STOP || $param == STATUS_PUBLIC ? TRUE : FALSE;
    }

    static protected function checkUseful($param,$arg){
        return is_numeric($param) && $param == USEFUL_OFF || $param == USEFUL_ON ? TRUE : FALSE;
    }

    //file系
    static public $file_upload = FALSE;
    static public function checkFileReady($param,$arg){
        if(is_uploaded_file($param['tmp_name'])){
            self::$file_upload = TRUE;
        }
        return TRUE;
    }
    
    static private $file_must = FALSE;
    static public function checkFileMust($param,$arg_fid_key){
        self::$file_must = TRUE;
        if(isset($_POST[$arg_fid_key]) && is_numeric($_POST[$arg_fid_key])) return TRUE;//fidがある場合はファイルが既に存在しているため,エラー扱いしない
        return strcasecmp($param['error'],4) == 0 ? FALSE : TRUE;
    }
    
    //基本チェック。必須チェックがある場合は先にそっちが実行される
    static public function checkFileBase($param,$arg_post_key){
        if(self::$file_upload){
            $end = self::$file_must ? 5 : 4;//mustを飛ばす
            for ($i=1;$i<$end;$i++){
                if(strcasecmp($param['error'],$i) == 0){
                    self::setError($arg_post_key,constant(constant('E_SYSTEM_FILE_'.$i)));
                }else{
                    return TRUE;
                }
            }
        }
        return TRUE;
    }

    //5M
    static public function checkFileSize($param,$arg_size){
        if(self::$file_upload){
            return filesize($param['tmp_name']) > $arg_size ? FALSE : TRUE;
        }
        return TRUE;
    }
    
    /*define('WIDTH_HEIGHT_EQUAL',  0);//横幅、縦幅一致
    define('WIDTH_HEIGHT_WITHIN',  1);//横幅、縦幅以内
    define('WIDTH_EQUAL_HEIGHT_WITHIN',  2);//横幅一致、縦幅以内
    define('WIDTH_WITHIN_HEIGHT_EQUAL',  3);//横幅以内、縦幅一致*/
    static public function checkFileImageSize($param,$arg_image_size = array('type'=>WIDTH_HEIGHT_EQUAL,'width'=>'0','height'=>'0')){
        if(self::$file_upload){
            $ary_image_size = getimagesize($param['tmp_name']);
            switch ($arg_image_size['type']){
                case WIDTH_HEIGHT_EQUAL:
                    return $ary_image_size['0'] == $arg_image_size['width'] && $ary_image_size['1'] == $arg_image_size['height'] ? TRUE : FALSE;
                break;
                case WIDTH_HEIGHT_WITHIN:
                    return $ary_image_size['0'] <= $arg_image_size['width'] && $ary_image_size['1'] <= $arg_image_size['height'] ? TRUE : FALSE;
                break;
                case WIDTH_EQUAL_HEIGHT_WITHIN:
                    return $ary_image_size['0'] == $arg_image_size['width'] && $ary_image_size['1'] <= $arg_image_size['height'] ? TRUE : FALSE;
                break;
                case WIDTH_WITHIN_HEIGHT_EQUAL:
                    return $ary_image_size['0'] <= $arg_image_size['width'] && $ary_image_size['1'] == $arg_image_size['height'] ? TRUE : FALSE;
                break;
                case WIDTH_HEIGHT_OVER:
                    return $ary_image_size['0'] >= $arg_image_size['width'] && $ary_image_size['1'] >= $arg_image_size['height'] ? TRUE : FALSE;
                break;
                default:
                    return FALSE;
                break;
            }
        }
        return TRUE;
    }

    static public function checkFileType($param,$arg_type){
        if(self::$file_upload){
            $ext = strtolower(substr($param['name'],-3));
            if(is_array($arg_type)){
                return in_array($ext,$arg_type) ? TRUE : FALSE;
            }else{
                return strcasecmp($ext,$arg_type) == 0 ? TRUE : FALSE;
            }
        }
        return TRUE;
    }

    //date seminar check special/////////////////////////////////////////////
    //管理の選択
    static protected function checkOwner($param,$arg){
        if(strcasecmp($param,'honbu_radio') == 0){
            return TRUE;
        }elseif(strcasecmp($param,'hub_radio') == 0){
            return TRUE;
        }
        return FALSE;
    }

    //本部管理の必須チェック
    static protected function checkHonbuMust($param,$arg){
        return strcasecmp($_POST['owner'],'honbu_radio') == 0 ? self::checkMust($param,$arg) : TRUE;
    }

    //本部管理の数値チェック
    static protected function checkHonbuInt($param,$arg){
        return strcasecmp($_POST['owner'],'honbu_radio') == 0 ? self::checkInt($param,$arg) : TRUE;
    }

    //開催校管理の必須チェック
    static protected function checkHubMust($param,$arg){
        return strcasecmp($_POST['owner'],'hub_radio') == 0 ? self::checkMust($param,$arg) : TRUE;
    }

    //開催校管理の数値チェック
    static protected function checkHubInt($param,$arg){
        return strcasecmp($_POST['owner'],'hub_radio') == 0 ? self::checkInt($param,$arg) : TRUE;
    }

    //開催校管理、場所が開催校ではない場合の必須チェック
    static protected function checkHubLocationMust($param,$arg){
        return strcasecmp($_POST['owner'],'hub_radio') == 0 && isset($_POST['hub_location_check']) && strcasecmp($_POST['hub_location_check'],'hub_location_check') == 0 ? self::checkMust($param,$arg) : TRUE;
    }

    //開催校管理、場所が開催校ではない場合の数値チェック
    static protected function checkHubLocationInt($param,$arg){
        return strcasecmp($_POST['owner'],'hub_radio') == 0 && isset($_POST['hub_location_check']) && strcasecmp($_POST['hub_location_check'],'hub_location_check') == 0 ? self::checkInt($param,$arg) : TRUE;
    }
    ///////////////////////////////////////////////////////////////////////


    static public function replaceTab($param,$arg){
        $_POST[$arg] = str_replace(array("\t"),' ', $_POST[$arg]);//半角スペースに変換
        return TRUE;
    }

    //重要な関数
    //全ての入力系のものから使用不可とする文字列を除去、又は変換する関数
    /*mb_convert_kana()の一覧

    以下では、オプションの解説をしています。
    なお、オプションを指定しない場合、
    "KV"(「半角ｶﾀｶﾅ」を「全角カタカナ」に変換し、かつ、
    濁点付きの文字を一文字に変換するよう)になっています。

    r : 「全角」英字を「半角(ﾊﾝｶｸ)」に変換
    R : 「半角(ﾊﾝｶｸ)」英字を「全角」に変換
    n : 「全角」数字を「半角(ﾊﾝｶｸ)」に変換
    N : 「半角(ﾊﾝｶｸ)」数字を「全角」に変換
    a : 「全角」英数字を「半角(ﾊﾝｶｸ)」に変換
    A : 「半角(ﾊﾝｶｸ)」英数字を「全角」に変換
    s : 「全角」スペースを「半角(ﾊﾝｶｸ)」に変換
    S : 「半角(ﾊﾝｶｸ)」スペースを「全角」に変換
    k : 「全角片仮名」を「半角(ﾊﾝｶｸ)片仮名」に変換
    K : 「半角(ﾊﾝｶｸ)片仮名」を「全角片仮名」に変換
    h : 「全角ひら仮名」を「半角(ﾊﾝｶｸ)片仮名」に変換
    H : 「半角(ﾊﾝｶｸ)片仮名」を「全角ひら仮名」に変換
    c : 「全角かた仮名」を「全角ひら仮名」に変換
    C : 「全角ひら仮名」を「全角かた仮名」に変換
    V : 濁点付きの文字を一文字に変換。"K","H"と共に使用します。*/

    static public function replaceInput($param,$arg){
        $s = $_POST[$arg];
        //$s = mb_convert_kana( $s, "KV" ,'UTF-8');//全角片仮名に
        //タブ文字
        $s = trim(str_replace(array("\t","　"),' ',$s));//タブ、全角スペースを半角スペースに変換してトリム
        $_POST[$arg] = $s;
        return TRUE;
    }
    
    static protected $extends = '';
    
    static private function setError($post_key,$message){
        self::$error[$post_key] = $message.self::$extends;
        self::$stop = TRUE;//エラーがある場合は自動的にstop
    }

    static private function setLoopError($post_key,$number,$message){
        self::$error[$post_key][$number] = $message;
        self::$stop = TRUE;//エラーがある場合は自動的にstop
    }

    static protected function checkError($check_list){
        foreach($check_list as $post_key => $check){
            self::$stop = FALSE;
            if(isset($_POST[$post_key]) && !is_array($_POST[$post_key])) $_POST[$post_key] = trim($_POST[$post_key]);//trim
            foreach($check as $array){
                self::$extends  = '';
                if(isset($array['is_file']) && $array['is_file']){
                    if(!self::$stop && !call_user_func(array('checkManager',$array['func']),@$_FILES[$post_key],$array['arg'])){
                        self::setError($post_key,$array['message']);
                    }
                }else{
                    if(!self::$stop && !call_user_func(array('checkManager',$array['func']),@$_POST[$post_key],$array['arg'])){
                    //if(!isset($_POST[$post_key]) || !self::$stop && !call_user_func(array('checkManager',$array['func']),$_POST[$post_key],$array['arg'])){
                        self::setError($post_key,$array['message']);
                    }
                }
            }
        }
    }

    static protected function checkLoopError($check_list){
        foreach($check_list as $post_key => $check){
            if(isset($_POST[$post_key]) && is_array($_POST[$post_key])){
                foreach ($_POST[$post_key] as $number => $value){
                    self::$stop = FALSE;
                    foreach($check as $array){
                        if(!self::$stop && !call_user_func(array('checkManager',$array['func']),$value,$array['arg'])){
                            self::setLoopError($post_key,$number,$array['message']);
                        }
                    }
                }
                
            }
        }
    }
}
?>