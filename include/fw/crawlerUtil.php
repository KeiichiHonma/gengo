<?php
include('fw/define.php');
include('fw/simple_html_dom.php');
include('fw/csv.php');
class crawlerUtil
{

    public $html_files = array();
    public $css_files = array();

    public function makeUserShell($user_dir_name,$url,$depth,$allow_domains,$direct,$old_user_dir_name = null){
        //fqdn
        $rep = str_replace('http://','',$url);
        $url_explode = explode('/',$rep);
        if($url_explode !== FALSE){
            $user_fqdn = $url_explode[0];
        }else{
            $user_fqdn = $rep;
        }
        
        
        global $con;
        if($con->isDebug){
            $apache = 'apache@artemis.corp.iluna.co.jp';//旧ドメインでSSH認証とってます
        }else{
            $apache = 'apache@www.kujapan.com';
        }
        $fp = fopen( SHELL_DIR.'/'.$user_dir_name.'/'.USER_SHELL_FILE, "w+" );
        
        /* ヘッダの作成例と出力 */
        $contents='';
        $domain_string = '';
        //fputs($fp, $contents);
        if($allow_domains != ''){
            $domain_array = explode(',',$allow_domains);
            $toPutComma = FALSE;
            foreach ($domain_array as $domain){
                if ( $toPutComma ) {
                    $domain_string .= ',';
                } else {
                    $toPutComma = TRUE;
                }
                $domain_string .= $domain;
            }
        }
        
        $contents .= '#!/bin/sh'."\n";
        $depth_string = '';
        if(isset($depth) && is_numeric($depth) && $depth > 1) $depth_string .= ' -r -l '.$depth;
        $contents .= 'rm -rf '.WGET_DIR.'/'.$user_dir_name."\n";
        $contents .= 'mkdir '.WGET_DIR.'/'.$user_dir_name."\n";

        //okayamaだけ -H つけます
        if($user_dir_name == 'okayama'){
            $contents .= '/usr/local/bin/wget -P '.WGET_DIR.'/'.$user_dir_name.' -D'.$domain_string.' -N -e robots=off -nH'.$depth_string.' --restrict-file-names=nocontrol --page-requisites -k -o '.SHELL_DIR.'/'.$user_dir_name.'/'.WGET_MASTER_LOG.' --user-agent="Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; WOW64; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C; .NET4.0E)"'.' -H -np -E '.$url."\n";
        }else{
            $contents .= '/usr/local/bin/wget -P '.WGET_DIR.'/'.$user_dir_name.' -D'.$domain_string.' -N -e robots=off -nH'.$depth_string.' --restrict-file-names=nocontrol --page-requisites -k -o '.SHELL_DIR.'/'.$user_dir_name.'/'.WGET_MASTER_LOG.' --user-agent="Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; WOW64; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C; .NET4.0E)"'.' -np -E '.$url."\n";
        }
        

        //--restrict-file-names=nocontrol URLエンコードされた文字列をエスケープせずに取得
        //-np 親ディレクトリを含めない。 /cn/ /hg/ があったとして /hg/を取りに行かない
        if(strlen($direct) > 0){
            //$direct_split = split("\n", $direct);
            $direct_explode = explode("\n",$direct);
            if($direct_explode !== FALSE){
                foreach ($direct_explode as $value){
                    $contents .= '/usr/local/bin/wget -P '.WGET_DIR.'/'.$user_dir_name.' -D'.$domain_string.' -N -e robots=off -nH'.$depth_string.' --restrict-file-names=nocontrol --page-requisites -k --user-agent="Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; WOW64; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C; .NET4.0E)"'.' -np -E '.trim($value)."\n";
                }
            }
        }


        $contents .= 'wait'."\n";
        $contents .= 'chown -R apache:apache '.WGET_DIR.'/'.$user_dir_name."\n";
        $contents .= '/usr/local/bin/php -f '.COMMAND_DIR.'/'.MAKE_SHELL_PHP_FILE.' '.$user_dir_name.' '.$user_fqdn."\n";
        $contents .= 'wait'."\n";
        $contents .= 'sh '.SHELL_DIR.'/'.$user_dir_name.'/'.HTML_SHELL_FILE."\n";
        $contents .= 'wait'."\n";
        $contents .= 'chown -R apache:apache '.SHELL_DIR.'/'.$user_dir_name.'/'.HTML_SHELL_FILE."\n";
        global $con;
        //stageの場合はローカルシンクとなる
        if($con->isStage){
            $contents .= 'rsync -vrt --delete -e ssh '.WGET_DIR.'/'.$user_dir_name.' '.CHINA_DOCUMENT_ROOT;
        }else{
            $contents .= 'su apache -c "rsync -vrt --delete -e \'ssh -p 34581\' '.WGET_DIR.'/'.$user_dir_name.' '.$apache.':'.CHINA_DOCUMENT_ROOT.'"';
        }
        fputs($fp,$contents);
        fclose( $fp );
        chmod(SHELL_DIR.'/'.$user_dir_name.'/'.USER_SHELL_FILE,0770);
        $contents .= 'sh '.SHELL_DIR.'/'.$user_dir_name.'/'.HTML_SHELL_FILE."\n";
        
        //master shell 更新///////////////////////////////////////////////////////////
        //FALSEじゃない時だけ、FALSEは更新時にフォルダ名が変わらないこと示す
        if($old_user_dir_name !== FALSE){
            if(!is_null($old_user_dir_name)){
                //更新時は追記モードだと同じ処理を記載してしまうため、チェックしてから
                $file = file_get_contents(SHELL_DIR.'/'.MASTER_SHELL_FILE);
                $new_file = str_replace('sh '.SHELL_DIR.'/'.$old_user_dir_name.'/'.USER_SHELL_FILE.' &','sh '.SHELL_DIR.'/'.$user_dir_name.'/'.USER_SHELL_FILE.' &',$file);
                file_put_contents(SHELL_DIR.'/'.MASTER_SHELL_FILE,$new_file);
            }else{
                $fp = fopen( SHELL_DIR.'/'.MASTER_SHELL_FILE, "a+" );
                $contents = '';
                $contents .= 'sh '.SHELL_DIR.'/'.$user_dir_name.'/'.USER_SHELL_FILE.' &'."\n";
                fputs($fp,$contents);
                fclose( $fp );
            }
        }
        chmod(SHELL_DIR.'/'.MASTER_SHELL_FILE,0770);
    }



    //ユーザーディレクトリ以下のhtmlファイルをリスト化
    public function setUserHtmlFiles($user_dir){
        $this->readRecursiveUserDir(WGET_DIR.'/'.$user_dir);
    }

    //ユーザーディレクトリ以下のhtmlファイルを再帰的に処理
    private function readRecursiveUserDir($absolute_under_user_dir) {
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
    }

    //htmlファイルごとにコマンドを記載する。メモリエラーが発生するため
    public function makeHtmlShell($user_dir,$user_fqdn){
        $fp = fopen( SHELL_DIR.'/'.$user_dir.'/'.HTML_SHELL_FILE, "w+" );
        $contents='';
        $this->setUserHtmlFiles($user_dir);
        if(count($this->html_files) == 0) return FALSE;
        $contents .= '#!/bin/sh'."\n";

        foreach ($this->html_files as $absolute_under_user_dir => $files){
            foreach ($files as $file){
                //$contents .= '/usr/local/bin/php -f '.COMMAND_DIR.'/'.CRAWLER_SUPPORT_PHP_FILE.' '.$user_dir.' '.$user_fqdn.' '.$absolute_under_user_dir.' "'.$file.'" >> '.SHELL_DIR.'/'.$user_dir.'/'.WGET_PASS_LOG."\n";//logつき
                $contents .= '/usr/local/bin/php -f '.COMMAND_DIR.'/'.CRAWLER_SUPPORT_PHP_FILE.' '.$user_dir.' '.$user_fqdn.' '.$absolute_under_user_dir.' "'.$file.'"'."\n";
            }
        }
        /* ファイルに出力 */
        fputs($fp,$contents);
        fclose( $fp );
        chmod(SHELL_DIR.'/'.$user_dir.'/'.HTML_SHELL_FILE,0770);
        return TRUE;
    }

}
?>