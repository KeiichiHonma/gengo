<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
{include file="include/system/seo.inc"}
<link type="text/css" rel="stylesheet" href="/css/system/contents.css" />
<link type="text/css" rel="stylesheet" href="/css/system/support.css" />
{include file="include/system/js.inc"}
<link rel="shortcut icon" href="/img/common/favicon.ico" type="image/x-icon" />
<link rel="icon" href="/img/common/favicon.ico" type="image/x-icon" />
</head>
<body>
<div id="wrapper">
<div id="page">
<div id="main_l">
{include file="include/system/logout.inc"}
<div id="roof_l_white">
    <div class="inside_l">
        {include file="include/system/navi.inc"}
        <h2 class="h_title">ユーザー一覧</h2>
        {*管理者のみ*}{if $login_type == $smarty.const.TYPE_M_ADMIN}<a href="{$smarty.const.ADVISERURL}/system/user/entry/input">登録する</a>{/if}
        {if $user}
            {include file="include/system/sp.inc"}
            <dl class="user_list">
                <dd class="index_line">
                    <dl>
                        <dd class="name_title">ユーザー名</dd>
                        <dd class="domain_title">&nbsp;</dd>
                        <dd class="directory_title">ディレクトリ名</dd>
                        <dd class="url_title">クロールURL</dd>
                    </dl>
                </dd>
        {foreach from=$user key="key" item="value" name="user"}
                <dd class="line">
                    <dl>
                        <dd class="name"><a href="{$smarty.const.ADVISERURL}/system/user/view/uid/{$value._id}">{$value.col_name}</a></dd>
                        <dd class="common"><a href="{$smarty.const.ADVISERURL}/system/seo/index/uid/{$value._id}">SEO一覧</a></dd>
                        <dd class="directory">{$value.col_directory}</dd>
                        <dd class="url"><a href="{$value.col_url}" target"_blank">{$value.col_url|make_strim:70}</a></dd>
                    </dl>
                </dd>
        {/foreach}
            </dl>
            {include file="include/system/sp.inc"}
        {else}
        <br />ユーザーが存在しません。
        {/if}
    </div>
</div>
</div>
</div>
</div>
</body>
</html>
