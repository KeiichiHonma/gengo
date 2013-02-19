<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
{include file="include/system/seo.inc"}
{include file="include/system/css.inc"}
{include file="include/system/js.inc"}
<link rel="shortcut icon" href="/img/common/favicon.ico" type="image/x-icon" />
<link rel="icon" href="/img/common/favicon.ico" type="image/x-icon" />
</head>
<body>
<div id="wrapper">
{*サイトポジション*}
{include file="include/system/position.inc"}
<div id="page">
<div id="main_l">
<div id="roof_l_white">
    <div class="inside_l">
    {include file="include/system/navi.inc"}
        <h2 class="h_title">ユーザー詳細</h2>
        <div id="infomation">
        <ul>
        <li><a href="{$smarty.const.GENGOURL}/system/user/edit/input/mid/{$mid}">変更する</a></li>
        <li><a href="{$smarty.const.GENGOURL}/system/user/edit/password/input/mid/{$mid}">パスワードを変更する</a></li>
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

        <tr>
        <td width="150" valign="top">有効/停止</td>
        <td valign="top">
        {if strcasecmp($smarty.post.validate,$smarty.const.VALIDATE_ALLOW) == 0}
        有効
        {else}
        停止
        {/if}
        </td>
        </tr>
        </table>
        {/foreach}


    </div>
</div>
</div>
</div>
</div>
</body>
</html>
