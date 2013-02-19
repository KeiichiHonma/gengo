<!doctype html>  

<!--[if IEMobile 7 ]><html class="no-js iem7" manifest="default.appcache?v=1"><![endif]-->
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
    
    <head>
        <meta charset="utf-8">
        <title>user-index</title>
        <meta name="description" content="user-index" />
        <meta name="keywords" content="user" />
        <meta name="author" content="81">
        <meta name="robots" content="index,follow"/>
        
        <!-- Mobile Specific Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 

        <!-- Stylesheets -->
        <link rel="stylesheet" href="/css/style_ele.css">
        <link rel="stylesheet" href="/css/skeleton_ele.css">
        <link rel="stylesheet" href="/css/user.css" type="text/css" media="all" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

        <!-- jQuery Scripts -->
        <script src="/js/app.js"></script>
{literal}
    <style>
        #body {max-width:800px;margin:auto}
        #log {width:100%;height:500px;border:1px solid #CCC;overflow: scroll;background-color:#ffffff;}
        #call {width:100%;height:500px;border:1px solid #CCC;overflow: scroll;background-color:#ffffff;}
        #message {width:100%;line-height:20px}
        .call {border-top:1px solid #CCC;border-bottom:1px solid #CCC;margin:5px 0px 5px 0px;padding:10px;}
        .recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}
    </style>
{/literal}
    
    <script language="javascript" src="/js/jsound.js"></script>
    
    <script src="/js/fancywebsocket.js"></script>
    <script>
        var Server;

        function log( text ) {ldelim}
            try {ldelim}
                var jsonobj = jQuery.parseJSON( text );
            {rdelim} catch (e) {ldelim}
                // パースエラー時の対応をここで
                //alert(3);
                //console.log();
            {rdelim}
            
            //log////////////////////////////////////////////////////
            $log = $('#log');
            
            if(jsonobj.log){ldelim}
                $log.append(($log.val()?"\n":'') + jsonobj.log + "<br />");
                $log[0].scrollTop = $log[0].scrollHeight - $log[0].clientHeight;
            {rdelim}
            
            //call////////////////////////////////////////////////////
            $call = $('#call');
            if(jsonobj.call){ldelim}
                $call.append(($call.val()?"\n":'') + "<div class='col'><a href='skype:" + jsonobj.skype + "?call'><img src='/img/call.png' style='border: none;' width='15' height='15' alt='Skype Me?!' />" + jsonobj.skype + "</a></div><div class='col'>" + jsonobj.user + "</div><div class='col'>" + jsonobj.manager + ":" + jsonobj.mid + "</div><div class='col'><input type='submit' data='{ldelim}\"type\":\"busy\",\"cid\":\"" + jsonobj.cid + "\",\"mid\":\"{$mid}\",\"old_mid\":\"" + jsonobj.mid + "\",\"manager\":\"{$manager}\"{rdelim}' id='call" + jsonobj.cid + "' class='button_busy' value='担当する' /></div>");
                $call[0].scrollTop = $call[0].scrollHeight - $call[0].clientHeight;
            {rdelim}

            //busy////////////////////////////////////////////////////
            if(jsonobj.busy){ldelim}
                $("#call"+jsonobj.cid).attr("disabled", "disabled");
                $("#call"+jsonobj.cid).attr("value", jsonobj.manager + "が担当");
            {rdelim}
            
        {rdelim}

        function send( text ) {ldelim}
            //var mes = text + ":{$mid}";
            //Server.send( 'message', mes );
            Server.send( 'message', text );
        {rdelim}

        function busy( text ) {ldelim}
            Server.send( 'message', text );
        {rdelim}

        $(".button_busy").live("click", function(){ldelim}
            if ( $(this).attr('data') ) {ldelim}
                busy( $(this).attr('data') );
                $(this).attr("disabled", "disabled");
                return false;
            {rdelim}
        {rdelim});

        $(document).ready(function() {ldelim}
            //log('Connecting...<br />');
            log('{ldelim}"log":"Connecting..."{rdelim}');

            Server = new FancyWebSocket('ws://{$domain}:9300');
            $('#message').keypress(function(e) {ldelim}
                var mes = this;
                $(document).ready(function(){ldelim}
                    $("#button1").click(function(){ldelim}
                        if ( mes.value ) {ldelim}
                            //log( 'You: ' + mes.value );
                            log('{ldelim}"log":"You - ' + mes.value + '"{rdelim}');
                            //send( mes.value );
                            //send( '{ldelim}"type":"message","message":"' + mes.value + '"{rdelim}' );
                            send( '{ldelim}"type":"message","message":"{$manager}-' + mes.value + '"{rdelim}' );
                            $(mes).val('');
                        {rdelim}
                    {rdelim});
                {rdelim});
            {rdelim});

            //Let the user know we're connected
            Server.bind('open', function() {ldelim}
                //log( "Connected.<br />" );
                log('{ldelim}"log":"Connected."{rdelim}');
            {rdelim});

            //OH NOES! Disconnection occurred.
            Server.bind('close', function( data ) {ldelim}
                //log( "Disconnected.<br />" );
                log('{ldelim}"log":"Disconnected."{rdelim}');
            {rdelim});

            //Log any messages sent from server
            Server.bind('message', function( payload ) {ldelim}
                log( payload );
            {rdelim});

            Server.connect();
        {rdelim});
    </script>
    </head>

    <body class="body-image home blog">
現在のログイン{$mid}:{$manager}

<p><a class="button" href="#" clickSound="page">clickSound</a></p>

            <div class="container">
                <div class="sixteen columns logo">
                        <a href="/user/">
                        <img src="/img/logo_robo_3.png" alt="Eleventh Edition" />
                        </a>
                </div>

                <div class="ten columns">
                    <div class="section remove-top remove-bottom">
                        <div class="row">
                            <div id='call' name='call'>
                            <div class='col'>skype</div><div class='col'>user</div><div class='col'>担当</div><div class='col'>ボタン</div>
                            </div>
                            
                            <div>
                                <label for="message">メッセージ</label>
                                <input type="text" name="message" id="message" value="" class="required requiredField" />
                            </div>
                        </div>
            
                        <div class="row">
                                {*<input type='text' id='message' name='message' />*}
                                {*<button type="submit"><span>メッセージを送信</span></button>*}
                                <input type="button" value="メッセージを送信" id="button1" class="button" />
                        </div>
                    </div>
                </div>

                <div class="five columns offset-by-one">

                    <div class="section remove-top">
                        
                        <div id='log' name='log'></div>
                        <p><span style="color: #1fb4dd;">緊急連絡先:</span><br />
                        03-5428-8307</p>
                        <p><span style="color: #1fb4dd;">Email:</span><br />
                        keiichi-honma@813.co.jp</p>
                    </div>

                </div>

                <div class="sixteen columns content">

                    <div class="clearfix section" id="footer">

    
                        <p>&copy; 2013 81</p>

                        <a href="#top">
                            <img src="http://www.eleventhedition.com/images/nav/up.png" alt="Back To Top" />
                        </a>

                    </div>

                </div>

            </div>    

        <!-- HTML5 Shiv -->
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
           
        <!-- Infield Label -->
        <script src='/js/jquery.infieldlabel.js'></script>
        
        <!-- Modernizr -->
        <script src="/js/modernizr-1.7.min.js"></script>    
        
        <!--[if lt IE 7 ]>
            <script src="/js/ie/dd_belatedpng.js"></script>
            <script>DD_belatedPNG.fix("img, .png_bg");</script>
          <![endif]-->
    </body>

</html>