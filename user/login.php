<?php
require_once('user/prepend.php');

//debug
if ( $con->isPost ){
    $user_auth->login($_POST['mail'],$_POST['password']);
}else{
    //debug//
    if($con->isDebug){
        //$_POST['mail'] = 'test@813.co.jp';
        $_POST['mail'] = 'test1@zeus.corp.813.co.jp';
    }
    
}
//共通処理////////////////////////


// display it
$con->append();
?>
