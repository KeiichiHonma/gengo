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
        <h2 class="h_title">マネージャー情報変更</h2>
        <p class="m_b10">以下の項目を入力して[変更]ボタンをクリックしてください。<span class="attention">＊</span>の項目は必須となります。</p>
        <form id="adviserForm" name="adviserForm" action= "{$smarty.const.ADVISERURL}/system/manager/edit/input/mid/{$manager.0._id}" method="post">

        <table id="suggest">
        <tr>
        <th colspan="2">マネージャー情報</th>
        </tr>

        <tr>
        <td width="150" valign="top">{"メールアドレス"|error_bold:$error.mail}</td>
        <td valign="top">
        {$error.mail|error_message}<input type="text" name="mail" value="{$smarty.post.mail}" class="form_text_common" /></td>
        </tr>

        <tr>
        <td width="150" valign="top">{"表示名"|error_bold:$error.given_name}</td>
        <td valign="top">
        {$error.given_name|error_message}<input type="text" name="given_name" value="{$smarty.post.given_name}" class="form_text_common" /></td>
        </tr>

        <tr>
        <td width="150" valign="top">{"有効/停止"|error_bold:$error.validate}<span class="attention">＊</span></td>
        <td valign="top">
        {$error.validate|error_message}
        <input type="radio" name="validate"{if strcasecmp($smarty.post.validate,$smarty.const.VALIDATE_ALLOW) == 0} checked{/if} value="{$smarty.const.VALIDATE_ALLOW}">有効
        <input type="radio" name="validate"{if strcasecmp($smarty.post.validate,$smarty.const.VALIDATE_DENY) == 0} checked{/if} value="{$smarty.const.VALIDATE_DENY}">停止
        </td>
        </tr>
        </table>

        <div id="form_btn">
        <input type="hidden" name="csrf_ticket" value="{$csrf_ticket}" />
        <input type="hidden" name="operation" value="check" />
        <input type="hidden" name="mid" value="{$manager.0._id}" />
        <input type="image" src="/img/system/b_kakunin.gif" value="submit" class="btn" onClick="return form_confirm(this)" />
        </div>
        </form>
    </div>
</div>
</div>
</div>
</div>
</body>
</html>
