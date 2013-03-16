<!DOCTYPE html>
<head>
</head>
<body>
{literal}
<script>
// ロード時に、データベースからメアドとパスワードを取得、フォームにセットする関数
window.onload = function() {
    try {
        if (window.openDatabase) {
            var db = window.openDatabase("mydatabase", "1.0", "My Database", "1048576");
            if (!db) {
                //alert("データベースストレージが使えません。");
            }else{
                //alert(111);
            }
        } else {
            //alert("データベースストレージはサポートされていません。");
        }
    } catch (error) {
        // ...
        //alert(error);
    }

    db.transaction(
        function(tx)
        {
          tx.executeSql("SELECT email, pass FROM login WHERE id = 1", [],
            function(tx, rs)
            {
            alert(2);
              // ロードに成功したら、フォームに値をセット
              document.login.email.value = rs.rows.item(0).email; // htmlspecialchars?
              document.login.pass.value  = rs.rows.item(0).pass;
              document.login.save_pass.checked = true;
              //document.login.submit();
            }
          );
        }
    );
}

// フォーム送信時に、メアドとパスワードをデータベースに保存・削除する関数
function emai_pass_remaind()
{

  // フォームから値を取得
  var email = document.login.email.value;
  var pass  = document.login.pass.value;

  /* ここらへんにvalidationの処理を入れたり... */
  if ( document.login.save_pass.checked == true )
  {
    //alert(document.login.save_pass.checked);
  }
  
//  var db = openDatabase('mydatabase', '1.0');

try {
    if (window.openDatabase) {
        var db = window.openDatabase("mydatabase", "1.0", "My Database", "1048576");
        if (!db) {
            alert("データベースストレージが使えません。");
        }else{
            alert(111);
        }
    } else {
        alert("データベースストレージはサポートされていません。");
    }
} catch (error) {
    // ...
    alert(error);
}

  if ( document.login.save_pass.checked == true )
  {
  
    db.transaction(
      function(tx) {
        // テーブルがあるかな?
        tx.executeSql("SELECT count(*) FROM login", [],
          function(tx, rs) {
            // テーブルあるよ
            if ( rs.rows.item(0) == 0 )
            {
              // テーブル初利用の場合は、追加
              tx.executeSql('INSERT INTO login VALUES(1, ?, ?)', [email, pass], // escape?
                function() {},
                function(error) {
                  alert('save failed: ' + error.message);
                }
              );
            }
            else
            {
              // テーブル初利用じゃない場合は、更新
              tx.executeSql('UPDATE login SET email = ?, pass = ? WHERE id = 1', [email, pass], // escape?
                function() {},
                function(error) {
                  alert('update failed: ' + error.message);
                }
              );
            }
          },
          function(tx, error) {
            // テーブルないよ、テーブルつくろ
            tx.executeSql('CREATE TABLE login (id INTEGER PRIMARY KEY, email TEXT, pass TEXT)', [],
              function() {
              // テーブル初利用だから、追加
                tx.executeSql('INSERT INTO login VALUES(1, ?, ?)', [email, pass], // escape?
                  function() {},
                  function(error) {
                    alert('save failed: ' + error.message);
                  }
                );
              },
              function(error) {
                alert('Database creation failed.' + error.message);
              }
            );
          }
        );
      }
    );
  }
  else
  {
    // チェックボックスにチェックがないときは、テーブル削除
    db.transaction(
      function(tx) {
        tx.executeSql('DROP TABLE login', [],
          function() {},
          function(error) {
            alert('delete failed: ' + error.message);
          }
        );
      }
    );
  }
}
</script>
{/literal}
    <form name="login" action="login.php" method="post" onsubmit="return emai_pass_remaind()">  
    <input type="text" name="email" value="" placeholder="メールアドレス" autocorrect="off" autocapitalize="off" /><br />  
    <input type="password" name="pass" value="" placeholder="パスワード" autocorrect="off" autocapitalize="off" /><br />  
    <input type="checkbox" name="save_pass" value="1" />メアドとパスワードを記憶<br />  
    <input type="submit" value="送信" />  
    </form>  
</body>
</html>