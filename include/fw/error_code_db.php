<?php   // -*- mode: php -*-

$db_error = array(
    // MySQL client ( from include/errmsg.h )
    //  update this catalog when errmsg.h is changed.
    //  English texts may be found in libmysql/errmsg.c
    '0000' => array('DBサーバーへの接続に失敗しました。',
                     '&&host&& のデータベース "&&dbname&&" への接続に失敗しました。<br>&&msg&&',
                     'DBサーバーが正常に動作しているか確認してください。',
                     null),
    '2000' => array('DBエンジンのクライアントで異常が発生しました。',
                     '&&msg&&', null, null),
    '2001' => array('DBエンジンにてUNIXドメインソケットの作成に失敗しました。',
                     '&&host&& のデータベース "&&dbname&&" への接続に失敗しました。<br>&&msg&&',
                     null, null),
    '2002' => array('DBエンジンにてローカル接続に失敗しました。',
                     '&&host&& のデータベース "&&dbname&&" への接続に失敗しました。<br>&&msg&&',
                     'DBサーバーが正常に動作しているか確認してください。',
                     null),
    '2003' => array('DBサーバーへの接続に失敗しました。',
                     '&&host&& のデータベース "&&dbname&&" への接続に失敗しました。<br>&&msg&&',
                     'DBサーバーが正常に動作しているか確認してください。',
                     null),
    '2004' => array('DBエンジンにてIPソケットの作成に失敗しました。',
                     '&&host&& のデータベース "&&dbname&&" への接続に失敗しました。<br>&&msg&&',
                     null, null),
    '2005' => array('不明なDBサーバーに接続しようとしました。',
                     'ホスト "&&host&&" のIPアドレスは不明です。<br>&&msg&&',
                     'サーバーの設定が正しいか確認してください。',
                     null),
    '2006' => array('DBサーバーが異常終了しました。',
                     '&&msg&&',
                     'DBサーバーが正常に動作しているか確認してください。',
                     null),
    '2007' => array('バージョンが異なっているために接続に失敗しました。',
                     'ホスト "&&host&&" への接続に失敗しました。<br>&&msg&&',
                     null, null),
    '2008' => array('DBエンジン内にてメモリが不足しました。',
                     '&&msg&&',
                     'サーバーの状態を確認してください。',
                     '&&query&&'),
    '2009' => array('DBサーバーの指定に誤りがあります。',
                     '&&host&& のデータベース "&&dbname&&" への接続に失敗しました。<br>&&msg&&',
                     '正しいDBサーバーを指定してください。', null),
    '2010' => array('ローカルホストへの接続に失敗しました。',
                     '&&host&& のデータベース "&&dbname&&" への接続に失敗しました。<br>&&msg&&',
                     'サーバー管理者にご相談ください。', null),
    '2011' => array('DBエンジンがTCP接続に失敗しました。',
                     '&&host&& のデータベース "&&dbname&&" への接続に失敗しました。<br>&&msg&&',
                     null, null),
    '2012' => array('DBエンジンがサーバーとの接続中にハンドシェイクに失敗しました。',
                     '&&host&& のデータベース "&&dbname&&" への接続に失敗しました。<br>&&msg&&',
                     null, null),
    '2013' => array('DBサーバーとの接続が切断されました。',
                     '&&msg&&',
                     'サーバーの状態を確認してください。',
                     null),
    '2014' => array('SQLコマンドを不正な順番で実行しました。',
                     '&&msg&&',
                     null,
                     'デバッグ版で doc_root に作成される query.log を参照して解決してください。<br>&&query&&'),
    '2015' => array('DBエンジンが名前付きパイプの接続に失敗しました。',
                     '&&host&& のデータベース "&&dbname&&" への接続に失敗しました。<br>&&msg&&',
                     null, null),
    '2016' => array('DBエンジンが名前付きパイプの待機に失敗しました。',
                     '&&host&& のデータベース "&&dbname&&" への接続に失敗しました。<br>&&msg&&',
                     null, null),
    '2017' => array('DBエンジンが名前付きパイプの作成に失敗しました。',
                     '&&host&& のデータベース "&&dbname&&" への接続に失敗しました。<br>&&msg&&',
                     null, null),
    '2018' => array('DBエンジンが名前付きパイプの取得に失敗しました。',
                     '&&host&& のデータベース "&&dbname&&" への接続に失敗しました。<br>&&msg&&',
                     null, null),
    '2019' => array('DBエンジンがキャラクタセットファイルを見付けられません。',
                     '&&msg&&', null, null),
    '2020' => array('DBエンジンが大きすぎるパケットを処理しようとしました。',
                     '&&msg&&', null, '&&query&&'),
    '2021' => array('DBエンジンが組み込み接続に失敗しました。',
                     '&&msg&&', null, null),
    '2022' => array('DBエンジンがスレーブサーバーの状態取得に失敗しました。',
                     '&&msg&&', null, null),
    '2023' => array('DBエンジンがスレーブサーバーの一覧取得に失敗しました。',
                     '&&msg&&', null, null),
    '2024' => array('DBエンジンがスレーブサーバーの接続取得に失敗しました。',
                     '&&msg&&', null, null),
    '2025' => array('DBエンジンがマスターサーバーの接続取得に失敗しました。',
                     '&&msg&&', null, null),
    '2026' => array('DBエンジンが SSL 接続に失敗しました。',
                     '&&host&& のデータベース "&&dbname&&" への接続に失敗しました。<br>&&msg&&',
                     null, null),
    '2027' => array('DBエンジンが壊れたパケットを処理しようとしました。',
                     '&&msg&&', null, null),
    '2028' => array('MySQLサーバのライセンスが異なるためDBエンジンが使用できません。',
                     '&&msg&&', null, null),

    // 4.1 error codes
    '2029' => array('NULLポインタを不正に使用しました。',
                     '&&msg&&', null, null ),
    '2030' => array('ステートメントの準備がされていません。',
                     '&&msg&&', null, '&&query&&' ),
    '2031' => array('Prepared ステートメントのパラメーターが不足しています。',
                     '&&msg&&', null, '&&query&&' ),
    '2032' => array('データが欠損しています。',
                     '&&msg&&', null, null ),
    '2033' => array('ステートメント中にパラメーターが存在しません。',
                     '&&msg&&', null, '&&query&&' ),
    '2034' => array('パラメーターの番号が不正です。',
                     '&&msg&&', null, null ),
    '2035' => array('文字列かバイナリ以外のデータ型には大きなデータを設定できません。',
                     '&&msg&&', null, null ),
    '2036' => array('サポートされていないバッファタイプです。',
                     '&&msg&&', null, null ),
    '2037' => array('共有メモリ',
                     '&&msg&&', null, null ),
    '2038' => array('共有メモリをオープンできませんでした。リクエストイベントの作成に失敗しました。',
                     '&&msg&&', null, null ),
    '2039' => array('共有メモリをオープンできませんでした。アンサーイベントの作成に失敗しました。',
                     '&&msg&&', null, null ),
    '2040' => array('共有メモリをオープンできませんでした。ファイルマッピングに失敗しました。',
                     '&&msg&&', null, null ),
    '2041' => array('共有メモリをオープンできませんでした。メモリマッピングに失敗しました。',
                     '&&msg&&', null, null ),
    '2042' => array('共有メモリをオープンできませんでした。クライアントへのファイルマッピングに失敗しました。',
                     '&&msg&&', null, null ),
    '2043' => array('共有メモリをオープンできませんでした。クライアントへのメモリマッピングに失敗しました。',
                     '&&msg&&', null, null ),
    '2044' => array('共有メモリをオープンできませんでした。クライアントへのイベント作成に失敗しました。',
                     '&&msg&&', null, null ),
    '2045' => array('共有メモリをオープンできませんでした。サーバーがアンサーイベントを返しませんでした。',
                     '&&msg&&', null, null ),
    '2046' => array('共有メモリをオープンできませんでした。サーバーへリクエストイベントを送信できませんでした。',
                     '&&msg&&', null, null ),
    '2047' => array('不正なプロトコルです。',
                     '&&msg&&', null, null ),
    '2048' => array('コネクションハンドルが不正です。',
                     '&&msg&&', null, null ),
    '2049' => array('古い認証プロトコルを拒否しました。',
                     '&&msg&&', null, null ),
    '2050' => array('行の取得がキャンセルされました。',
                     '&&msg&&', null, null ),
    '2051' => array('カラム値を不正に読み出そうとしました。',
                     '&&msg&&', null, null ),
    '2052' => array('Preparedステートメントにメタデータが存在しません。',
                     '&&msg&&', null, null ),

    // MySQL server ( from include/mysqld_error.h )
    //  update this catalog when mysqld_error.h is changed.
    //  English texts may be found in Docs/mysqld_error.txt
    '1000' => array('hashchk', '&&msg&&', null, '&&query&&'),
    '1001' => array('nisamchk', '&&msg&&', null, '&&query&&'),
    '1002' => array('いいえ', '&&msg&&', null, '&&query&&'),
    '1003' => array('はい', '&&msg&&', null, '&&query&&'),
    '1004' => array('DBサーバー上でファイルの作成に失敗しました。',
                     '&&msg&&', null, '&&query&&'),
    '1005' => array('DBサーバー上でテーブルの作成に失敗しました。',
                     '&&msg&&', null, '&&query&&'),
    '1006' => array('DBサーバー上でデータベースの作成に失敗しました。',
                     '&&msg&&', null, '&&query&&'),
    '1007' => array('データベースがすでに存在しているため、作成できません。',
                     '&&msg&&', null, '&&query&&'),
    '1008' => array('データベースが存在しないため、削除できません。',
                     '&&msg&&', null, '&&query&&'),
    '1009' => array('データベースの削除に失敗しました。',
                     '&&msg&&', null, '&&query&&'),
    '1010' => array('データベースの削除に失敗しました。',
                     '&&msg&&', null, '&&query&&'),
    '1011' => array('DBサーバー上でファイルの削除に失敗しました。',
                     '&&msg&&', null, '&&query&&'),
    '1012' => array('DBサーバー上のシステム情報の取得に失敗しました。',
                     '&&msg&&', null, '&&query&&'),
    '1013' => array('DBサーバー上のファイル情報の取得に失敗しました。',
                     '&&msg&&', null, '&&query&&'),
    '1014' => array('DBサーバー上でカレントディレクトリの取得に失敗しました。',
                     '&&msg&&', null, '&&query&&'),
    '1015' => array('DBサーバー上でファイルのロックに失敗しました。',
                     '&&msg&&', null, '&&query&&'),
    '1016' => array('DBサーバー上でファイルのオープンに失敗しました。',
                     '&&msg&&', null, '&&query&&'),
    '1017' => array('DBサーバー上にファイルが見つかりません。',
                     '&&msg&&', null, '&&query&&'),
    '1018' => array('DBサーバー上でディレクトリの取得に失敗しました。',
                     '&&msg&&', null, '&&query&&'),
    '1019' => array('DBサーバー上でカレントディレクトリを変更できません。',
                     '&&msg&&', null, '&&query&&'),
    '1020' => array('読み込んだオブジェクトを、他のユーザーが変更しました。',
                     '&&msg&&', null, '&&query&&'),
    '1021' => array('DBサーバーが利用できる空きディスク容量が不足しています。',
                     '&&msg&&', null, '&&query&&'),
    '1022' => array('値が重複しているオブジェクトを書き込めません。',
                     '&&msg&&', null, '&&query&&'),
    '1023' => array('DBサーバー上でファイルのクローズに失敗しました。',
                     '&&msg&&', null, '&&query&&'),
    '1024' => array('DBサーバー上でファイルの読み込みに失敗しました。',
                     '&&msg&&', null, '&&query&&'),
    '1025' => array('DBサーバー上でファイルのリネームに失敗しました。',
                     '&&msg&&', null, '&&query&&'),
    '1026' => array('DBサーバー上でファイルの書き込みに失敗しました。',
                     '&&msg&&', null, '&&query&&'),
    '1027' => array('DBサーバー上のファイルがロックされています。',
                     '&&msg&&', null, '&&query&&'),
    '1028' => array('ソート操作は中断されました。',
                     '&&msg&&', null, '&&query&&'),
    '1029' => array('DBサーバー上でビューが見つかりません。',
                     '&&msg&&', null, '&&query&&'),
    '1030' => array('DBサーバーのテーブルハンドラがエラーを返しました。',
                     '&&msg&&', null, '&&query&&'),
    '1031' => array('不正なテーブルオプションを指定しました。',
                     '&&msg&&', null, '&&query&&'),
    '1032' => array('DBサーバー上で指定されたオブジェクトが見つかりません。',
                     '&&msg&&', null, '&&query&&'),
    '1033' => array('DBサーバー上で不正なファイルを読み込もうとしました。',
                     '&&msg&&', null, '&&query&&'),
    '1034' => array('DBサーバー上で不正なインデックスファイルを読み込もうとしました。',
                     '&&msg&&', null, '&&query&&'),
    '1035' => array('DBサーバー上のインデックスファイルが古すぎます。',
                     '&&msg&&', null, '&&query&&'),
    '1036' => array('読み込み専用のテーブルのオープンに失敗しました。',
                     '&&msg&&', null, '&&query&&'),
    '1037' => array('DBサーバー上でメモリが不足しています。',
                     '&&msg&&', 'DBサーバーを再起動してください。',
                     '&&query&&'),
    '1038' => array('DBサーバー上でソート用のメモリが不足しています。',
                     '&&msg&&',
                     'DBサーバーの設定を変更して、再起動してください。',
                     '&&query&&'),
    '1039' => array('DBサーバーでファイルの読み込み中に、予期せぬ EOF にあたりました。',
                     '&&msg&&', null, '&&query&&'),
    '1040' => array('DBサーバーへの接続クライアント数が多すぎます。',
                     '&&msg&&',
                     'しばらく待って再度実行してください。この状態が長く続く場合は、サーバー管理者へご相談ください。',
                     '&&query&&'),
    '1041' => array('DBサーバー上のリソースが不足しています。',
                     '&&msg&&',
                     'DBサーバーの使用できるリソースの上限を増やしてください。',
                     '&&query&&'),
    '1042' => array('DBサーバーがクライアントのアドレスを取得できません。',
                     '&&msg&&', null, '&&query&&'),
    '1043' => array('DBサーバーがクライアントとハンドシェイクに失敗しました。',
                     '&&msg&&', null, '&&query&&'),
    '1044' => array('DBサーバーとの認証に失敗しました。',
                     '&&msg&&',
                     '管理者用パスワードを再度設定してください。',
                     '&&query&&'),
    '1045' => array('DBサーバーとの認証に失敗しました。',
                     '&&msg&&',
                     '管理者用パスワードを再度設定してください。',
                     '&&query&&'),
    '1046' => array('データベースを選択していません。',
                     '&&msg&&', null, '&&query&&'),
    '1047' => array('サポートしていないDBコマンドです。',
                     '&&msg&&', null, '&&query&&'),
    '1048' => array('空値を許していないカラムを空値に設定しようとしました。',
                     '&&msg&&', null, '&&query&&'),
    '1049' => array('データベースが見つかりません。',
                     '&&msg&&', null, '&&query&&'),
    '1050' => array('テーブルはすでに存在します。',
                     '&&msg&&', null, '&&query&&'),
    '1051' => array('テーブルが見つかりません。',
                     '&&msg&&', null, '&&query&&'),
    '1052' => array('曖昧な値を指定しました。',
                     '&&msg&&', null, '&&query&&'),
    '1053' => array('DBサーバーは終了しようとしています。',
                     '&&msg&&',
                     'DBサーバーの再起動後に再度実行してください。',
                     '&&query&&'),
    '1054' => array('不明なカラムを指定しました。',
                     '&&msg&&', null, '&&query&&'),
    '1055' => array('GROUP BY で指定されていないカラムを使用しようとしました。',
                     '&&msg&&', null, '&&query&&'),
    '1056' => array('指定されたカラムではグループ化できません。',
                     '&&msg&&', null, '&&query&&'),
    '1057' => array('SUM 関数の用法に誤りがあります。',
                     '&&msg&&', null, '&&query&&'),
    '1058' => array('カラムと値の数が一致していません。',
                     '&&msg&&', null, '&&query&&'),
    '1059' => array('文字数の多すぎる名前を設定しようとしました。',
                     '&&msg&&', null, '&&query&&'),
    '1060' => array('同名のカラムが存在します。',
                     '&&msg&&', null, '&&query&&'),
    '1061' => array('同名のインデックスが存在します。',
                     '&&msg&&', null, '&&query&&'),
    '1062' => array('値が重複しています。',
                     '&&msg&&',
                     '重複しない値を指定して再度実行してください。',
                     '&&query&&'),
    '1063' => array('カラムの型定義が不正な形式です。',
                     '&&msg&&', null, '&&query&&'),
    '1064' => array('クエリの文法が不正です。',
                     '&&msg&&', null, '&&query&&'),
    '1065' => array('空のクエリです。',
                     '&&msg&&', null, '&&query&&'),
    '1066' => array('テーブルがユニークではありません。',
                     '&&msg&&', null, '&&query&&'),
    '1067' => array('デフォルト値が不正です。',
                     '&&msg&&', null, '&&query&&'),
    '1068' => array('プライマリキーを複数指定しようとしました。',
                     '&&msg&&', null, '&&query&&'),
    '1069' => array('インデックスの数が多すぎます。',
                     '&&msg&&', null, '&&query&&'),
    '1070' => array('インデックスの次元が多すぎます。',
                     '&&msg&&', null, '&&query&&'),
    '1071' => array('インデックスに使うキー長の文字数が多すぎます。',
                     '&&msg&&', null, '&&query&&'),
    '1072' => array('インデックスの対象となるカラムは存在しません。',
                     '&&msg&&', null, '&&query&&'),
    '1073' => array('BLOB カラムにはインデックスは張れません。',
                     '&&msg&&', null, '&&query&&'),
    '1074' => array('カラムが大きすぎます。',
                     '&&msg&&', 'BLOB を使用してください。', '&&query&&'),
    '1075' => array('自動採番カラムは、一つしか指定できません。',
                     '&&msg&&', null, '&&query&&'),
    '1076' => array('DBサーバーに接続可能です。',
                     '&&msg&&', null, '&&query&&'),
    '1077' => array('DBサーバーは正常にシャットダウンします。',
                     '&&msg&&', 'サーバー管理者にご相談ください。',
                     '&&query&&'),
    '1078' => array('DBサーバー上でシグナルが発生しました。DBサーバーは<b>停止</b>します。',
                     '&&msg&&', null, '&&query&&'),
    '1079' => array('DBサーバーのシャットダウンは完了しました。',
                     '&&msg&&', 'サーバー管理者にご相談ください。',
                     '&&query&&'),
    '1080' => array('DBサーバー上のスレッドを強制終了します。',
                     '&&msg&&', null, '&&query&&'),
    '1081' => array('DBサーバーがIPソケットを作成できません。',
                     '&&msg&&', null, '&&query&&'),
    '1082' => array('テーブルのインデックスが見つかりません。',
                     '&&msg&&',
                     'テーブルを再作成するか、バックアップからデータを回復してください。',
                     '&&query&&'),
    '1083' => array('カラムのセパレータが不正です。',
                     '&&msg&&', null, '&&query&&'),
    '1084' => array('可変長の行には FIELDS TERMINATED BY は使用できません。',
                     '&&msg&&', null, '&&query&&'),
    '1085' => array('DBサーバー上でファイルが読み込めません。',
                     '&&msg&&', null, '&&query&&'),
    '1086' => array('DBサーバー上にすでにファイルが存在します。',
                     '&&msg&&', null, '&&query&&'),
    '1087' => array('DBサーバー上でロードした結果です。',
                     '&&msg&&', null, '&&query&&'),
    '1088' => array('DBサーバー上でテーブルを変更した結果です。',
                     '&&msg&&', null, '&&query&&'),
    '1089' => array('サブキーが不正です。',
                     '&&msg&&', null, '&&query&&'),
    '1090' => array('ALTER TABLE ではすべてのカラムを削除できません。',
                     '&&msg&&',
                     'テーブルの削除は DROP TABLE で行ってください。',
                     '&&query&&'),
    '1091' => array('カラム/インデックスを削除できません。',
                     '&&msg&&',
                     'カラム/インデックスが存在するか確認してください。',
                     '&&query&&'),
    '1092' => array('INSERT の結果です。',
                     '&&msg&&', null, '&&query&&'),
    '1093' => array('UPDATE TABLE は許可されていません。',
                     '&&msg&&', null, '&&query&&'),
    '1094' => array('DBサーバー上に指定されたスレッドは存在しません。',
                     '&&msg&&', null, '&&query&&'),
    '1095' => array('DBサーバー上のスレッドを停止させる権限はありません。',
                     '&&msg&&', null, '&&query&&'),
    '1096' => array('テーブルは使用されませんでした。',
                     '&&msg&&', null, '&&query&&'),
    '1097' => array('オブジェクトに代入する文字列の文字数が多すぎます。',
                     '&&msg&&', null, '&&query&&'),
    '1098' => array('DBサーバーがログファイルの作成に失敗しました。',
                     '&&msg&&', null, '&&query&&'),
    '1099' => array('テーブルが読み込みロックされているため、書き込みに失敗しました。',
                     '&&msg&&', null, '&&query&&'),
    '1100' => array('テーブルはロックされていません。',
                     '&&msg&&', null, '&&query&&'),
    '1101' => array('BLOB カラムにはデフォルト値を設定できません。',
                     '&&msg&&', null, '&&query&&'),
    '1102' => array('データベース名が不正です。',
                     '&&msg&&', null, '&&query&&'),
    '1103' => array('テーブル名が不正です。',
                     '&&msg&&', null, '&&query&&'),
    '1104' => array('非常に大量のデータを処理しようとしました。',
                     '&&msg&&', null, 'SET OPTION SQL_BIG_SELECT=1 を指定する必要があります。<br>&&1&&'),
    '1105' => array('DBサーバー上で原因不明のエラーが発生しました。',
                     '&&msg&&', null, '&&query&&'),
    '1106' => array('DBサーバー上で未定義の関数を使用しようとしました。',
                     '&&msg&&', null, '&&query&&'),
    '1107' => array('DB関数のパラメーター数に誤りがあります。',
                     '&&msg&&', null, '&&query&&'),
    '1108' => array('DB関数のパラメーターが不正です。',
                     '&&msg&&', null, '&&query&&'),
    '1109' => array('DBサーバー上で不明なテーブルを使用しようとしました。',
                     '&&msg&&', null, '&&query&&'),
    '1110' => array('カラムが複数回使用されています。',
                     '&&msg&&', null, '&&query&&'),
    '1111' => array('DBのグループ関数の用法に誤りがあります。',
                     '&&msg&&', null, '&&query&&'),
    '1112' => array('このバージョンではサポートされていない機能を使用しようとしました。',
                     '&&msg&&', null, '&&query&&'),
    '1113' => array('テーブルには最低 1 つのカラムが必要です。',
                     '&&msg&&', null, '&&query&&'),
    '1114' => array('テーブル内のオブジェクトが多すぎます。',
                     '&&msg&&', null, '&&query&&'),
    '1115' => array('DBサーバー上でサポートされていないキャラクタセットを使用しようとしました。',
                     '&&msg&&', null, '&&query&&'),
    '1116' => array('JOIN 操作に使用するテーブル数が多すぎます。',
                     '&&msg&&', null, '&&query&&'),
    '1117' => array('カラム数が多すぎます。',
                     '&&msg&&', null, '&&query&&'),
    '1118' => array('オブジェクトの最大サイズが大きすぎます。',
                     '&&msg&&', null, 'BLOB を使用してください。<br>&&query&&'),
    '1119' => array('DBサーバー上でスタックサイズの上限を超えました。',
                     '&&msg&&', null, '&&query&&'),
    '1120' => array('OUTER JOIN の条件に誤りがあります。',
                     '&&msg&&', null, '&&query&&'),
    '1121' => array('インデックスを作成するカラムの値が未定義です。',
                     '&&msg&&', null, '&&query&&'),
    '1122' => array('DBサーバー上でユーザー定義関数が見つかりません。',
                     '&&msg&&', null, '&&query&&'),
    '1123' => array('DBサーバー上でユーザー定義関数が初期化できません。',
                     '&&msg&&', null, '&&query&&'),
    '1124' => array('ユーザー定義関数に許可されているパスが存在しません。',
                     '&&msg&&', null, '&&query&&'),
    '1125' => array('すでに同名のユーザー定義関数が存在します。',
                     '&&msg&&', null, '&&query&&'),
    '1126' => array('ユーザー定義関数の共有ライブラリのオープンに失敗しました。',
                     '&&msg&&', null, '&&query&&'),
    '1127' => array('ユーザー定義関数のエントリーポイントが見つかりません。',
                     '&&msg&&', null, '&&query&&'),
    '1128' => array('DBサーバー上で未定義の関数を使用しようとしました。',
                     '&&msg&&', null, '&&query&&'),
    '1129' => array('DBサーバーは現在接続をブロックしています。',
                     '&&msg&&',
                     'サーバー管理者の方へ: mysqladmin flush-hosts を実行してください。',
                     '&&query&&'),
    '1130' => array('DBサーバーへの接続が許可されていないホストです。',
                     '&&msg&&', 'DBサーバーの設定を確認してください。',
                     '&&query&&'),
    '1131' => array('DBサーバーの匿名ユーザーはパスワードを変更できません。',
                     '&&msg&&', null, '&&query&&'),
    '1132' => array('DBサーバーの他のユーザーのパスワードを変更するには、データベースの操作権限が必要です。',
                     '&&msg&&', null, '&&query&&'),
    '1133' => array('DBサーバーへの認証に失敗しました。',
                     '&&msg&&',
                     '管理者用パスワードを再設定してください。',
                     '&&query&&'),
    '1134' => array('UPDATE の情報です。',
                     '&&msg&&', null, '&&query&&'),
    '1135' => array('DBサーバー上でスレッドの作成に失敗しました。',
                     '&&msg&&', null, '&&query&&'),
    '1136' => array('カラム数と値の数が一致していません。',
                     '&&msg&&', null, '&&query&&'),
    '1137' => array('テーブルの再オープンに失敗しました。',
                     '&&msg&&', null, '&&query&&'),
    '1138' => array('NULL の用法に誤りがあります。',
                     '&&msg&&', null, '&&query&&'),
    '1139' => array('DBサーバー上で正規表現の処理に失敗しました。',
                     '&&msg&&', null, '&&query&&'),
    '1140' => array('DBサーバー上でグループ関数の用法に誤りがあります。',
                     '&&msg&&', null, '&&query&&'),
    '1141' => array('DBユーザーに与える権限の指定に誤りがあります。',
                     '&&msg&&', null, '&&query&&'),
    '1142' => array('テーブルにアクセスする権限がありません。',
                     '&&msg&&', null, '&&query&&'),
    '1143' => array('カラムにアクセスする権限がありません。',
                     '&&msg&&', null, '&&query&&'),
    '1144' => array('DBサーバーのアクセス権設定に失敗しました。',
                     '&&msg&&', null, '&&query&&'),
    '1145' => array('DBサーバーのアクセス権設定で、ユーザー名かホスト名の文字数が多すぎます。',
                     '&&msg&&', null, '&&query&&'),
    '1146' => array('データベースにテーブルが存在しません。',
                     '&&msg&&', null, '&&query&&'),
    '1147' => array('存在しない権限をテーブルに設定しようとしました。',
                     '&&msg&&', null, '&&query&&'),
    '1148' => array('DBサーバーは指定されたコマンドを許可していません。',
                     '&&msg&&', null, '&&query&&'),
    '1149' => array('SQLクエリの文法に誤りがあります。',
                     '&&msg&&', null, '良くわからない場合はフレームワークチームに尋ねてください。<br>&&query&&'),
    '1150' => array('DBサーバー上にて、遅延インサートがロックを確保できずに失敗しました。',
                     '&&msg&&', null, '&&query&&'),
    '1151' => array('DBサーバー上の遅延スレッドが多すぎます。',
                     '&&msg&&', null, '&&query&&'),
    '1152' => array('DBサーバーがコネクションを切断しました。',
                     '&&msg&&', null, '&&query&&'),
    '1153' => array('DBサーバーが受信するデータが大きすぎます。',
                     '&&msg&&', null, '&&query&&'),
    '1154' => array('DBサーバーでパイプからの受信に失敗しました。',
                     '&&msg&&', null, '&&query&&'),
    '1155' => array('DBサーバーで fcntl コールに失敗しました。',
                     '&&msg&&', null, '&&query&&'),
    '1156' => array('DBサーバーが不正な順序でデータを受信しました。',
                     '&&msg&&', null, '&&query&&'),
    '1157' => array('DBサーバーが受信したデータを解凍できません。',
                     '&&msg&&', null, '&&query&&'),
    '1158' => array('DBサーバーが受信したデータを解読できません。',
                     '&&msg&&', null, '&&query&&'),
    '1159' => array('DBサーバーがデータを受信中にタイムアウトしました。',
                     '&&msg&&', null, '&&query&&'),
    '1160' => array('DBサーバーでデータの送信に失敗しました。',
                     '&&msg&&', null, '&&query&&'),
    '1161' => array('DBサーバーがデータを送信中にタイムアウトしました。',
                     '&&msg&&', null, '&&query&&'),
    '1162' => array('DBサーバーが受信したデータが大きすぎます。',
                     '&&msg&&', null, '&&query&&'),
    '1163' => array('BLOB/TEXT をサポートしていないテーブル型です。',
                     '&&msg&&', null, '&&query&&'),
    '1164' => array('AUTO_INCREMENT をサポートしていないテーブル型です。',
                     '&&msg&&', null, '&&query&&'),
    '1165' => array('テーブルがロックされているため遅延インサートできません。',
                     '&&msg&&', null, '&&query&&'),
    '1166' => array('カラム名が不正です。',
                     '&&msg&&', null, '&&query&&'),
    '1167' => array('指定されたカラムには、インデックスを作成できません。',
                     '&&msg&&', null, '&&query&&'),
    '1168' => array('MERGEテーブルの元テーブルの指定が一意ではありません。',
                     '&&msg&&', null, '&&query&&'),
    '1169' => array('重複する値は許可されていません。',
                     '&&msg&&', '一意な値を指定して再度実行してください。',
                     '&&query&&'),
    '1170' => array('BLOB カラムはサイズを指定する必要があります。',
                     '&&msg&&', null, '&&query&&'),
    '1171' => array('PRIMARY KEY には NULL を設定できません。',
                     '&&msg&&', null, '&&query&&'),
    '1172' => array('DBサーバーの返すオブジェクト数が多すぎます。',
                     '&&msg&&', null, '&&query&&'),
    '1173' => array('PRIMARY KEY を持つ必要があるテーブル型です。',
                     '&&msg&&', null, '&&query&&'),
    '1174' => array('このDBサーバーではRAIDサポートは組み込まれていません。',
                     '&&msg&&', null, '&&query&&'),
    '1175' => array('キーを指定せずに更新クエリを実行しようとしました。',
                     '&&msg&&', null, '&&query&&'),
    '1176' => array('指定されたキーに対応するオブジェクトが存在しません。',
                     '&&msg&&', null, '&&query&&'),
    '1177' => array('指定されたテーブルを開けません。',
                     '&&msg&&', null, '&&query&&'),
    '1178' => array('&&msg&&',
                     '&&msg&&', null, '&&query&&'),
    '1179' => array('トランザクション中に実行できないコマンドです。',
                     '&&msg&&', null, '&&query&&'),
    '1180' => array('DBサーバーでトランザクションの保存中にエラーが発生しました。',
                     '&&msg&&', null, '&&query&&'),
    '1181' => array('DBサーバーでトランザクションの取り消し中にエラーが発生しました。',
                     '&&msg&&', null, '&&query&&'),
    '1182' => array('DBサーバーでログの書き出し中にエラーが発生しました。',
                     '&&msg&&', null, '&&query&&'),
    '1183' => array('DBサーバーでチェックポイントの作成中にエラーが発生しました。',
                     '&&msg&&', null, '&&query&&'),
    '1184' => array('DBサーバーが接続を切断しました。',
                     '&&msg&&', null, '&&query&&'),
    '1185' => array('テーブルの書き出しをサポートしないテーブル型です。',
                     '&&msg&&', null, '&&query&&'),
    '1186' => array('&&msg&&',
                     '&&msg&&', null, '&&query&&'),
    '1187' => array('インデックスの再作成に失敗しました。',
                     '&&msg&&', null, '&&query&&'),
    '1188' => array('マスターDBサーバーでエラーが発生しました。',
                     '&&msg&&', null, '&&query&&'),
    '1189' => array('マスターDBサーバーからのデータの受信に失敗しました。',
                     '&&msg&&', null, '&&query&&'),
    '1190' => array('マスターDBサーバーへのデータ送信に失敗しました。',
                     '&&msg&&', null, '&&query&&'),
    '1191' => array('全文検索インデックスが指定されたカラムに作成されていません。',
                     '&&msg&&', null, '&&query&&'),
    '1192' => array('テーブルをロックしているかトランザクション中のため、コマンドが実行できません。',
                     '&&msg&&', null, '&&query&&'),
    '1193' => array('DBサーバーで未定義の変数を使用しようとしました。',
                     '&&msg&&', null, '&&query&&'),
    '1194' => array('テーブルが壊れています。',
                     '&&msg&&', 'サーバーを再起動してください。',
                     '&&query&&'),
    '1195' => array('テーブルが壊れています。最後のリペアに失敗しています。',
                     '&&msg&&', 'バックアップからデータを回復してください。',
                     '&&query&&'),
    '1196' => array('ロールバック不可能な変更がトランザクション中に実行されました。',
                     '&&msg&&', null, '&&query&&'),
    '1197' => array('トランザクションのキャッシュが不足しました。',
                     '&&msg&&', null,
                     'binlog は取っていないので発生しないはずです。<br>&&query&&'),
    '1198' => array('スレーブDBサーバーを停止しないと実行できないコマンドです。',
                     '&&msg&&', null, '&&query&&'),
    '1199' => array('スレーブDBサーバーが実行されていないと実行できないコマンドです。',
                     '&&msg&&', null, '&&query&&'),
    '1200' => array('スレーブDBサーバーとして設定されていません。',
                     '&&msg&&', null, '&&query&&'),
    '1201' => array('マスターDBサーバーの初期化に失敗しました。',
                     '&&msg&&', null, '&&query&&'),
    '1202' => array('DBサーバー上でスレーブ用のスレッドの作成に失敗しました。',
                     '&&msg&&', null, '&&query&&'),
    '1203' => array('DBサーバーへの接続が多すぎます。',
                     '&&msg&&',
                     'しばらく後に再度実行してください。<br><b>サーバー管理者の方へ</b>: my.ini の max_user_connections の値を増やすことで改善する可能性があります。',
                     '&&query&&'),
    '1204' => array('SET には即値のみを与えられます。',
                     '&&msg&&', null, '&&query&&'),
    '1205' => array('DBサーバー上で、ロック獲得がタイムアウトしました。',
                     '&&msg&&',
                     '再度実行してください。この状態が長く続く場合は、サーバー管理者にご相談ください。',
                     '&&query&&'),
    '1206' => array('DBサーバー上のロックの数が多すぎます。',
                     '&&msg&&', null, '&&query&&'),
    '1207' => array('読み込み専用のトランザクション中で、書き込みを行いました。',
                     '&&msg&&', null, '&&query&&'),
    '1208' => array('他のユーザーがデータベースを使用中のため、データベースを破棄できません。',
                     '&&msg&&', null, '&&query&&'),
    '1209' => array('他のユーザーがデータベースを使用中のため、データベースを作成できません。',
                     '&&msg&&', null, '&&query&&'),
    '1210' => array('DB関数の引数に誤りがあります。',
                     '&&msg&&', null, '&&query&&'),
    '1211' => array('DBユーザーを作成できません。',
                     '&&msg&&', null, '&&query&&'),
    '1212' => array('&&msg&&',
                     '&&msg&&', null, '&&query&&'),
    '1213' => array('データベース上でデッドロックが発生しました。',
                     '&&msg&&', '再度実行してください。',
                     'デッドロックは、データのアクセス順序に気をつけてできるだけ回避してください。<br>&&query&&'),
    '1214' => array('全文検索インデックスはサポートされていません。',
                     '&&msg&&', null, '&&query&&'),
    '1215' => array('外部キー制約を設定できません。',
                     '&&msg&&', null, '&&query&&'),
    '1216' => array('外部キー制約のためにオブジェクトを追加できません。',
                     '&&msg&&', null, '&&query&&'),
    '1217' => array('外部キー制約のためにオブジェクトを削除できません。',
                     '&&msg&&', null, '&&query&&'),
    '1218' => array('マスターDBサーバーに接続できません。',
                     '&&msg&&', null, '&&query&&'),
    '1219' => array('マスターDBサーバー上でクエリが失敗しました。',
                     '&&msg&&', null, '&&query&&'),
    '1220' => array('DBサーバーでコマンドを実行中にエラーが発生しました。',
                     '&&msg&&', null, '&&query&&'),
    '1221' => array('&&msg&&',
                     '&&msg&&', null, '&&query&&'),
    '1222' => array('クエリ中のカラム数に誤りがあります。',
                     '&&msg&&', null, '&&query&&'),
    '1223' => array('読み込みロック中に書き込みを行おうとしました。',
                     '&&msg&&', null, '&&query&&'),
    '1224' => array('トランザクションテーブルとそれ以外のテーブルは同時に使用できません。',
                     '&&msg&&', null, '&&query&&'),
    '1225' => array('クエリ中に冗長なオプションが指定されています。',
                     '&&msg&&', null, '&&query&&'),
    '1226' => array('DBユーザーに設定されている制限に到達しました。',
                     '&&msg&&', null, '&&query&&'),
    '1227' => array('DBサーバーにアクセスを拒否されました。',
                     '&&msg&&', null, '&&query&&'),
    '1228' => array('DBサーバー上でローカル変数をグローバルとして設定しようとしました。',
                     '&&msg&&', null, '&&query&&'),
    '1229' => array('DBサーバー上でグローバル変数をローカル変数として設定しようとしました。',
                     '&&msg&&', null, '&&query&&'),
    '1230' => array('カラムにデフォルト値が設定されていません。',
                     '&&msg&&', null, '&&query&&'),
    '1231' => array('DB上の変数に指定する値が不正です。',
                     '&&msg&&', null, '&&query&&'),
    '1232' => array('DB上の変数に指定する値の型が不正です。',
                     '&&msg&&', null, '&&query&&'),
    '1233' => array('DB上の書き込み専用変数を読み込もうとしました。',
                     '&&msg&&', null, '&&query&&'),
    '1234' => array('クエリ中のオプションが不正です。',
                     '&&msg&&', null, '&&query&&'),
    '1235' => array('このバージョンのDBサーバーではサポートされていない機能です。',
                     '&&msg&&', null, '&&query&&'),
    '1236' => array('マスターDBサーバーで致命的な障害が発生しました。',
                     '&&msg&&', null, '&&query&&'),

    // 4.1 error codes
    '1237' => array('スレーブSQLスレッドがクエリを無視しました。',
                     '&&msg&&', null, '&&query&&'),
    '1238' => array('変数スコープが不正です。',
                     '&&msg&&', null, '&&query&&'),
    '1239' => array('外部キーの定義が不正です。',
                     '&&msg&&', null, '&&query&&'),
    '1240' => array('キーの参照とテーブルの参照が合っていません。',
                     '&&msg&&', null, '&&query&&'),
    '1241' => array('オペランドに与えるカラム数に誤りがあります。',
                     '&&msg&&', null, '&&query&&'),
    '1242' => array('サブクエリが 1 行以上の結果を返しました。',
                     '&&msg&&', null, '&&query&&'),
    '1243' => array('不明なプリペアドステートメントハンドラです。',
                     '&&msg&&', null, '&&query&&'),
    '1244' => array('データベースが破損しているか、見つかりません。',
                     '&&msg&&', null, '&&query&&'),
    '1245' => array('サブクエリ間に循環した参照があります。',
                     '&&msg&&', null, '&&query&&'),
    '1246' => array('カラムの変換に失敗しました。',
                     '&&msg&&', null, '&&query&&'),
    '1247' => array('参照が不正です。',
                     '&&msg&&', null, '&&query&&'),
    '1248' => array('派生テーブルには別名が必要です。',
                     '&&msg&&', null, '&&query&&'),
    '1249' => array('最適化の結果 SELECT がなくなりました。',
                     '&&msg&&', null, '&&query&&'),
    '1250' => array('使用できないテーブルが指定されました。',
                     '&&msg&&', null, '&&query&&'),
    '1251' => array('クライアントがサポートしていない認証プロトコルを要求されました。',
                     '&&msg&&', null, '&&query&&'),
    '1252' => array('空間キーは全要素が NULL でない必要があります。',
                     '&&msg&&', null, '&&query&&'),
    '1253' => array('キャラクタセットに適合しないコレーションを指定しました。',
                     '&&msg&&', null, '&&query&&'),
    '1254' => array('スレーブはすでに実行中です。',
                     '&&msg&&', null, '&&query&&'),
    '1255' => array('スレーブはすでに停止済みです。',
                     '&&msg&&', null, '&&query&&'),
    '1256' => array('データが大きすぎて解凍できません。',
                     '&&msg&&', null, '&&query&&'),
    '1257' => array('ZLIB内でメモリが不足しました。',
                     '&&msg&&', null, '&&query&&'),
    '1258' => array('ZLIBのアウトプットバッファが不足しました。',
                     '&&msg&&', null, '&&query&&'),
    '1259' => array('圧縮データが破損しています。',
                     '&&msg&&', null, '&&query&&'),
    '1260' => array('GROUP_CONCAT()関数が行を削除しました。',
                     '&&msg&&', null, '&&query&&'),
    '1261' => array('レコード数がカラム数を下回っています。',
                     '&&msg&&', null, '&&query&&'),
    '1262' => array('レコード数がカラム数を上回っています。',
                     '&&msg&&', null, '&&query&&'),
    '1263' => array('空値が許されないカラムに NULL を指定しました。',
                     '&&msg&&', null, '&&query&&'),
    '1264' => array('値域を超えたため、データが丸められました。',
                     '&&msg&&', null, '&&query&&'),
    '1265' => array('データが丸められました。',
                     '&&msg&&', null, '&&query&&'),
    '1266' => array('異なるテーブルタイプを使用します。',
                     '&&msg&&', null, '&&query&&'),
    '1267' => array('相容れないコレーションを指定しました。',
                     '&&msg&&', null, '&&query&&'),
    '1268' => array('DBユーザーの削除に失敗しました。',
                     '&&msg&&', null, '&&query&&'),
    '1269' => array('DBユーザーの権限設定に失敗しました。',
                     '&&msg&&', null, '&&query&&'),
    '1270' => array('相容れないコレーションを指定しました。',
                     '&&msg&&', null, '&&query&&'),
    '1271' => array('相容れないコレーションを指定しました。',
                     '&&msg&&', null, '&&query&&'),
    '1272' => array('不正な型の変数です。',
                     '&&msg&&', null, '&&query&&'),
    '1273' => array('不明なコレーションを指定しました。',
                     '&&msg&&', null, '&&query&&'),
    '1274' => array('スレーブが SSL パラメーターを無視しました。',
                     '&&msg&&', null, '&&query&&'),
    '1275' => array('サーバーがセキュアモードで動作しているため、認証に失敗しました。',
                     '&&msg&&', null, '&&query&&'),
    '1276' => array('フィールド参照の解決位置がずれました。',
                     '&&msg&&', null, '&&query&&'),
    '1277' => array('START SLAVE UNTIL のパラメーターが不正です。',
                     '&&msg&&', null, '&&query&&'),
    '1278' => array('--skip-slave-start を使用してください。',
                     '&&msg&&', null, '&&query&&'),
    '1279' => array('UNTIL オプションを無視しました。',
                     '&&msg&&', null, '&&query&&'),
    '1280' => array('インデックス名が不正です。',
                     '&&msg&&', null, '&&query&&'),
    '1281' => array('カタログ名が不正です。',
                     '&&msg&&', null, '&&query&&'),
    '1282' => array('クエリキャッシュをリサイズしました。',
                     '&&msg&&', null, '&&query&&'),
    '1283' => array('全文検索インデックスに使用できないカラムを指定しました。',
                     '&&msg&&', null, '&&query&&'),
    '1284' => array('不明なキーキャッシュです。',
                     '&&msg&&', null, '&&query&&'),
    '1285' => array('MySQLが--skip-name-resolveモードで動作しています。',
                     '&&msg&&', null, '&&query&&'),
    '1286' => array('不明なテーブル型です。',
                     '&&msg&&', null, '&&query&&'),
    '1287' => array('推奨されない文法です。',
                     '&&msg&&', null, '&&query&&'),
    '1288' => array('指定されたテーブルは変更できません。',
                     '&&msg&&', null, '&&query&&'),
    '1289' => array('機能が使用可能になっていません。適切なオプションを指定して、再コンパイルしてください。',
                     '&&msg&&', null, '&&query&&'),
    '1290' => array('現在の動作オプションでは、処理できないクエリです。',
                     '&&msg&&', '適切な動作オプションを指定して、再起動してください。', '&&query&&'),
    '1291' => array('カラムの値が重複します。',
                     '&&msg&&', null, '&&query&&'),
    '1292' => array('データが不正に丸められました。',
                     '&&msg&&', null, '&&query&&'),
    '1293' => array('CURRENT_TIMESTAMPカラムは複数使用できません。',
                     '&&msg&&', null, '&&query&&'),
    '1294' => array('ON UPDATE節が不正です。',
                     '&&msg&&', null, '&&query&&'),
    '1295' => array('このコマンドはprepared statementにおいてサポートされていません。',
                     '&&msg&&', null, '&&query&&'),
    '1296' => array('エラーが発生しました。',
                     '&&msg&&', null, '&&query&&'),
    '1297' => array('一時的なエラーが発生しました。',
                     '&&msg&&', null, '&&query&&'),
    '1298' => array('不明もしくは不正なタイムゾーンです。',
                     '&&msg&&', null, '&&query&&'),
    '1299' => array('無効なタイムスタンプ値です。',
                     '&&msg&&', null, '&&query&&'),
    '1300' => array('文字列中に無効な文字が存在します。',
                     '&&msg&&', null, '&&query&&'),
    '1301' => array('結果データがmax_allowed_packetの値を超過しました。データはカットされます。',
                     '&&msg&&', null, '&&query&&'),
    '1302' => array('宣言が衝突します。',
                     '&&msg&&', null, '&&query&&'),
);

?>
