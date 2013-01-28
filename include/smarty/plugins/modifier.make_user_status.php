<?php
function smarty_modifier_make_user_status($user)
{
/*
アカウント停止ー--------------------
■無効
停止
意図的に停止

エラー--------------------
使用できていない、あるいは危険な使用状態

■お客様番号なし、ログインアカウントなし、決済番号なし
エラー

■ステータスOK、使用者未登録
エラー

■有効、使用者未登録
エラー

アラート--------------------
問題はあるが、使用できている状態
■ステータスTMP、使用者登録済
アラート


正常--------------------
■ステータスTMP、使用者未登録
未登録

■有効期限切れ
期限切

■ステータスOK、使用者登録済
利用中

*/
    global $con;
    $key_head_name = 'user_status_value_';//翻訳ファイルのステータス接頭辞
    //level
/*    $error1 = 'エラーL1';
    $error2 = 'エラーL2';
    $error2 = 'エラーL3';
    $tmp = '未登録';
    $normal = '利用中';
    $deadline = '期限切';
    $deny = '停止';*/

    //危険なものからチェックする
    if(strcasecmp($user['col_validate'],VALIDATE_DENY) == 0){
        return $con->locale[$key_head_name.'deny'];
    }elseif(strlen($user['col_customer_no']) == 0 || strlen($user['col_account']) == 0 || strlen($user['col_buyer_id']) == 0 || strlen($user['col_trade_no']) == 0){
        return $con->locale[$key_head_name.'error1'];
    }elseif(strlen($user['col_given_name']) == 0){
        if(strcasecmp($user['col_status'],STATUS_USER_TMP) == 0){
            return $con->locale[$key_head_name.'tmp'];
        }else{
            return $con->locale[$key_head_name.'error2'];
        }
    }else{
        if(strcasecmp($user['col_status'],STATUS_USER_REGIST) == 0){
            if($user['col_validate_time'] < time()){
                return $con->locale[$key_head_name.'deadline'];
            }else{
                return $con->locale[$key_head_name.'normal'];
            }
        }else{
            return $con->locale[$key_head_name.'error3'];
        }
    }
    
}
?>