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

        <link href="/css/iphone.css" rel="stylesheet" type="text/css" media="only screen and (min-width: 0px) and (max-width: 910px)" />
        <link href="/css/desktop.css" rel="stylesheet" type="text/css" media="only screen and (min-width: 911px)" />

        <!-- Icons -->
        <link rel="shortcut icon" href="http://www.eleventhedition.com/images/icons/favicon.ico">
        <link rel="apple-touch-icon" href="http://www.eleventhedition.com/images/icons/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="http://www.eleventhedition.com/images/icons/apple-touch-icon-72x72.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="http://www.eleventhedition.com/images/icons/apple-touch-icon-114x114.png" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

        <!-- jQuery Scripts -->
        <script src="/js/app.js"></script>

        {literal}
            <style type="text/css">.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}</style>
        {/literal}
    </head>

    <body class="body-image home blog">

    <script src="/js/fancywebsocket.js"></script>
    <script>
        var Server = null;



        //var Server;


        function StartCounter () {ldelim}
            var ws_connect_timer = setInterval(function(){ldelim}
                //console.log(Server.conn.readyState);
                if(Server == null || Server.conn.readyState != 1){ldelim}
                    //Server = new WebSocket("ws://localhost:8080");
                    //alert(4);
                    Server = null;
                    Server = new FancyWebSocket('ws://{$domain}:9300');
                    Server.connect();
                {rdelim}
            {rdelim}, 5000);
        {rdelim}

        function log( text ) {ldelim}
            //$log = $('#log');
            //Add text to log
            //$log.append(($log.val()?"\n":'')+text);
            //Autoscroll
            //$log[0].scrollTop = $log[0].scrollHeight - $log[0].clientHeight;
        {rdelim}

        function send( text ) {ldelim}
            Server.send( 'message', text );
        {rdelim}

        $(document).ready(function() {ldelim}
            Server = new FancyWebSocket('ws://{$domain}:9300');

            $(".disconnect").click(function(){ldelim}
                Server.disconnect( );
            {rdelim});

            $(".button_en").click(function(){ldelim}

                if ( $('#message_en').val() ) {ldelim}
                    send( $('#message_en').val() );
                    alert('英語の通訳者を呼び出し中...');
                    return false;
                {rdelim}
            {rdelim});

            $(".button_cn").click(function(){ldelim}
                if ( $('#message_cn').val() ) {ldelim}
                    send( $('#message_cn').val() );
                    alert('中国語の通訳者を呼び出し中...');
                    return false;
                {rdelim}
            {rdelim});

            $(".button_kr").click(function(){ldelim}
                if ( $('#message_kr').val() ) {ldelim}
                    send( $('#message_kr').val() );
                    alert('韓国の通訳者を呼び出し中...');
                    return false;
                {rdelim}
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
                //log( payload );
            {rdelim});

            Server.connect();
            StartCounter();
            
        {rdelim});
    </script>

            <div class="container">    

                <div class="sixteen columns logo">
                        <a href="/user/">
                        <img src="/img/logo_robo_3.png" alt="Eleventh Edition" />
                        </a>

                        <div class="basecamp">
                        <p>ツタヤ渋谷店様</p>
                        </div>
                </div>
                
                <div class="sixteen columns content">
                    <div class="section">
                            <div class="one-third column thumbnail alpha">
                                <input type='hidden' id='message_en' name='message_en' value='{$message_en}' />
                                <a href="#" class="button_en" onclick="return false;">
                                <img src="/img/english.png" alt="English" />

                                <div class="details">
                                <h3>英語の通訳者</h3>
                                </div>

                                </a>
                            </div>
                            
                            <a href="#" class="disconnect" onclick="return false;">disconnect</a>
                            
                            <div class="one-third column thumbnail">
                                <input type='hidden' id='message_cn' name='message_cn' value='{$message_cn}' />
                                <a href="#" class="button_cn" onclick="return false;">
                                <img src="/img/china.png" alt="China" />

                                <div class="details">
                                <h3>中国語の通訳者</h3>
                                </div>

                                </a>
                            </div>

                            <div class="one-third column thumbnail omega">
                                <input type='hidden' id='message_kr' name='message_kr' value='{$message_kr}' />
                                <a href="#" class="button_kr" onclick="return false;">
                                <img src="/img/korea.png" alt="Korea" />

                                <div class="details">
                                <h3>韓国語の翻訳者</h3>
                                </div>

                                </a>
                            </div>
                    </div>

                    <div class="section clearfix" id="about">

                    <h1>タップすると外国語+日本語が話せるあなた専用の通訳に繋がります。</h1>

                        <p class="background">
せっかく御来店頂いた、お客様と言語の問題でコミュニケーションが取れない、といったケースは少なからずあると思います。<br />
そんな時,いつでも、何度でも呼び出せて3つの言語が自在に使える通訳がいたら便利だと思いませんか？そんな声にお応えするのが、タップリンガルです！<br />
テレビ電話(Skype 又は Facetime)を利用する事で、顔の見える通訳を提供致します。<br />通訳に関しても表情が見えることでより安心してご利用頂けます。
                        </p>

                        <div class="row clearfix">
                            <div class="one-third column alpha">
                                <h2>対応言語</h2>
                                <img src="/img/ttl_lang.png" alt="Time" width="300" height="200" />
                                <p>
                                英語<br />
                                中国語<br />
                                韓国語
                                </p>
                            </div>

                            <div class="one-third column">

                                <h2>対応時間</h2>
                                <img src="/img/ttl_time.png" alt="Time" width="300" height="200" />
                                <p>
                                年中無休<br />
                                対応時間は9時～22時
                                </p>
                            </div>

                            <div class="one-third column omega">
                                <h2>対応機種</h2>
                                <img src="/img/ttl_mobile.png" alt="Time" width="300" height="200" />
                                <p>
                                iPad (2以降）<br />
                                iPhone（4以降）<br />
                                iPod Touch（第4世代以降）
                                </p>
                            </div>

                        </div>
            
                    </div>
                </div>

        <div class="sixteen columns">
            <div id="social" class="section center">
            <hr />
            <a href="/user/setting" class="button home"><img src="/img/setting.png" alt="Time" width="22" height="22" />&nbsp;設定する</a>
            </div>
        </div>

                <div class="sixteen columns">

                    <div id="nav">

                        <ul>
                            <li class="first"><a href="http://www.eleventhedition.com/about">サポート</a></li>
                            <li class=""><a href="/user/setting">設定</a></li>
                            <li class="last"><a href="http://www.eleventhedition.com/contact">運営</a></li>
                        </ul>

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