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
        <h2 class="h_title">ユーザー管理</h2>
        <div id="infomation">
        <ul>
        <li><a href="{$smarty.const.GENGOURL}/system/user/entry/input">ユーザー追加</a></li>
        </ul>
        </div>
<h2 class="h_title">ユーザー一覧</h2>

        <table border="0" cellpadding="0" cellspacing="0" id="qatable_l">
        <tr>
        <th width="120" class="p_l10">操作</th>
        <th width="80">有効/無効</th>
        <th>ユーザー名</th>
        <th>スカイプ名</th>
        </tr>
{foreach from=$user key="key" item="value" name="user"}
        <tr>
        <td width="120" class="title"><a href="{$smarty.const.GENGOURL}/system/user/view/mid/{$value._id}">詳細</a>&nbsp;<a href="{$smarty.const.GENGOURL}/system/user/drop/input/mid/{$value._id}">削除</a></td>
         <td width="80">
{if strcasecmp($value.col_validate,$smarty.const.VALIDATE_ALLOW) == 0}
        有効
{elseif strcasecmp($value.col_validate,$smarty.const.VALIDATE_DENY) == 0}
        <b>無効</b>
{/if}
        </td>
        <td>{$value.col_given_name}</td>
        <td>{$value.col_skype_name}</td>
        </tr>
{/foreach}
        </table>
    </div>
</div>
</div>
</div>
</div>
</body>
</html>
