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
{/literal}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="/js/fancywebsocket.js"></script>
    <script>
        var Server;

        function log( text ) {ldelim}
            $log = $('#log');
            //Add text to log
            $log.append(($log.val()?"\n":'')+text);
            //Autoscroll
            $log[0].scrollTop = $log[0].scrollHeight - $log[0].clientHeight;
        {rdelim}

        function send( text ) {ldelim}
            Server.send( 'message', text );
        {rdelim}

        $(document).ready(function() {ldelim}
            log('Connecting...');
            Server = new FancyWebSocket('ws://{$domain}:9300');
            $('#message').keypress(function(e) {ldelim}
                var mes = this;
                $(document).ready(function(){ldelim}
                    $("#button1").click(function(){ldelim}
                        if ( mes.value ) {ldelim}
                            log( 'You: ' + mes.value );
                            send( mes.value );

                            $(mes).val('');
                        {rdelim}
                    {rdelim});
                {rdelim});
            {rdelim});

            //Let the user know we're connected
            Server.bind('open', function() {ldelim}
                log( "Connected." );
            {rdelim});

            //OH NOES! Disconnection occurred.
            Server.bind('close', function( data ) {ldelim}
                log( "Disconnected." );
            {rdelim});

            //Log any messages sent from server
            Server.bind('message', function( payload ) {ldelim}
                log( payload );
            {rdelim});

            Server.connect();
        {rdelim});
    </script>

</head>

<body>
    <div id='body'>
        <textarea id='log' name='log' readonly='readonly'></textarea><br/>
        <input type='text' id='message' name='message' />
        <input type="button" value="ボタン1" id="button1">
    </div>
</body>

</html>