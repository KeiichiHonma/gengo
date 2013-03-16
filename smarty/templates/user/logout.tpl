<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>logout</title>
    <meta name="description" content="logout">
    <meta name="author" content="logout">
</head>
<body>
logout

<script>
// ロード時delete
window.onload = function() {ldelim}
    try {ldelim}
        if (window.openDatabase) {ldelim}
            var db = window.openDatabase("mydatabase", "1.0", "My Database", "1048576");
            if (!db) {ldelim}
                //alert("データベースストレージが使えません。");
            {rdelim}else{ldelim}
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
        {rdelim} else {ldelim}
            //alert("データベースストレージはサポートされていません。");
        {rdelim}
    {rdelim} catch (error) {ldelim}
        // ...
        //alert(error);
    {rdelim}
window.location.href = "{$smarty.const.GENGOURL}/user/login";
{rdelim}
</script>
<a href="{$smarty.const.GENGOURL}/user/login">自動的に画面が切り替わらない場合はクリックしてログイン画面へ戻る</a>
</body>
</html>