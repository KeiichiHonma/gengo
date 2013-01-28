<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
{include file="include/system/seo.inc"}
{include file="include/system/css.inc"}
{include file="include/system/js.inc"}
<link rel="shortcut icon" href="/img/common/favicon.ico" type="image/x-icon" />
<link rel="icon" href="/img/common/favicon.ico" type="image/x-icon" />
<script type="text/javascript" src="/js/jquery-1.7.2.min"></script>
<script type="text/javascript" src="/js/post.js"></script>
</head>
<body>
<div id="wrapper">
<div id="page">
<div id="main_l">
{include file="include/system/logout.inc"}
<div id="roof_l_white" class="clearfix">
    <div class="inside_l">
    client
        <form>
            英語-client{$mid}<INPUT type="button" value="英語" onClick="ajaxPostFunc('0', '{$mid}');">
        </form>
        <form>
            韓国語-client{$mid}<INPUT type="button" value="韓国語" onClick="ajaxPostFunc('1', '{$mid}');">
        </form>
        <form>
            中国語-client{$mid}<INPUT type="button" value="中国語" onClick="ajaxPostFunc('2', '{$mid}');">
        </form>
    </div>
</div>
</div>
</div>
</div>
{*フッター*}

</body>
</html>
