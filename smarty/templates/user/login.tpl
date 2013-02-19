<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

    <!-- Basic Page Needs
  ================================================== -->
    <meta charset="utf-8">
    <title>user-login</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Mobile Specific Metas
  ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
  ================================================== -->
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/skeleton_login.css">
    <link rel="stylesheet" href="/css/layout.css">
    <link rel="stylesheet" href="/css/user2.css">
    <link rel="stylesheet" type="text/css" href="/css/style4.css" />

    <link href="/css/iphone.css" rel="stylesheet" type="text/css" media="only screen and (min-width: 0px) and (max-width: 320px)" />
    <link href="/css/desktop.css" rel="stylesheet" type="text/css" media="only screen and (min-width: 321px)" />
{*    <link href="/css/tablet.css" rel="stylesheet" type="text/css" media="only screen and (min-width: 321px) and (max-width: 910px)" />
    <link href="/css/desktop.css" rel="stylesheet" type="text/css" media="only screen and (min-width: 911px)" />*}
    {*<link href="/css/iphone.css" rel="stylesheet" type="text/css" media="all" >*}

    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Favicons
    ================================================== -->
    <link rel="shortcut icon" href="/img/favicon.ico">
    <link rel="apple-touch-icon" href="/img/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/img/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/img/apple-touch-icon-114x114.png">

</head>
<body class="body-image">
{*    <div id="home">
    <div class="main">*}
    <!-- Primary Page Layout
    ================================================== -->

    <!-- Delete everything in this .container and get started on your own site! -->

    <div class="container">
        <div class="one columns">
            <h1 class="remove-bottom logo"><img src="/img/logo_robo4.png"></h1>
            
            <h5>Version 1.2</h5>
            <hr />
        </div>

        <h3>About Skeleton?</h3>
        <p>Skeleton is a small</p>

        <div id="box" class="box"  style="margin-bottom: 20px">
            <form id="gengo_login" name="gengo_login" action="{$smarty.const.GENGOURL}/user/login" method="post">
            {$error.mail|error_message}<input type="text" name="mail" id="login_name" class="login-input login-input-line" defaultValue="ログイン名"  value="{if $smarty.post.mail}{$smarty.post.mail|escape}{else}ログイン名{/if}" />
            {$error.password|error_message}<input type="password" name="password" id="password" class="login-input login-input-line" defaultValue="パスワード"  value="{if $smarty.post.password}{$smarty.post.password|escape}{/if}" />
            <input type="hidden" name="csrf_ticket" value="{$csrf_ticket}" />
            <div id="login_button"><a class="a_demo_four" href="#" onclick="f=document.gengo_login;f.submit();return false;">サインイン</a></div>
            </form>
        </div>

    </div><!-- container -->
    
{*    </div>
</div>*}
<!-- End Document
================================================== -->
</body>
</html>