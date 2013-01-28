<!doctype html>
<html>
<head>
    <meta charset='UTF-8' />
{literal}
    <style>
        input, textarea {border:1px solid #CCC;margin:0px;padding:0px}

        #body {max-width:800px;margin:auto}
        #log {width:100%;height:400px}
        #message {width:100%;line-height:20px}
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="/js/fancywebsocket.js"></script>
    <script>
        var Server;

        function log( text ) {
            $log = $('#log');
            //Add text to log
            $log.append(($log.val()?"\n":'')+text);
            //Autoscroll
            $log[0].scrollTop = $log[0].scrollHeight - $log[0].clientHeight;
        }

        function send( text ) {
            Server.send( 'message', text );
        }

        $(document).ready(function() {
            log('Connecting...');
            //Server = new FancyWebSocket('ws://127.0.0.1:9300');
            //Server = new FancyWebSocket('ws://192.168.0.5:9300');
            Server = new FancyWebSocket('ws://gengo.813.co.jp:9300');

            //$('#message').keypress(function(e) {
                //if ( e.keyCode == 13 && this.value ) {
                //if ( $('#submit').click() && this.value ) {
                    //log( 'You: ' + this.value );
                    //send( this.value );

                    //$(this).val('');
                //}
            //});
            
            $('#message').keypress(function(e) {
                var mes = this;
                $(document).ready(function(){
                    $("#button1").click(function(){
                        if ( mes.value ) {
                            log( 'You: ' + mes.value );
                            send( mes.value );

                            $(mes).val('');
                        }
                    });
                });
            });

            //Let the user know we're connected
            Server.bind('open', function() {
                log( "Connected." );
            });

            //OH NOES! Disconnection occurred.
            Server.bind('close', function( data ) {
                log( "Disconnected." );
            });

            //Log any messages sent from server
            Server.bind('message', function( payload ) {
                log( payload );
            });

            Server.connect();
        });
    </script>
{/literal}
</head>

<body>
    <div id='body'>
        <textarea id='log' name='log' readonly='readonly'></textarea><br/>
        <input type='text' id='message' name='message' />
        <input type="button" value="ボタン1" id="button1">
    </div>
</body>

</html>