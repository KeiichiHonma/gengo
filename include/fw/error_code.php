<?php
// --------------------------
// 共通エラー
// --------------------------

//エラー宣言
define('E_CMMN_URL_WRONG',               'KUJAPAN_CMMN_00001');
define('E_CMMN_TOKEN_WRONG',             'KUJAPAN_CMMN_00002');
define('E_CMMN_USER_EXISTS',             'KUJAPAN_CMMN_00003');
define('E_CMMN_REQUEST_ERROR',           'KUJAPAN_CMMN_00004');
define('E_CMMN_INITIALIZE_RAND',         'KUJAPAN_CMMN_00005');
define('E_CMMN_VALIDATE_TIME',           'KUJAPAN_CMMN_00006');
define('E_CMMN_SEO_EXISTS',              'KUJAPAN_CMMN_00007');

//エラーメッセージ
define('KUJAPAN_CMMN_00001',            'URLが不正です。');
define('KUJAPAN_CMMN_00002',            '不正なリクエストです。クッキーが有効になっていない可能性があります。ブラウザの設定をご確認ください。');
define('KUJAPAN_CMMN_00003',            'ユーザーが削除されたか存在しません。');
define('KUJAPAN_CMMN_00004',            '現在、サーバーが混んでおります。しばらく経ってから、もう一度お試しください。');
define('KUJAPAN_CMMN_00005',            '初期化中に不明なエラーが発生しました。弊社サポートセンターまでご連絡くださいませ。');
define('KUJAPAN_CMMN_00006',            'クーポン発行可能な期間が過ぎています。<br />発行可能な期間は初回ログイン時より3か月となっております。<br />再度ご購入いただきますようお願いいたします。');
define('KUJAPAN_CMMN_00007',            'SEO情報が削除されたか存在しません。');

//システム管理画面特有のエラー




// --------------------------
// USERエラー
// --------------------------
//エラー宣言
define('E_MANAGER_ACCESS_WRONG',                   'KUJAPAN_MANAGER_00001');
define('E_MANAGER_AUTH_PARAM_UNSET',               'KUJAPAN_MANAGER_00002');
define('E_AUTH_NG',                                'KUJAPAN_MANAGER_00003');

//エラーメッセージ
define('KUJAPAN_MANAGER_00001',              '不正なリクエストです。');
define('KUJAPAN_MANAGER_00002',              '必要なユーザーパラメータがセットされていないため、操作できません。最初から操作をやり直してください。');
define('KUJAPAN_MANAGER_00003',            'メールアドレス、あるいは、パスワードが間違っています。<br />ログインするメールアドレスの設定がご指定のメールアドレス種類(携帯 or パソコン)と異なっている可能性があります。携帯、パソコン、両方のメールアドレスで試してください。');

// --------------------------
// ファイルシステムエラー
// --------------------------
define('E_SYSTEM_DIR_NO_EXIST',            'KUJAPAN_SYSTEM_00001');
define('E_SYSTEM_DIR_NO_WRITE',            'KUJAPAN_SYSTEM_00002');
define('E_SYSTEM_FILE_NO_WRITE',           'KUJAPAN_SYSTEM_00003');
define('E_SYSTEM_FILE_EXIST',              'KUJAPAN_SYSTEM_00004');

define('E_SYSTEM_FILE_1',                  'KUJAPAN_SYSTEM_00005');//E_SYSTEM_FILE_BASE_SIZE
define('E_SYSTEM_FILE_2',                  'KUJAPAN_SYSTEM_00006');//E_SYSTEM_FILE_FORM_SIZE
define('E_SYSTEM_FILE_3',                  'KUJAPAN_SYSTEM_00007');//E_SYSTEM_FILE_PART_UPLOAD
define('E_SYSTEM_FILE_4',                  'KUJAPAN_SYSTEM_00008');//E_SYSTEM_FILE_ALL_UPLOAD

define('E_SYSTEM_FILE_NOT_COPY',           'KUJAPAN_SYSTEM_00009');
define('E_CODE_EMPTY',                     'KUJAPAN_SYSTEM_00010');
define('E_CODE_DUPLICATION',               'KUJAPAN_SYSTEM_00011');
define('E_MAIL_NOT_SEND',                  'KUJAPAN_SYSTEM_00012');
define('E_SYSTEM_CSV_WRONG',               'KUJAPAN_SYSTEM_00014');
define('E_SYSTEM_PARAM_WRONG',             'KUJAPAN_SYSTEM_00015');

define('E_SYSTEM_MANAGER_EXISTS',            'KUJAPAN_SYSTEM_00016');
define('E_SYSTEM_GROUP_EXISTS',              'KUJAPAN_SYSTEM_00017');
define('E_SYSTEM_GENGO_EXISTS',             'KUJAPAN_SYSTEM_00018');

define('KUJAPAN_SYSTEM_00001',              'ディレクトリが存在しません');
define('KUJAPAN_SYSTEM_00002',              'ディレクトリへの書き込み権限がありません');
define('KUJAPAN_SYSTEM_00003',              'ファイルへの書き込み権限がありません');
define('KUJAPAN_SYSTEM_00004',              '既にファイルが存在しています');
define('KUJAPAN_SYSTEM_00005',              '！基本ファイルサイズの制限値を超えています');
define('KUJAPAN_SYSTEM_00006',              '！フォームファイルサイズの制限値を超えています');
define('KUJAPAN_SYSTEM_00007',              '！一部分のみしかアップロードされていませんでした');
define('KUJAPAN_SYSTEM_00008',              '！ファイルは必須です。ファイルがアップロードされませんでした');
define('KUJAPAN_SYSTEM_00009',              'ファイルコピーに失敗しました');
define('KUJAPAN_SYSTEM_00010',              'コードが入力されていません');
define('KUJAPAN_SYSTEM_00011',              'コードが重複しています');
define('KUJAPAN_SYSTEM_00012',              'メールの送信に失敗しました．');
define('KUJAPAN_SYSTEM_00014',              'CSVファイルが不正です');
define('KUJAPAN_SYSTEM_00015',              'パラメータが不正です');
define('KUJAPAN_SYSTEM_00016',            'マネージャが削除されたか存在しません。');
define('KUJAPAN_SYSTEM_00017',            'グループが削除されたか存在しません。');
define('KUJAPAN_SYSTEM_00018',            'クーポンが削除されたか存在しません。');
?>
