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
        {if $user}
        <h2 class="h_title">ユーザー詳細</h2>
        <div id="infomation">
        <ul>
        <li><a href="{$smarty.const.ADVISERURL}/system/user/edit/input/uid/{$user.0._id}">変更する</a></li>
        <li><a href="{$smarty.const.ADVISERURL}/system/seo/index/uid/{$user.0._id}">SEO設定</a></li>
        </ul>
        </div>
        {foreach from=$form key="group_name" item="form_data" name="form_data"}
        <table id="suggest">
        <tr>
        <th colspan="2">{$group_name}</th>
        </tr>
        {foreach from=$form_data key="form_name" item="form_setting" name="form_setting"}
        {$form_name|make_form:$form_setting:$error:$smarty.const.SMARTY_BOOL_OFF:$smarty.const.SMARTY_BOOL_ON}
        {/foreach}
        </table>
        {/foreach}
        {else}
        ユーザーが存在しません。
        {/if}
    </div>
</div>
</div>
</div>
</div>
</body>
</html>
