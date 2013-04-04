<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

    <!-- Basic Page Needs
  ================================================== -->
    <meta charset="utf-8">
    <title>taplingual</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Mobile Specific Metas
  ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
  ================================================== -->
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/skeleton_login.css">
    <link rel="stylesheet" href="/css/layout.css">
    <link rel="stylesheet" href="/css/user2.css">
    <link rel="stylesheet" type="text/css" href="/css/style4.css" />

    <link href="/css/iphone.css" rel="stylesheet" type="text/css" media="only screen and (min-width: 0px) and (max-width: 320px)" />
    <link href="/css/desktop.css" rel="stylesheet" type="text/css" media="only screen and (min-width: 321px)" />
{*    <link href="/css/tablet.css" rel="stylesheet" type="text/css" media="only screen and (min-width: 321px) and (max-width: 910px)" />
    <link href="/css/desktop.css" rel="stylesheet" type="text/css" media="only screen and (min-width: 911px)" />*}
    {*<link href="/css/iphone.css" rel="stylesheet" type="text/css" media="all" >*}

    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
    <!-- Favicons
    ================================================== -->
    <link rel="shortcut icon" href="/img/favicon.ico">
    <link rel="apple-touch-icon-precomposed" href="/img/apple-touch-icon.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/img/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/img/apple-touch-icon-114x114.png">

    {*<script src="/js/login.js"></script>*}

</head>
<body class="body-image">
    <script>
    function login_remaind()
    {ldelim}

        // フォームから値を取得
        var mail = document.gengo_login.mail.value;
        var password  = document.gengo_login.password.value;

        /* ここらへんにvalidationの処理を入れたり... */
        //database();

        try {ldelim}
            if (window.openDatabase) {ldelim}
                var db = window.openDatabase("mydatabase", "1.0", "My Database", "1048576");
                if (!db) {ldelim}
                    //alert("データベースストレージが使えません。");
                {rdelim}else{ldelim}
                    //alert(111);
                {rdelim}
            {rdelim} else {ldelim}
                //alert("データベースストレージはサポートされていません。");
            {rdelim}
        {rdelim} catch (error) {ldelim}
            // ...
            //alert(error);
        {rdelim}

        //if ( document.gengo_login.save_password.checked == true )
        if ( document.gengo_login.save_password.value == 0 )
        {ldelim}
            db.transaction(
              function(tx) {ldelim}
                // テーブルがあるかな?
                tx.executeSql("SELECT count(*) FROM login", [],
                  function(tx, rs) {ldelim}
                    // テーブルあるよ
                    if ( rs.rows.item(0) == 0 )
                    {ldelim}
                      // テーブル初利用の場合は、追加
                      tx.executeSql('INSERT INTO login VALUES(1, ?, ?)', [mail, password], // escape?
                        function() {ldelim}{rdelim},
                        function(error) {ldelim}
                          alert('save failed: ' + error.message);
                        {rdelim}
                      );
                    {rdelim}
                    else
                    {ldelim}
                      // テーブル初利用じゃない場合は、更新
                      tx.executeSql('UPDATE login SET mail = ?, password = ? WHERE id = 1', [mail, password], // escape?
                        function() {ldelim}{rdelim},
                        function(error) {ldelim}
                          alert('update failed: ' + error.message);
                        {rdelim}
                      );
                    {rdelim}
                  {rdelim},
                  function(tx, error) {ldelim}
                    // テーブルないよ、テーブルつくろ
                    tx.executeSql('CREATE TABLE login (id INTEGER PRIMARY KEY, mail TEXT, password TEXT)', [],
                      function() {ldelim}
                      // テーブル初利用だから、追加
                        tx.executeSql('INSERT INTO login VALUES(1, ?, ?)', [mail, password], // escape?
                          function() {ldelim}{rdelim},
                          function(error) {ldelim}
                            alert('save failed: ' + error.message);
                          {rdelim}
                        );
                      {rdelim},
                      function(error) {ldelim}
                        alert('Database creation failed.' + error.message);
                      {rdelim}
                    );
                  {rdelim}
                );
              {rdelim}
            );
        {rdelim}
        else
        {ldelim}
            // チェックボックスにチェックがないときは、テーブル削除
            db.transaction(
              function(tx) {ldelim}
                tx.executeSql('DROP TABLE login', [],
                  function() {ldelim}{rdelim},
                  function(error) {ldelim}
                    //alert('delete failed: ' + error.message);
                  {rdelim}
                );
              {rdelim}
            );
        {rdelim}
    {rdelim}
    
    // ロード時に、データベースからメアドとパスワードを取得、フォームにセットする関数
    window.onload = function() {ldelim}
        //database();
        try {ldelim}
            if (window.openDatabase) {ldelim}
                var db = window.openDatabase("mydatabase", "1.0", "My Database", "1048576");
                if (!db) {ldelim}
                    //alert("データベースストレージが使えません。");
                {rdelim}else{ldelim}
                    //alert(111);
                {rdelim}
            {rdelim} else {ldelim}
                //alert("データベースストレージはサポートされていません。");
            {rdelim}
        {rdelim} catch (error) {ldelim}
            // ...
            //alert(error);
        {rdelim}

        db.transaction(
            function(tx)
            {ldelim}
              tx.executeSql("SELECT mail, password FROM login WHERE id = 1", [],
                function(tx, rs)
                {ldelim}
                  // ロードに成功したら、フォームに値をセット
                  document.gengo_login.mail.value = rs.rows.item(0).mail; // htmlspecialchars?
                  document.gengo_login.password.value  = rs.rows.item(0).password;
                  //alert(rs.rows.item(0).mail);
                  //document.gengo_login.save_password.checked = true;
                  document.gengo_login.save_password.value = 0;
                  
                  {if $is_auto_login_stop != TRUE}
                  document.gengo_login.auto_login.value  = 1;
                  document.gengo_login.submit();
                  {/if}
                {rdelim}
              );
            {rdelim}
        );
    {rdelim}

    </script>
    <div class="container">
        <div class="one columns">
            <h1 class="remove-bottom logo"><img src="/img/logo.png"></h1>
        </div>
        <p>ver1.0</p>

{if (isset($error.mail) && $is_auto_login != TRUE) || (isset($error.text) && $is_auto_login != TRUE) }

{if (isset($error.mail) && $is_auto_login != TRUE)}<p class="error_alert">{$error.mail}</p>{/if}
{if (isset($error.password) && $is_auto_login != TRUE)}<p class="error_alert">{$error.password}</p>{/if}

{/if}
        <div id="box" class="box"  style="margin-top: 5px;margin-bottom: 5px">
            <form id="gengo_login" name="gengo_login" action="{$smarty.const.GENGOURL}/user/login" method="post" onsubmit="return login_remaind()">

<table class="login-table">
    <tr>
        <td class="login-td">メール</td>
        <td><input type="text" name="mail" id="mail" class="login-input login-input-line"  value="{if $smarty.post.mail}{$smarty.post.mail|escape}{/if}" /></td>
    </tr>
    <tr>
        <td class="login-td">パスワード</td>
        <td><input type="password" name="password" id="password" class="login-input login-input-line"  value="{if $smarty.post.password}{$smarty.post.password|escape}{/if}" /></td>
    </tr>
    <tr>
        <td colspan="2" class="login-td" align="center" style="padding-top:5px;">
        <input type="hidden" name="auto_login" value="" />
        <input type="hidden" name="save_password" value="0" />
        {*<input type="checkbox" name="save_password" value="1" />メアドとパスワードを記憶<br />*}
        <input type="hidden" name="csrf_ticket" value="{$csrf_ticket}" /><input type="submit" value="ログイン" /></td>
    </tr>
</table>
            </form>
        </div>

    </div><!-- container -->
</body>
</html>