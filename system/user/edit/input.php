<?php
//--[ 前処理 ]--------------------------------------------------------------
require_once('manager/prepend.php');
$uid = $con->base->getPath('uid',TRUE);//リダイレクトあり

//form情報アサイン
require_once('user/form.php');
$form = new userForm();
$form->assignForm();

require_once('user/logic.php');
$u_logic = new userLogic();
$user = $u_logic->getOneUser($uid);

if(!$user){
    require_once('fw/errorManager.php');
    errorManager::throwError(E_CMMN_USER_EXISTS);
}

$con->t->assign('user',$user);

$page = 'input';
if ( $con->isPost ){
    if($_POST['operation'] == 'check'){

        require_once('user/check.php');
        checkUserEdit::checkError();
        $page = checkUserEdit::safeExit() ? 'confirm' : 'input';
    }elseif($_POST['operation'] == 'back'){
        $page = 'input';
    }elseif($_POST['operation'] == 'regist'){
        require_once('user/check.php');
        checkUserEdit::checkError();
        $bl = checkUserEdit::safeExit();
        $old_user_dir_name = null;
        if($bl){
            if(strcasecmp($_POST['old_user_dir_name'],$_POST['directory']) != 0){
                $old_user_dir_name = $_POST['old_user_dir_name'];
            }elseif(isset($_POST['old_user_dir_name'])){
                $old_user_dir_name = FALSE;
            }
            require_once('user/handle.php');
            $user_handle = new userHandle();
            $uid = $user_handle->updateRow($uid);
            
            if(!is_null($old_user_dir_name) && $old_user_dir_name !== FALSE){
                //ディレクトリ名変更
                if(is_dir(WGET_DIR.'/'.$old_user_dir_name)){
                    if(!is_writable(WGET_DIR.'/'.$old_user_dir_name)){
                        print '権限なし1';
                        die();
                    }
                    
                    if ( rename( WGET_DIR.'/'.$old_user_dir_name, WGET_DIR.'/'.$_POST['directory'] ) ) {

                    } else {
                        print 'リネーム失敗1';
                        die();
                    }
                }else{
                    print 'ディレクトリがありません。1';
                    die();
                }

                if(is_dir(SHELL_DIR.'/'.$old_user_dir_name)){
                    if(!is_writable(SHELL_DIR.'/'.$old_user_dir_name)){
                        print '権限なし2';
                        die();
                    }
                    if ( rename( SHELL_DIR.'/'.$old_user_dir_name, SHELL_DIR.'/'.$_POST['directory'] ) ) {

                    } else {
                        print 'ディレクトリ作成失敗2';
                        die();
                    }
                }else{
                    print 'ディレクトリがありません。2';
                    die();
                }
            }
            //先に作らないとNG
            //shellファイル再生成
            require_once('fw/crawlerUtil.php');
            $crawler_util = new crawlerUtil();
            $crawler_util->makeUserShell($_POST['directory'],$_POST['url'],$_POST['depth'],$_POST['domain'],$_POST['direct'],$old_user_dir_name);
            $con->safeExitRedirect('/system/user/view/uid/'.$uid,TRUE);
        }else{
            $con->safeExitRedirect('/system/user/',TRUE);
        }

    }
}else{
    $_POST['name']      = $user[0]['col_name'];
    $_POST['directory'] = $user[0]['col_directory'];
    $_POST['old_user_dir_name'] = $user[0]['col_directory'];
    $_POST['url']       = $user[0]['col_url'];
    $_POST['depth']     = $user[0]['col_depth'];
    $_POST['domain']    = $user[0]['col_domain'];
    $_POST['rollover']  = $user[0]['col_rollover'];
    $_POST['direct']  = $user[0]['col_direct'];
    $_POST['replace'] = $user[0]['col_replace'];
    $_POST['validate']  = $user[0]['col_validate'];
}

//共通処理////////////////////////

$con->append('system/user/edit/'.$page);
?>
