<?php
require_once('fw/define.php');
require_once('fw/database.php');//db
require_once('fw/template.php');//template
require_once('fw/base.php');//template
//require_once('area/logic.php');//area
//require_once('genre/logic.php');//genre
require_once('fw/sessionManager.php');
//require_once('fw/positionManager.php');
class container
{
    public $db = null;
    public $t = null;
    public $base = null;
    
    //public $user = null;
    public $area = null;
    public $genre = null;
    public $isPost = FALSE;
    public $ini;
    public $isDebug = FALSE;
    public $isStage = FALSE;
    public $isAlipay = TRUE;
    public $isMaintenance = FALSE;
    public $isSystem = FALSE;
    public $lastJudge = TRUE;//ロールバックかコミットの判断
    public $session;
    public $csrf;
    //public $pagefullpath;
    public $pagepath;
    public $pagename;
    public $tail_number;
    public $isDocomo = FALSE;
    
    public $isIluna = FALSE;//メンテナンス中の表示
    
    public $analyze_url;
    
    //携帯でfiles配下の画像を表示するための設定。ステージングと本番で設定が異なるため、init処理で設定しています。
    public $url;
    public $m_url;
    public $absolute_path;//相対パスだとm.を見てしまうため、絶対パスとして持っている必要があるため
    
    function __construct($isSimple = FALSE){
        //page set メンテナンスモード除去ページ判定で先に必要
        preg_match('/\/([\D]+)\./i', $_SERVER['SCRIPT_NAME'], $matches);
        $this->pagepath = $matches[1];
        $this->pagename = basename($_SERVER['SCRIPT_NAME'],'.php');

        $cache = $this->pagename == 'input' || $this->pagename == 'login' ? TRUE : FALSE;
        
        $this->t = new template();
        $this->checkIni();
        $this->t->readyTemplate($this->isDebug);
        
        //is system ?
        //$this->isSystem = ereg("^system", $matches[1]);
        $this->isSystem = preg_match("/^system/", $matches[1]) == 1 ? TRUE : FALSE;
        //position include.ロケール変数が必要
        $this->isSystem ? require_once('fw/systemPosition.php') : require_once('fw/commonPosition.php');
        
        if(strcasecmp($_SERVER['REQUEST_METHOD'],'POST') === 0){
            $this->isPost = TRUE;
        }
        
        //以下はシンプルモードでは呼ばない
        if(!$isSimple){
            $this->session = new sessionManager($cache);//セッション開始
            
            $this->db = new database();

            $this->base = new base();
            //$this->area = new areaLogic();
            //$this->genre = new genreLogic();

            //$this->t->assign('area',$this->area->area_info);
            //$this->t->assign('genre',$this->genre->genre_info);
            
            $this->tail_number = time();
            $this->t->assign('tail_number',$this->tail_number);//末尾の数字
        }
    }

    public function checkPostCsrf(){
        require_once('fw/csrf.php');//csrf処理
        $this->csrf = new csrf();
        if($this->isPost){
            //check
            $this->csrf->validateToken(@$_POST['csrf_ticket']);
        }
    }

    public function readyPostCsrf(){
        $this->csrf->getToken();
    }

    private function checkIni(){
        $this->ini = parse_ini_file(SETTING_INI, true);
        
        if($this->ini['common']['isDebug'] == 0){//本番
            $this->isDebug = FALSE;
            
            //analyze用URL
            $this->analyze_url = 'http://www.jp-now.com/analyze.php';
            //$this->t->assign('analyze_url','http://www.jp-now.com/analyze.php');
            
            if($this->ini['common']['isStage'] == 1){//ステージングサーバモード
                $this->isStage = TRUE;

                //analyze用URL
                $this->analyze_url = 'http://jp-now.813.co.jp/analyze.php';
                //$this->t->assign('analyze_url','http://jp-now.813.co.jp/analyze.php');

                define('SERVER_NAME',      'china-adviser.813.co.jp');
                $this->t->assign('stage',$this->isStage);
            }else{
                define('SERVER_NAME',      'www.china-adviser.com');
            }
        }elseif($this->ini['common']['isDebug'] == 1){//デバッグモード
            $this->isDebug = TRUE;

            //analyze用URL
            $this->analyze_url = 'http://china-adviser.apollon.corp.813.co.jp/analyze.php';
            //$this->t->assign('analyze_url','http://china-adviser.apollon.corp.813.co.jp/analyze.php');
            //$this->t->assign('analyze_url','http://china-adviser.813.co.jp/analyze.php');

            if($this->ini['common']['isStage'] == 1){//ステージングサーバモード
                $this->isStage = TRUE;

                //analyze用URL
                $this->analyze_url = 'http://jp-now.813.co.jp/analyze.php';
                //$this->t->assign('analyze_url','http://jp-now.813.co.jp/analyze.php');

                define('SERVER_NAME',      'china-adviser.813.co.jp');
                $this->t->assign('stage',$this->isStage);
            }else{
                define('SERVER_NAME',      'china-adviser.apollon.corp.813.co.jp');
            }
        }
        define('ADVISERURL',            'http://'.$_SERVER['SERVER_NAME']);
        define('ADVISERURLSSL',         'https://'.$_SERVER['SERVER_NAME']);

        //メンテナンスモード
        if($this->ini['common']['isMaintenance'] == 1){
            //ilunaはOK
            if($this->ini['common']['isStage'] == 1){//ステージングサーバモード
                $ip = '192.168.0.52';
            }
            
            if($this->ini['common']['isDebug'] == 0){//本番
                $ip = '210.189.109.177';
            }
            
            if(!isset($_SERVER['REMOTE_ADDR']) || !isset($ip) || strcasecmp($_SERVER['REMOTE_ADDR'],$ip) != 0){
                if(strstr($this->pagepath,'payment') !== FALSE && ($this->pagename == 'return_url' || $this->pagename == 'return_url_test' || $this->pagename == 'notify_url' || $this->pagename == 'finish' || $this->pagename == 'error' || $this->pagename == 'alipay')){
                    //このページは処理を続ける
                    $this->isMaintenance = TRUE;
                    $this->t->assign('maintenance',$this->isMaintenance);
                }else{
                    header( "HTTP/1.1 302 Moved Temporarily" );
                    header("Location: ".ADVISERURL.'/maintenance');
                    die();
                }
            }
        }
        $this->t->assign('debug',$this->isDebug);
    }

    public function safeExitRedraw(){
        if($this->lastJudge) $this->db->commit();
        header("Location: ".$_SERVER['REQUEST_URI']);
        die();
    }

    public function safeExitRedirect($page,$isSSL = FALSE){
        if($this->lastJudge) $this->db->commit();
        //$isSSL ? header("Location: ".ADVISERURLSSL.$page) : header("Location: ".ADVISERURL.$page);
        header("Location: ".ADVISERURL.$page);
        die();
    }

    public function safeExit(){
        if($this->lastJudge) $this->db->commit();
    }

    //no commit
    public function errorExitRedirect($page,$isSSL = FALSE){
        //header( "HTTP/1.1 301 Moved Permanently" );
        $isSSL ? header("Location: ".ADVISERURLSSL."/".$page) : header("Location: ".ADVISERURL."/".$page);
        die();
    }

    public function append($page = null){
        positionManager::setSitePosition();
        // display it
        is_null($page) ? $this->t->display($this->pagepath.'.tpl') : $this->t->display($page.'.tpl');
    }

    //リダイレクト用
    function redraw($url = ADVISERURL,$isPCURL = FALSE){
        if($this->lastJudge) $this->db->commit();
        header("Location: ".$url.$_SERVER['REQUEST_URI']);
        die();
    }
}
?>