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
        <h2 class="h_title">SEO設定</h2>
        {if $user && $html_files}
            <dl class="user_list">
                <dd class="index_line">
                    <dl>
                        <dd class="absolute_title">絶対パス</dd>
                        <dd>&nbsp;</dd>
                    </dl>
                </dd>
        {foreach from=$html_files key="absolute_html_file" item="value" name="html_files"}
                <dd class="line">
                    <dl>
                        {if $value !== FALSE}
                        <dd class="absolute"><a href="{$smarty.const.ADVISERURL}/system/seo/view/sid/{$value._id}">{$absolute_html_file}</a></dd>
                        <dd><a href="{$smarty.const.ADVISERURL}/system/seo/edit/input/uid/{$user.0._id}/sid/{$value._id}">設定する</a></dd>
                        {else}
                        <dd class="absolute">{$absolute_html_file}</dd>
                        <dd><a href="{$smarty.const.ADVISERURL}/system/seo/entry/input/uid/{$user.0._id}?absolute_html_file={$absolute_html_file|escape|urlencode}">設定する</a>※現在設定がありません</dd>
                        {/if}
                    </dl>
                </dd>
        {/foreach}
            </dl>
        {else}
        <br />SEO情報が存在しません。
        {/if}
        
        {if $user && $trash_seo}
            <br />
            <a href="{$smarty.const.ADVISERURL}/system/seo/clean/uid/{$user.0._id}">クリーンアップする</a>
            <dl class="user_list">
                <dd class="index_line">
                    <dl>
                        <dd class="absolute_title">実体がなくなったファイル</dd>
                        <dd>&nbsp;</dd>
                    </dl>
                </dd>
        {foreach from=$trash_seo key="absolute_html_file" item="value" name="trash_seo"}
                <dd class="line">
                    <dl>
                        <dd class="absolute">{$absolute_html_file}</dd>
                        <dd>実体ファイルがありません。</dd>
                    </dl>
                </dd>
        {/foreach}
            </dl>
        {/if}


    </div>
</div>
</div>
</div>
</div>
</body>
</html>
