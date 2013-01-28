<?php
//--[ 前処理 ]--------------------------------------------------------------
require_once('manager/prepend.php');

//form情報アサイン
require_once('user/form.php');
$form = new userForm();
$form->assignForm();

$page = 'input';
if ( $con->isPost ){
    if($_POST['operation'] == 'check'){
        require_once('user/check.php');
        checkUserEntry::checkError();
        $page = checkUserEntry::safeExit() ? 'confirm' : 'input';
    }elseif($_POST['operation'] == 'back'){
        $page = 'input';
    }elseif($_POST['operation'] == 'regist'){
        require_once('user/check.php');
        checkUserEntry::checkError();
        $bl = checkUserEntry::safeExit();
        if($bl){
            require_once('user/handle.php');
            $user_handle = new userHandle();

            $uid = $user_handle->addRow();
            
            //チェック判断
            if(!$uid){
                print 'error1';
                die();
            }
            
            //ディレクトリ生成
            if(!is_dir(WGET_DIR.'/'.$_POST['directory'])){
                if(!is_writable(WGET_DIR)){
                    print '権限なし1';
                    die();
                }
                
                if ( mkdir( WGET_DIR.'/'.$_POST['directory'], 0770 ) ) {

                } else {
                    print 'ディレクトリ作成失敗1';
                    die();
                }
            }else{
                print 'ディレクトリが既にあります。1';
                die();
            }

            if(!is_dir(SHELL_DIR.'/'.$_POST['directory'])){
                if(!is_writable(SHELL_DIR)){
                    print 'shell権限なし2';
                    die();
                }
                if ( mkdir( SHELL_DIR.'/'.$_POST['directory'], 0770 ) ) {
                    require_once('fw/crawlerUtil.php');
                    $crawler_util = new crawlerUtil();
                    $crawler_util->makeUserShell($_POST['directory'],$_POST['url'],$_POST['depth'],$_POST['domain'],$_POST['direct']);
                } else {
                    print 'ディレクトリ作成失敗2';
                    die();
                }
            }else{
                print 'ディレクトリが既にあります。2';
                die();
            }

            $con->safeExitRedirect('/system/user/view/uid/'.$uid,TRUE);

        }else{
            $con->safeExitRedirect('/system/user/',TRUE);
        }

    }
}else{
    //debug//
    if($con->isDebug){
/*        $_POST['name']      = 'テスト';
        $_POST['directory'] = 'test';
        $_POST['url']       = 'http://china.apollon.corp.813.co.jp/debug/index.html';
        $_POST['domain']    = 'china.apollon.corp.813.co.jp';*/
        
        
        //iluna
/*        $_POST['name']      = 'ハチワン';
        $_POST['directory'] = 'iluna';
        $_POST['url']       = 'http://iluna.hera.corp.813.co.jp/';
        $_POST['depth']     = 5;
        $_POST['domain']    = 'iluna.hera.corp.813.co.jp';
        $_POST['rollover']  = '_off,_on';
        $_POST['validate']  = 0;*/
        
        //kujapan
        $_POST['name']      = 'kujapan';
        $_POST['directory'] = 'kujapan';
        $_POST['url']       = 'http://cn.kujapan.apollon.corp.813.co.jp/';
        //$_POST['depth']     = ;
        $_POST['domain']    = 'cn.kujapan.apollon.corp.813.co.jp';
        $_POST['rollover']  = '_off,_on';
        $_POST['validate']  = 0;

    }
}

//共通処理////////////////////////

$con->append('system/user/entry/'.$page);
?>
