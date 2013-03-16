<?php
// prevent the server from timing out
set_time_limit(0);
set_include_path('/usr/local/apache2/htdocs/gengo/include');
require_once('fw/prepend.php');
require_once('call/handle.php');
require_once('manager/logic.php');
require_once('manager/handle.php');
require_once('user/logic.php');

// include the web sockets server script (the server is started at the far bottom of this file)
//require_once __dir__.'/include/fw/class.PHPWebSocket.php';
require_once '/usr/local/apache2/htdocs/gengo/include/fw/class.PHPWebSocket.php';

// when a client sends data to the server
function wsOnMessage($clientID, $json_message, $messageLength, $binary) {
    $message = get_object_vars(json_decode($json_message));
    var_dump($message);
    
    global $Server,$con;
    $ip = long2ip( $Server->wsClients[$clientID][6] );

    // check if message length is 0
    if ($messageLength == 0) {
        $Server->wsClose($clientID);
        return;
    }
    //type call //////////////////////////////////////////////////////////////////////////////////////////
    if($message['type'] == 'call'){
        //db
        if(strcasecmp($message['lang'],TYPE_LANG_EN) == 0){
            $type = TYPE_LANG_EN;
            $lang = TYPE_LANG_EN_NAME;
            $lang_image = 'english_task.png';
        }elseif(strcasecmp($message['lang'],TYPE_LANG_CN) == 0){
            $type = TYPE_LANG_CN;
            $lang = TYPE_LANG_CN_NAME;
            $lang_image = 'china_task.png';
        }elseif(strcasecmp($message['lang'],TYPE_LANG_KR) == 0){
            $type = TYPE_LANG_KR;
            $lang = TYPE_LANG_KR_NAME;
            $lang_image = 'korea_task.png';
        }else{
            $type = TYPE_LANG_BACK;
            $lang = TYPE_LANG_BACK_NAME;
            $lang_image = '';
        }

        $con->isCommand = TRUE;
        $mes_text = '';
        if(strcasecmp($type,TYPE_LANG_BACK) != 0){
            if(is_numeric($message['uid'])){
                $uid = $message['uid'];
                //user
                $u_logic = new userLogic();
                $user = $u_logic->getOneUser($uid);
            }else{
                $uid = 0;
                $user = FALSE;
                var_dump('alert');
                die();
            }

            //manager assign
            $m_logic = new managerLogic();
            $free_manager = $m_logic->getStatusManager();

            //call
            $call_handle = new callHandle();
            $cid = $call_handle->addRow($type,$uid,$free_manager[0]['_id']);

            //テスト停止
            //$manager_handle = new managerHandle();
            //$manager_handle->updateStatusRow($free_manager[0]['_id'],STATUS_BUSY);

            $con->safeExit();
            $mes_arr = array('call'=>'call','date'=>date("Y/n/d H:i:s"),'cid'=>$cid,'user' =>$user[0]['col_given_name'],'facetime' =>$user[0]['col_facetime'], 'lang' =>$lang, 'lang_image' =>$lang_image, 'manager' =>$free_manager[0]['col_given_name'], 'assign_mid' =>$free_manager[0]['_id']);
            $mes_text .= json_encode($mes_arr);
        }else{
            $mes_text = $message;
        }

    }
    
    //type busy //////////////////////////////////////////////////////////////////////////////////////////
    if($message['type'] == 'busy'){
        $con->isCommand = TRUE;
        $mes_text = '';
        if( is_numeric($message['cid']) && is_numeric($message['mid']) && is_numeric($message['assign_mid']) ){
            if(strcasecmp($message['mid'],$message['assign_mid']) != 0){
                //予定の担当者以外
                $call_handle = new callHandle();
                $call_handle->updateManager($message['cid'],$message['mid']);
            }

            //テスト停止
            //$manager_handle = new managerHandle();
            //$manager_handle->updateStatusRow($free_manager[0]['_id'],STATUS_BUSY);

            $con->safeExit();
            
            $busy_arr = array('busy'=>'busy','cid'=>$message['cid'],'manager'=>$message['manager'],'mid'=>$message['mid'],'assign_mid'=>$message['assign_mid']);
            $mes_text .= json_encode($busy_arr);
        }else{
            $mes_text = '';
        }
    }

    //type finish //////////////////////////////////////////////////////////////////////////////////////////
    if($message['type'] == 'finish'){
        $con->isCommand = TRUE;
        $mes_text = '';
        if( is_numeric($message['cid']) && is_numeric($message['mid']) ){
            $call_handle = new callHandle();
            $call_handle->updateFinish($message['cid'],$message['mid']);

            $con->safeExit();
            
            $finish_arr = array('finish'=>'finish','cid'=>$message['cid'],'manager'=>$message['manager'],'mid'=>$message['mid']);
            $mes_text .= json_encode($finish_arr);
        }else{
            $mes_text = '';
        }
    }

    //type message //////////////////////////////////////////////////////////////////////////////////////////
    if($message['type'] == 'message'){
        $message_arr = array('log'=>$message['message']);
        $mes_text = json_encode($message_arr);
    }
    
    //The speaker is the only person in the room. Don't let them feel lonely.
    if ( sizeof($Server->wsClients) == 1 ){
        //$Server->wsSend($clientID, "There isn't anyone else in the room, but I'll still listen to you. --Your Trusty Server");
    }else{
        //Send the message to everyone but the person who said it
        foreach ( $Server->wsClients as $id => $client ){
            if ( $id != $clientID ){
                $Server->wsSend($id, $mes_text);
            }
        }
    }
}

// when a client connects
function wsOnOpen($clientID)
{
    global $Server;
    $ip = long2ip( $Server->wsClients[$clientID][6] );

    //$Server->log( "$ip ($clientID) has connected." );

    //Send a join notice to everyone but the person who joined
    foreach ( $Server->wsClients as $id => $client )
        if ( $id != $clientID )
            //$Server->wsSend($id, "Visitor $clientID ($ip) has joined the room.<br />");
            $mes_arr = array('log'=>"Visitor $clientID ($ip) has joined the room.<br />");
            $Server->wsSend($id, json_encode($mes_arr));
}

// when a client closes or lost connection
function wsOnClose($clientID, $status) {
    global $Server;
    $ip = long2ip( $Server->wsClients[$clientID][6] );

    //$Server->log( "$ip ($clientID) has disconnected." );

    //Send a user left notice to everyone in the room
    foreach ( $Server->wsClients as $id => $client )
        //$Server->wsSend($id, "Visitor $clientID ($ip) has left the room.<br />");
        $mes_arr = array('log'=>"Visitor $clientID ($ip) has left the room.<br />");
        $Server->wsSend($id, json_encode($mes_arr));
}

// start the server
$Server = new PHPWebSocket();
$Server->bind('message', 'wsOnMessage');
$Server->bind('open', 'wsOnOpen');
$Server->bind('close', 'wsOnClose');
// for other computers to connect, you will probably need to change this to your LAN IP or external IP,
// alternatively use: gethostbyaddr(gethostbyname($_SERVER['SERVER_NAME']))
//$Server->wsStartServer('127.0.0.1', 9300);
//$Server->wsStartServer('192.168.0.24', 9300);
//$Server->wsStartServer('gengo.813.co.jp', 9300);
if(is_file('/usr/local/apache2/htdocs/gengo/include/setting.ini')){
    $ini = parse_ini_file('/usr/local/apache2/htdocs/gengo/include/setting.ini', true);
}else{
    $ini = FALSE;
}
if(strcasecmp($ini['common']['isStage'],1) == 0){
    $Server->wsStartServer('gengo.813.co.jp', 9300);
}else{
    $Server->wsStartServer('gengo.apollon.corp.813.co.jp', 9300);
}


?>