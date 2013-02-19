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
    <h2 class="h_title">パスワード変更</h2>
    <p class="m_b10">以下の項目を入力して[確認画面へ]ボタンをクリックしてください。<span class="attention">＊</span>の項目は必須となります。</p>
    <form id="gengoForm" name="gengoForm" action= "{$smarty.const.GENGOURL}/system/manager/edit/password/input/mid/{$manager.0._id}" method="post">

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

    <div id="form_btn">
    <input type="hidden" name="csrf_ticket" value="{$csrf_ticket}" />
    <input type="hidden" name="operation" value="" />
    <input type="hidden" name="mid" value="{$manager.0._id}" />
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
