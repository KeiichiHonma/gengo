<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xml:lang="ja" xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
  </head>
  <body>
    <div id="wrapper">
      <div id="container">
        <div id="e_main">
            <h2 class="h_title">エラー</h2>

            <div id="error_box">
{foreach from=$errorlist key="key" item="value" name="errorlist"}
{$value|nl2br}<br />
{/foreach}
            </div>
        </div>
      </div>
    </div>
  </body>
</html>