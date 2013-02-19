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
<div id="page">
<div id="main_l">
<div id="roof_l_white">
    <div class="inside_l">

    <form action="{$smarty.const.GENGOURL}/system/login" method="post">
    <div id="one_parts">
     <div id="action">
      <div class="center_block">
       <div class="center_list">
        <div class="shop">{$smarty.const.SITE_NAME}</div>
        <div class="br">&nbsp;</div>
        <table class="system_login">
         <tr>
          <td>{"メールアドレス"|error_bold:$error.mail}</td>
          <td>
           {$error.mail|error_message}<input type="text" size="40" name="mail" value="{if $smarty.post.mail}{$smarty.post.mail|escape}{/if}">
          </td>
         </tr>
         <tr>
          <td>{"パスワード"|error_bold:$error.password}</td>
          <td>
          {$error.password|error_message}<input type="password" size="40" name="password" value="">
          </td>
         </tr>
         <tr>
          <td>&nbsp;</td>
          <td><input type="hidden" name="csrf_ticket" value="{$csrf_ticket}" /><input type="image" src="/img/system/b_login.gif" value="submit" class="btn" /></td>
         </tr>
        </table>

       </div>
      </div>
     </div><!--action_end--->
    </div>
    </form>
    </div>
</div>
</div>
</div>
</div>
{*フッター*}

</body>
</html>
