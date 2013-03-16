<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

    <!-- Basic Page Needs
  ================================================== -->
    <meta charset="utf-8">
    <title>管理画面</title>
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
    <link rel="apple-touch-icon-precomposed" href="/img/apple-touch-icon.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/img/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/img/apple-touch-icon-114x114.png">
</head>
<body class="body-image">
    <div class="container">
        <div class="one columns">
            <h1 class="remove-bottom logo"><img src="/img/logo.png"></h1>
        </div>
        <p>管理画面</p>

{if isset($error.mail) || isset($error.text)}

{if isset($error.mail)}<p class="error_alert">{$error.mail}</p>{/if}
{if isset($error.password)}<p class="error_alert">{$error.password}</p>{/if}

{/if}
        <div id="box" class="box"  style="margin-top: 5px;margin-bottom: 5px">
            <form id="gengo_login" name="gengo_login" action="{$smarty.const.GENGOURL}/system/login" method="post" onsubmit="return login_remaind()">

<table class="login-table">
    <tr>
        <td class="login-td">メール</td>
        <td><input type="text" name="mail" id="mail" class="login-input login-input-line"  value="{if $smarty.post.mail}{$smarty.post.mail|escape}{/if}" /></td>
    </tr>
    <tr>
        <td class="login-td">パスワード</td>
        <td><input type="password" name="password" id="password" class="login-input login-input-line"  value="{if $smarty.post.password}{$smarty.post.password|escape}{/if}" /></td>
    </tr>
    <tr>
        <td colspan="2" class="login-td" align="center" style="padding-top:5px;"><input type="hidden" name="csrf_ticket" value="{$csrf_ticket}" /><input type="submit" value="ログイン" /></td>
    </tr>

</table>
            </form>
        </div>

    </div><!-- container -->
</body>
</html>