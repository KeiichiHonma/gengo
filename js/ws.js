var Server;

function log( text ) {
    try {
        var jsonobj = jQuery.parseJSON( text );
    } catch (e) {
        // パースエラー時の対応をここで
        //alert(3);
        //console.log();
    }
    
    //log////////////////////////////////////////////////////
    $log = $('#log');
    
    if(jsonobj.log){
        $log.append(($log.val()?"\n":'') + jsonobj.log + "<br />");
        $log[0].scrollTop = $log[0].scrollHeight - $log[0].clientHeight;
    }
    
    //call////////////////////////////////////////////////////
    $call = $('#call');
    if(jsonobj.call){
        //リーダー or 担当
        if(reader_type == manager_type || jsonobj.assign_mid == login_mid){
            //sound
            //$('#startSound').html( playSound('page', false));
        }
        
        //call
        html = '';
        //colで作成
        //html += "<div class='col'><a href='facetime://" + jsonobj.facetime + "'><img src='/img/call.png' style='border: none;' width='15' height='15' alt='Skype Me?!' />呼び出す</a></div>";
        //html += "<div class='col'>" + jsonobj.user + "</div>";
        //html += "<div class='col'>" + jsonobj.manager + ":" + jsonobj.assign_mid + "</div>";
        //html += "<div class='col'><input type='submit' data='{\"type\":\"busy\",\"cid\":\"" + jsonobj.cid + "\",\"mid\":\"" + login_mid + "\",\"assign_mid\":\"" + jsonobj.assign_mid + "\",\"manager\":\"" + manager_given_name + "\"}' id='call" + jsonobj.cid + "' class='button_busy' value='担当する' /></div>";
        html += "<div id='task" + jsonobj.cid + "' class='task new'><img src='/img/" + jsonobj.lang_image + "' style='border: none;' width='70' height='70' alt='' /></div>";
        html += "<div id='task_detail" + jsonobj.cid + "' class='task_detail new'>";
        html += jsonobj.date + " <input type='submit' data='{\"type\":\"finish\",\"cid\":\"" + jsonobj.cid + "\",\"mid\":\"" + login_mid + "\",\"manager\":\"" + manager_given_name + "\"}' cid='" + jsonobj.cid + "' id='finish" + jsonobj.cid + "' class='button_finish' value='完了する' />";
        html += "<br /><a href='facetime://" + jsonobj.facetime + "'><img src='/img/call.png' style='border: none;' width='15' height='15' alt='Skype Me?!' />" + jsonobj.user + "さんからcall</a>";
        //html += "<br />" + jsonobj.manager + ":" + jsonobj.assign_mid;
        html += "</div>";

        $call.append(($call.val()?"\n":'') + html);
        $call[0].scrollTop = $call[0].scrollHeight - $call[0].clientHeight;
    }

    //busy 自分以外への通知です////////////////////////////////////////////////////
    if(jsonobj.busy){
        $("#call"+jsonobj.cid).attr("disabled", "disabled");
        $("#call"+jsonobj.cid).attr("value", jsonobj.manager + "が担当");
        //担当
        if(jsonobj.assign_mid == login_mid){
            //sound
            stopSounds();
        }
    }

    //finish 自分以外への通知です////////////////////////////////////////////////////
    if(jsonobj.finish){
        $("#finish"+jsonobj.cid).attr("disabled", "disabled");
        $("#finish"+jsonobj.cid).attr("value", jsonobj.manager + "が担当");
        stopSounds();
    }
}

function send( text ) {
    //var mes = text + ":login_mid";
    //Server.send( 'message', mes );
    Server.send( 'message', text );
}

function busy( text ) {
    Server.send( 'message', text );
}

function finish( text ) {
    Server.send( 'message', text );
}

$(".button_busy").live("click", function(){
    if ( $(this).attr('data') ) {
        busy( $(this).attr('data') );
        $(this).attr("disabled", "disabled");
        //sound
        stopSounds();
        return false;
    }
});

$(".button_finish").live("click", function(){
    var cid = $(this).attr('cid');
    $("#task" + cid).css("background-color","#ffffff");
    $("#task_detail" + cid).css("background-color","#ffffff");
    finish( $(this).attr('data') );
    $(this).attr("disabled", "disabled");
});

$(document).ready(function() {
    log('{"log":"Connecting..."}');

    Server = new FancyWebSocket('ws://' + ws_domain + ':9300');
    $('#message').keypress(function(e) {
        var mes = this;
        $(document).ready(function(){
            $("#button1").click(function(){
                if ( mes.value ) {
                    //log( 'You: ' + mes.value );
                    log('{"log":"You - ' + mes.value + '"}');
                    send( '{"type":"message","message":"' + manager_given_name + '-' + mes.value + '"}' );
                    $(mes).val('');
                }
            });
        });
    });

    //Let the user know we're connected
    Server.bind('open', function() {
        log('{"log":"Connected."}');
    });

    //OH NOES! Disconnection occurred.
    Server.bind('close', function( data ) {
        log('{"log":"Disconnected."}');
    });

    //Log any messages sent from server
    Server.bind('message', function( payload ) {
        log( payload );
    });

    Server.connect();
});