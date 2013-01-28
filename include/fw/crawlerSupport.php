<?php
include('fw/define.php');
include('fw/simple_html_dom.php');
include('fw/csv.php');
class crawlerSupport
{
    private $user_domain = '';// 最後/なし？
    private $user_fqdn = '';
    private $user_url = '';
    private $user_dir = '';
    private $absolute_user_dir = '';//ユーザーディレクトリへの絶対パス
    private $absolute_under_user_dir = '';//htmlファイルへの絶対パス
    private $finish_image = array();
    private $finish_new_image = array();
    private $finish_image_log = '';
    private $wget_master_log = '';
    private $wget_support_log = '';
    private $wget_pass_log = '';
    private $finish_image_csv_handle = FALSE;
    
    private $handleTagList = array('img','link','script','input','meta','title');
    public $html_files = array();
    private $css_files = array();
    private $html = '';
    private $html_url = '';
    private $css  = '';
    private $img = array();
    private $javascript = array();
    //private $css = array();
    //private $rollover_string = array('_on','on');
    private $rollover_string = null;
    private $replace_html = array();//htmlファイルの中で置換が必要なソースリスト. key => value keyをvalueで変換
    private $icp_html = "\n<span style=\"background:#ffffff;color:#000000;\">北京九五太维资讯有限公司\n京ICP证040867号-3\n京公网安备110105008661号</span>\n";
    
    private $replace_array = null;
    
    private $seo = array();
    
    //test
    private $wget_list = array();
    
    function __construct($user_dir,$user_domain = null,$seo = FALSE,$rollover = null,$replace = null){
        $this->setUserDir($user_dir);
        $this->absolute_user_dir = WGET_DIR.'/'.$this->user_dir;
        $this->finish_image_log = SHELL_DIR.'/'.$this->user_dir.'/'.FINISH_IMAGE_LOG;
        $this->wget_master_log = SHELL_DIR.'/'.$this->user_dir.'/'.WGET_MASTER_LOG;
        $this->wget_support_log = SHELL_DIR.'/'.$this->user_dir.'/'.WGET_SUPPORT_LOG;
        $this->wget_pass_log = SHELL_DIR.'/'.$this->user_dir.'/'.WGET_PASS_LOG;

        if(!is_null($user_domain)){
            $this->setUserDomain($user_domain);
            $this->user_url = 'http://'.$user_domain;
        }
        
        //チェックは個別のココマンドで実施
        if(!is_null($rollover)){
            $this->rollover_string = $rollover;
        }

        if(!is_null($replace)){
            $this->replace_array = $replace;
        }

        //seo情報
        if($seo){
            $this->seo = array
            (
            $seo['col_absolute_html_file']=>array
                (
                'keywords'=>$seo['col_keyword'],
                'description'=>$seo['col_description'],
                'title'=>$seo['col_title']
                )
            );
        }
    }
    
    public function initialize(){
        $this->user_domain = '';
        $this->user_url = '';
        $this->user_dir = '';
        $this->html_files = array();
        $this->css_files = array();
        $this->html = '';
        $this->css  = '';
        $this->img = array();
        $this->javascript = array();
        //$this->css = array();
        $this->replace_html = array();
    }

    public function setUserDomain($user_domain){
        $this->user_domain = $user_domain;
        $url_explode = explode('/',$user_domain);
        if($url_explode !== FALSE){
            $this->user_fqdn = $url_explode[0];
        }else{
            $this->user_fqdn = $user_domain;
        }
        
    }

    public function setUserDir($user_dir){
        $this->user_dir = $user_dir;
    }

    /* ex
      ["/usr/local/apache2/htdocs/china/wget/kujapan/special/group/grid"]=>
      array(3) {
        [0]=>
        string(6) "2.html"
        [1]=>
        string(6) "1.html"
        [2]=>
        string(6) "3.html"
      }
    */
    //ユーザーディレクトリ以下のhtmlファイルをリスト化
/*    private function setUserHtmlFiles(){
        $this->readRecursiveUserDir($this->absolute_user_dir);
    }*/
    
    
    //ユーザーディレクトリ以下のhtmlファイルを再帰的に処理
/*    private function readRecursiveUserDir($absolute_under_user_dir) {
        if ($dirHandle = opendir($absolute_under_user_dir)) {
            while (false !== ($dir_or_file_name = readdir($dirHandle))) {
                if ($dir_or_file_name != '.' && $dir_or_file_name != '..') {
                    $filePath = $absolute_under_user_dir."/".$dir_or_file_name;
                    if (is_dir($filePath)) {
                        $this->readRecursiveUserDir($filePath);
                    }else{
                        if (preg_match( "/^.*.(htm|html)$/i",$dir_or_file_name)){
                            $this->html_files[$absolute_under_user_dir][] = $dir_or_file_name;
                        }
                        if (preg_match( "/^.*.(css)$/i",$dir_or_file_name)){
                            $this->css_files[$absolute_under_user_dir][] = $dir_or_file_name;
                        }
                    }
                }
            }
            closedir($dirHandle);
        }
    }*/
    
    public function doCrawlerSupport($absolute_under_user_dir,$html_file){
        //ロールオーバー画像get準備
        if(!is_null($this->rollover_string)){
            //get終了リスト
/*            if(file_exists($this->finish_image_log)){
                //古いリストかチェック
                $finfo = stat($this->finish_image_log);
                if(time() - $finfo['mtime'] > 86400) {
                    //delete
                    unlink($this->finish_image_log);
                    
                }else{
                    //csv読み込み
                    $this->finish_image = file($this->finish_image_log,FILE_IGNORE_NEW_LINES);
                }
            }

            if(file_exists($this->wget_master_log)){
                //古いリストかチェック
                $finfo = stat($this->wget_master_log);
                if(time() - $finfo['mtime'] > 86400) {
                    //delete
                    unlink($this->wget_master_log);
                    
                }
            }
            
            if(file_exists($this->wget_support_log)){
                //古いリストかチェック
                $finfo = stat($this->wget_support_log);
                if(time() - $finfo['mtime'] > 86400) {
                    //delete
                    unlink($this->wget_support_log);
                    
                }
            }
            if(file_exists($this->wget_pass_log)){
                //古いリストかチェック
                $finfo = stat($this->wget_pass_log);
                if(time() - $finfo['mtime'] > 86400) {
                    //delete
                    unlink($this->wget_pass_log);
                    
                }
            }*/
        }
        
        
        
        $this->absolute_under_user_dir = $absolute_under_user_dir;
        
        //処理をするページのクライアント側URL生成.後ほど必要になる
        if($this->absolute_user_dir == $absolute_under_user_dir){
            $relation_path = '';
        }else{
            $relation_path = str_replace($this->absolute_user_dir.'/','',$absolute_under_user_dir);
            $relation_path .= '/';
        }
        

        $this->html_url = 'http://'.$this->user_fqdn.'/'.$relation_path.$html_file;

        $this->analyzeHtmlSource($html_file);
        
        //finish_image書き込み
        //if(count($this->finish_new_image) > 0) $this->finishImageWriter();
        
        //if($this->finish_image_csv_handle !== FALSE) fclose( $this->finish_image_csv_handle );
    }

        //$dom = file_get_dom($file);
        //$dom->find('meta[name=Keywords]', 0)->innertext = '改竄されました';
        //$html->find('meta[name=Keywords]', 0)->attr['content'] = 'test';//これで書き換えることが可能

        //echo $html;
        //die();

    function dumpMemory()
    {
        static $initialMemoryUse = null;

        if ( $initialMemoryUse === null )
        {
            $initialMemoryUse = memory_get_usage();
        }

        var_dump(number_format(memory_get_usage() - $initialMemoryUse));
    }


    private function analyzeHtmlSource($html_file){
        $ret = FALSE;
        unset($this->html);
        $this->html = '';
        $this->html = file_get_html($this->absolute_under_user_dir.'/'.$html_file);

        foreach ($this->handleTagList as $tag){
            foreach($this->html->find($tag) as $element){
                switch ($tag){
                    case 'img':
                        $src = trim($element->src);
                        if($src == '') break;
                        $this->handleTag($tag,'src',$src);
                    break;
                    
                    case 'link':
                        $href = trim($element->href);
                        if($href == '') break;
                        //cssだけ <link rel="index" href="index.html" />とかあるので
                        if ( preg_match("/.css/", $href) ){
                            $this->handleTag($tag,'href',$href);
                        }
                    break;

/*                    case 'script':
                        $src = trim($element->src);
                        if($src == '') break;
                        $this->handleTag($tag,'src',$src);
                    break;*/

                    case 'input':
                        $src = trim($element->src);
                        if($src == '') break;
                        if($element->type == 'image') $this->handleTag($tag,'src',$src);
                    break;
                    
                    case 'meta':
                    //metaは複数あるので注意
                    if($element->name !== FALSE){
                        if(array_key_exists($this->absolute_under_user_dir.'/'.$html_file,$this->seo)){
                            $this->handleSEO($tag,$this->seo[$this->absolute_under_user_dir.'/'.$html_file], trim($element->name));
                        }
                    }
                    break;
                    
                    case 'title':
                        if(array_key_exists($this->absolute_under_user_dir.'/'.$html_file,$this->seo)){
                            $this->handleSEO($tag,$this->seo[$this->absolute_under_user_dir.'/'.$html_file]);
                        }
                    break;
                }
            }
        }
        $this->html->save($this->absolute_under_user_dir.'/'.$html_file,$this->icp_html,$this->replace_array);
        //echo $this->html; die();
    }

    private function analyzeCssSource($css_file){
        $ret = FALSE;
        //$this->css = '';
        
        $imports = $this->getCssImport($this->absolute_under_user_dir.'/'.$css_file);
        if(count($imports) > 0){
            foreach ($imports as $import_path_file){
                $ret[] = $this->pavukCss($import_path_file,$this->absolute_under_user_dir);
            }
        }
    }

    private function getCssImport($css_file)
    {
        $target = $this->readCSSFile($css_file);
        preg_match_all('/@import\s+(url\()?["\']?([^"\';]+)/',
            $target, $files, PREG_PATTERN_ORDER);
        //$this->_cssFiles = $files[2];
        return $files[2];
    }

    private function readCSSFile($file)
    {
        if (strpos($file, 'http://') === 0 || strpos($file, 'https://') === 0) {
            return file_get_contents($file);
        }
        return file_get_contents($file);
    }

    //img 再生成
    private function handleTag($tag,$attr,$src_or_href){
        //httpから始まる場合DL
        if(preg_match("/^http:/", $src_or_href) == 1){
            if($tag == 'src' && preg_match("/.js/", $src_or_href) === FALSE){
                //ファイル系のjavascriptじゃない。パラメータ系
                //拡張子なしはプログラムという認識ですすめる。
                //例）http://netweather.accuweather.com/adcbin/netweather_v2/netweatherV2ex.asp?partner=netweather&tStyle=whteYell&logo=1&zipcode=ASI|JP|JA031|OKAYAMA|&lang=eng&size=8&theme=blue&metric=0&target=_self
            }else{
                if($tag == 'link'){
                    if(preg_match("{^http://www.okayama-japan.jp}", $src_or_href) == 1){//special
                        $path = str_replace('http://www.okayama-japan.jp/cn/','',$src_or_href);// css/site.css
                        $ex_path = explode('/',$path);
                        $this->doWgetShell($src_or_href,$this->absolute_under_user_dir.'/'.$ex_path[0]);
                    }
                }else{
                    $this->doWgetShell($src_or_href,$this->absolute_under_user_dir);
                    //DLファイルと同じ場所に配置
                    $pathinfo = pathinfo($src_or_href);
                    //$this->resetAttrValue($tag,$attr,$pathinfo['filename'].'.'.$pathinfo['extension'],$attr,$src_or_href);
                }

                
                
                //DLファイルと同じ場所に配置
                //$pathinfo = pathinfo($src_or_href);
                //$this->resetAttrValue($tag,$attr,$pathinfo['filename'].'.'.$pathinfo['extension'],$attr,$src_or_href);
                
            }
/*            if(preg_match("{^http://www.okayama-japan.jp}", $src_or_href) != 1){//special
                if($tag == 'src' && preg_match("/.js/", $src_or_href) === FALSE){
                    //ファイル系のjavascriptじゃない。パラメータ系
                    //拡張子なしはプログラムという認識ですすめる。
                    //例）http://netweather.accuweather.com/adcbin/netweather_v2/netweatherV2ex.asp?partner=netweather&tStyle=whteYell&logo=1&zipcode=ASI|JP|JA031|OKAYAMA|&lang=eng&size=8&theme=blue&metric=0&target=_self
                }else{
                    $this->doWgetShell($src_or_href,$this->absolute_under_user_dir);
                    //DLファイルと同じ場所に配置
                    $pathinfo = pathinfo($src_or_href);
                    $this->resetAttrValue($tag,$attr,$pathinfo['filename'].'.'.$pathinfo['extension'],$attr,$src_or_href);
                }
            }*/
        }
        
        //ロールオーバー画像取得
        if($tag == 'img' || $tag == 'input') $this->wgetOnImage($src_or_href,$this->absolute_under_user_dir);
    }

    private function handleSEO($tag,$seo,$meta_name = ''){
        //htmlの書き換えが必要なため、置換配列にセット
        if($tag == 'meta'){
            //検索するキーワードが異なっていることに注意.さらにSEO配列のキーは必ず小文字です！
            $this->resetAttrValue2($tag,'content',$seo[strtolower($meta_name)],'name',$meta_name);
        }elseif($tag == 'title'){
            $this->resetInnerTextValue($tag,$seo['title']);
        }
    }

    /*
    コンテンツ再セット
        $dom->find('meta[name=Keywords]', 0)->innertext = '改竄されました';
        $html->find('meta[name=Keywords]', 0)->attr['content'] = 'test';//これで書き換えることが可能
    */
    private function resetAttrValue($tag,$attr,$value,$where_key = '',$where_value = ''){
        $search = '';
        $search .= $tag;
        if($where_key != '' && $where_value != '') $search .= '['.$where_key.'='.$where_value.']';
        $this->html->find($search,0)->attr[$attr] = $value;
    }

    private function resetAttrValue2($tag,$attr,$value,$where_key = '',$where_value = ''){
        $search = '';
        $search .= $tag;
        if($where_key != '' && $where_value != '') $search .= '['.$where_key.'='.$where_value.']';
        $this->html->find($search,0)->attr[$attr] = $value;
    }

    private function resetInnerTextValue($tag,$value,$where_key = '',$where_value = ''){
        $search = '';
        $search .= $tag;
        if($where_key != '' && $where_value != '') $search .= '['.$where_key.'='.$where_value.']';
        $this->html->find($search,0)->innertext = $value;
    }

    //onを付与する前のsrcを取得してwget
    private function wgetOnImage($src,$absolute_under_user_dir){
        $is_http = preg_match("/^http:/", $src) == 1 ? TRUE : FALSE;
        $pathinfo = pathinfo($src);
        
        //httpから始まる場合、ページと同じ場所に保存
        if($is_http !== FALSE){
            $url_save_path_array = array('url_path'=>$src,'save_path'=>$absolute_under_user_dir);
        }else{
            $url_save_path_array = array('url_path'=>$this->createUri($this->html_url,$src),'save_path'=>$this->getFilePath($this->absolute_user_dir.$this->make_apath($this->html_url,$src)));
            //getするかチェック
            if(array_search($url_save_path_array['url_path'],$this->finish_image) !== FALSE || array_search($url_save_path_array['url_path'],$this->finish_new_image) !== FALSE ){
                //print $url_save_path_array['url_path'].':pass'."\n";
                return FALSE;
            }else{
                $this->finish_new_image[] = $url_save_path_array['url_path'];//書き込み用
            }
        }
        if(is_null($url_save_path_array)) return FALSE;

        //on画像専用の文字列を付与するために、offや拡張子を一時的に除去してon画像用文字列を付与
        $new_src = substr($url_save_path_array['url_path'],0,$len);
        if(!is_null($this->rollover_string) && count($this->rollover_string) > 0){
            //キーが置換対象、要素が置換後
            foreach ($this->rollover_string as $key => $value){

                //on画像専用の文字列を付与するために、offや拡張子を一時的に除去してon画像用文字列を付与
                if($key == ''){
                    //置換文字列がないパターン
                    $is_end_key = TRUE;
                }else{
                    $string = $key.'$';
                    $is_end_key = preg_match("/$string/", $pathinfo['filename']) == 1 ? TRUE : FALSE;
                }
                
                //マッチした画像のみwgetする
                if($is_end_key !== FALSE){
                    $extension_len = strlen($pathinfo['extension']) + 1;//拡張子文字数 .分の1を追加
                    $key_len = strlen($key);
                    
                    $len = strlen($url_save_path_array['url_path']) - $key_len - $extension_len;
                    
                    $new_src = substr($url_save_path_array['url_path'],0,$len);
                    $this->doWgetShell($new_src.$value.'.'.$pathinfo['extension'],$url_save_path_array['save_path']);
                    //$this->wget_list[] = array($new_src.$value.'.'.$pathinfo['extension'],$url_save_path_array['save_path']);
                }
            }
        }else{
        }
    }
    
    /**
     * 相対パスから絶対URLを返します
     * 
     * @param string $base ベースURL（絶対URL）
     * @param string $relational_path 相対パス
     * @return string 相対パスの絶対URL
     * @link http://blog.anoncom.net/2010/01/08/295.html
     * @link http://logic.stepserver.jp/data/archives/501.html
     */
    private function createUri( $base = '', $relational_path = '' ) {

        $parse = array (
            'scheme' => null,
            'user' => null,
            'pass' => null,
            'host' => null,
            'port' => null,
            'path' => null,
            'query' => null,
            'fragment' => null,
        );

        $parse = parse_url ( $base );

        // パス末尾が / で終わるパターン
        if ( strpos( $parse['path'], '/', ( strlen( $parse['path'] ) - 1 ) ) !== FALSE ) {
            $parse['path'] .= '.';    // ダミー挿入
        }
        if ( preg_match ( '#^https?\://#', $relational_path ) ) {
            // 相対パスがURLで指定された場合
            return $rel_path;
        } elseif ( preg_match ( '#^/.*$#', $relational_path ) ) {
            // ドキュメントルート指定
            return $parse['scheme'] . '://' . $parse ['host'] . $relational_path;
        } else {
            // 相対パス処理
            $basePath = explode ( '/', dirname ( $parse ['path'] ) );
            $relPath = explode ( '/', $relational_path );
            foreach ( $relPath as $relDirName ) {
                if ($relDirName == '.') {
                    array_shift ( $basePath );
                    array_unshift ( $basePath, '' );
                } elseif ($relDirName == '..') {
                    array_pop ( $basePath );
                    if ( count ( $basePath ) == 0 ) {
                        $basePath = array( '' );
                    }
                } else {
                    array_push ( $basePath, $relDirName );
                }
            }
            $in = $basePath;
            $basePath = array_merge(array_diff($in, array('')));
            $path = implode ( '/', $basePath );
            return $parse ['scheme'] . '://' . $parse ['host'] .'/'. $path;
        }
    }

    //============================ _make_apath：version 1.0
    private function make_apath($base='', $rel_path=''){
        $base = preg_replace('/\/[^\/]+$/','/',$base);
        $parse = parse_url($base);
        if (preg_match('/^https\:\/\//',$rel_path) ){
            return $rel_path;
        }
        elseif ( preg_match('/^\/.+/', $rel_path) ){
            $out = $parse['scheme'].'://'.$parse['host'].$rel_path;
            return $out;
        }
        $tmp = array();
        $a = array();
        $b = array();
        //$tmp = split('/',$parse['path']);
        $tmp = explode('/',$parse['path']);
        foreach ($tmp as $v){
            if ($v){  array_push($a,$v); }
        }
        $b = explode('/',$rel_path);
        foreach ($b as $v){
            if ( strcmp($v,'')==0 ){ continue; }
            elseif ($v=='.'){}
            elseif($v=='..'){ array_pop($a); }
            else{ array_push($a,$v); }
        }
        $path = join('/',$a);
        return '/'.$path;
    }
    
    //srcやhrefから画像名のみ取得する
    private function getFileName($src_or_href,$isExtention = TRUE){
        $pathinfo = pathinfo($src_or_href);
        return $isExtention ? $pathinfo['filename'].'.'.$pathinfo['extension'] : $pathinfo['filename'];
    }

    //srcやhrefから画像へのパスを取得する
    private function getFilePath($src_or_href){
        $pathinfo = pathinfo($src_or_href);
        return str_replace($pathinfo['filename'].'.'.$pathinfo['extension'],'',$src_or_href);
    }

    //wget
    private function doWgetShell($url,$full_path_dir){
        $arg = '';
        $arg .= '-E "'.$url.'"';//"でエスケープしておかないと&とかでエラーになる
        $arg .= ' -e robots=off';
        $arg .= ' -P '.$full_path_dir;
        $arg .= ' -a '.SHELL_DIR.'/'.$this->user_dir.'/'.WGET_SUPPORT_LOG;
        $arg .= ' -nd';//ディレクトリを作成しない
        $arg .= ' -nH';//トップディレクトリを作成しない
        $arg .= ' -N';//タイムスタンプが新しいファイルだけ（更新されたファイルだけ）ダウンロードします。
        $arg .= ' --restrict-file-names=nocontrol';//URLエンコードされた文字列をエスケープせずに取得
        $arg .= ' -np';//親NG
        $arg .= ' --user-agent="Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; WOW64; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C; .NET4.0E)"';
        //exec('/usr/local/bin/wget '.$arg,$out,$ret);
        system('/usr/local/bin/wget '.$arg);
    }
    private function doWgetShelltest($url,$full_path_dir){
        $arg = '';
        $arg .= '-E "'.$url.'"';//"でエスケープしておかないと&とかでエラーになる
        $arg .= ' -e robots=off';
        $arg .= ' -P '.$full_path_dir;
        $arg .= ' -a '.SHELL_DIR.'/'.$this->user_dir.'/'.WGET_SUPPORT_LOG;
        $arg .= ' -nd';//ディレクトリを作成しない
        $arg .= ' -nH';//トップディレクトリを作成しない
        $arg .= ' -N';//タイムスタンプが新しいファイルだけ（更新されたファイルだけ）ダウンロードします。
        $arg .= ' --restrict-file-names=nocontrol';//URLエンコードされた文字列をエスケープせずに取得
        $arg .= ' -np';//親NG
        $arg .= ' --user-agent="Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; WOW64; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C; .NET4.0E)"';
        //exec('/usr/local/bin/wget '.$arg,$out,$ret);
        system('/usr/local/bin/wget '.$arg);
    }

    private function finishImageWriter(){
        $fp = fopen( $this->finish_image_log, "a+" );
        
        /* ヘッダの作成例と出力 */
        $contents="";
        //fputs($fp, $contents);
        
        foreach($this->finish_new_image as $src){
            $contents="";//初期化
            $contents .= $src."\n";
            /* ファイルに出力 */
            fputs($fp,mb_convert_encoding($contents,'UTF-8','UTF-8'));
        }
        fclose( $fp );
        //return $temp_filename;
    }
}
?>