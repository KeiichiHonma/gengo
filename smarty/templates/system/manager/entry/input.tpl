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
    <h2 class="h_title">マネージャー（店舗アカウント）登録</h2>
    <p class="m_b10">以下の項目を入力して[登録]ボタンをクリックしてください。<span class="attention">＊</span>の項目は必須となります。</p>
    <form id="adviserForm" name="adviserForm" action= "{$smarty.const.ADVISERURL}/system/manager/entry/input" method="post">

        <table id="suggest">
        <tr>
        <td width="150" valign="top">タイプ選択</td>
        <td valign="top">
        <input type="radio" name="authority"{if strcasecmp($smarty.post.authority,"manager") == 0} checked{/if} value="manager">管理者
        <input type="radio" name="authority"{if !isset($smarty.post.authority) || strcasecmp($smarty.post.type,"shop") == 0} checked{/if} value="shop">店舗管理者
        </td>
        </tr>
        </table>

    {foreach from=$form key="group_name" item="form_data" name="form_data"}
    <table id="suggest">
    <tr>
    <th colspan="2">{$group_name}</th>
    </tr>
    {foreach from=$form_data key="form_name" item="form_setting" name="form_setting"}
    {$form_name|make_form:$form_setting:$error:$smarty.const.SMARTY_BOOL_OFF:$smarty.const.SMARTY_BOOL_OFF}
    {/foreach}
    </table>
    {/foreach}

    <div id="form_btn">
    <input type="hidden" name="csrf_ticket" value="{$csrf_ticket}" />
    <input type="hidden" name="operation" value="check" />
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
