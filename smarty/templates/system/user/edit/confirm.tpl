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
        <h2 class="h_title">ユーザー変更</h2>
        <p class="m_b10">以下の項目を確認して[変更]ボタンをクリックしてください。</p>
        <form id="gengoForm" name="gengoForm" action= "{$smarty.const.GENGOURL}/system/user/edit/input/mid/{$user.0._id}" method="post">

        <table id="suggest">
        <tr>
        <th colspan="2">ユーザー情報</th>
        </tr>

        <tr>
        <td width="150" valign="top">表示名</td>
        <td valign="top">
        <input type="hidden" name="given_name" value="{$smarty.post.given_name}" />
        {$smarty.post.given_name}
        </td>
        </tr>

        <tr>
        <td width="150" valign="top">メールアドレス</td>
        <td valign="top">
        <input type="hidden" name="mail" value="{$smarty.post.mail}" />
        {$smarty.post.mail}
        </td>
        </tr>

        <tr>
        <td width="150" valign="top">有効/停止</td>
        <td valign="top">
        <input type="hidden" name="validate" value="{$smarty.post.validate}" />
        {if strcasecmp($smarty.post.validate,$smarty.const.VALIDATE_ALLOW) == 0}
        有効
        {else}
        停止
        {/if}
        </td>
        </tr>

        </table>

        <div id="form_btn">
        <input type="hidden" name="csrf_ticket" value="{$csrf_ticket}" />
        <input type="hidden" name="operation" value="" />
        <input type="hidden" name="mid" value="{$user.0._id}" />
        <input type="image" src="/img/system/b_modoru.gif" value="submit" class="btn" onClick="return form_back()" />
        <input type="image" src="/img/system/b_henkou.gif" value="submit" class="btn" onClick="return form_regist()" />
        </div>
    </form>
    </div>
</div>
</div>
</div>
</div>
</body>
</html>
