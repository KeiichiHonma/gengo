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
    <link rel="stylesheet" href="/css/common.css" type="text/css" media="all" />
    <link rel="stylesheet" href="/css/style_ele.css" />
    <link rel="stylesheet" href="/css/skeleton_ele.css" />
    <link rel="stylesheet" href="/css/manager.css" type="text/css" media="all" />
    
    <script language="javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script language="javascript" src="/js/app.js"></script>
    <script language="javascript" src="/js/jsound.js"></script>
    <script language="javascript" src="/js/fancywebsocket.js"></script>
    <script>
        var login_mid          = {$mid};
        var manager_given_name = "{$manager_given_name}";
        var reader_type        = {$smarty.const.TYPE_M_READER};
        var manager_type       = {$manager_type};
        var ws_domain          = "{$domain}";
        
    </script>
    <script language="javascript" src="/js/ws.js"></script>
</head>

<body class="body-image home blog"><span id="startSound"></span>
    <div class="container">
        <div class="sixteen columns logo">
        <a href="/user/"><img src="/img/logo_system.png" alt="" /></a>
        <p class="logo_text">
        マネージャ:{$manager_given_name}-{$mid}<br /><a href="/system/logout">logout</a> : <a href="javascript:void(0);" onclick="stopSounds();">stop sounds</a>{*<a class="button" href="#" onclick="stopSounds();">stop all sounds</a>*}
        
        </p>

        </div>

        <div class="ten columns">
            <div class="section remove-top remove-bottom">
                <div class="row">
                    <div id='call' name='call'>
                        {if $call}
                            {foreach from=$call key="key" item="value" name="call"}
                                <div id="task{$value.call_id}" class="task new"><img src="/img/{if strcasecmp($value.call_type,1) == 0}china_task.png{else}english_task.png{/if}" style="border: none;" width="70" height="70" alt="" /></div>
                                <div id="task_detail{$value.call_id}" class="task_detail new">

                                <input type="submit" data='{ldelim}"type":"busy","cid":"{$value.call_id}","mid":"{$mid}","assign_mid":"{$value.col_mid}","manager":"{$value.manager_given_name}"{rdelim}' cid="{$value.call_id}" id="call{$value.call_id}" class="button_busy" {if strcasecmp($value.col_assign,0) == 0}disabled="disabled" value="担当:{$value.manager_given_name}"{else} value="担当"{/if} />
                                {$value.col_ctime|make_date:"Y/n/d H:i:s"}

                                <input type="submit" {if strcasecmp($value.col_assign,1) == 0 || ( strcasecmp($value.col_assign,0) == 0 && strcasecmp($value.col_finish,1) == 0 && $value.col_mid != $mid ) }disabled="disabled"{/if} data='{ldelim}"type":"finish","cid":"{$value.call_id}","mid":"{$value.col_mid}","manager":"{$value.manager_given_name}"{rdelim}' cid="{$value.call_id}" id="finish{$value.call_id}" class="button_finish" value="完了" /><br />

                                <span style="font-size:15px;"><a href="facetime://{$value.col_facetime}">{$value.user_given_name}さんからcall</a></span>
                                </div>
                            {/foreach}
                        {/if}
                    </div>
                    
                    <div>
                        <label for="message">メッセージ</label>
                        <input type="text" name="message" id="message" value="" class="required requiredField" />
                    </div>
                </div>
    
                <div class="row">
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