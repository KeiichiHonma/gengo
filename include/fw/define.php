<?php
define('SETTING_INI', 'setting.ini');
define('SITE_NAME',   'china adviser');
define('WGET_DIR',    '/usr/local/apache2/wget');
define('COMMAND_DIR', '/usr/local/apache2/adviser_command');
define('SHELL_DIR',   '/usr/local/apache2/adviser_command/shell');

define('MASTER_SHELL_FILE', 'masterCrawler.sh');//全ユーザー共通マスターシェル→cron呼び出し

define('USER_SHELL_FILE', 'userCrawler.sh');//ユーザーマスターシェル
define('HTML_SHELL_FILE', 'htmlCrawler.sh');//htmlごとにまとめたシェル

define('CRAWLER_SUPPORT_PHP_FILE',   'crawler_support.php');
define('CRAWLER_SUPPORT_PHP_FILE_OKAYAMA',   'crawler_support_okayama.php');
define('MAKE_SHELL_PHP_FILE',   'make_shell.php');

define('FINISH_IMAGE_LOG', 'finish_image.log');
define('WGET_MASTER_LOG', 'wget_master.log');//マスターログ
define('WGET_SUPPORT_LOG', 'wget_support.log');//サポートログ
define('WGET_PASS_LOG', 'wget_pass.log');//passしたログ

define('CHINA_DOCUMENT_ROOT', '/usr/local/apache2/htdocs/jpnow');

//SP
define('FIRSTSP',       10);
//define('GROUPSP',       10);//グループページで表示するクーポンの数

//ファイル系
define('FILES_DIR',       '/files');
//define('FILES_DIR',       '/include/files');
define('FILES_PATH',       $_SERVER['DOCUMENT_ROOT'].FILES_DIR);

//validate
define('VALIDATE_ALLOW',  0);
define('VALIDATE_DENY',  1);

//user status
define('STATUS_USER_REGIST',      0);
define('STATUS_USER_TMP',     1);

//manager status
define('STATUS_MANAGER_ON',      0);
define('STATUS_MANAGER_OFF',     1);

//regist status
define('REGIST_WAIT',         0);//仮登録状態
define('REGIST_FINISH',       1);//完了
define('REGIST_WRONG',        9);//不正

//manager type
define('TYPE_M_MANAGER',      0);
define('TYPE_M_SUPPORT',      8);//サポート
define('TYPE_M_ADMIN',        9);
define('TYPE_M_ADMIN_SHOP',   9);

//店舗のアイテムタイプ
define('SHOP_TYPE_LOGO'    ,  0);
define('SHOP_TYPE_FACE'    ,  1);
define('SHOP_TYPE_VISUAL'  ,  2);
define('SHOP_TYPE_PRODUCT' ,  3);
define('SHOP_TYPE_GALLERY' ,  4);
define('SHOP_TYPE_MAP_JA'  ,  5);//日本語用の地図
define('SHOP_TYPE_MAP_CN'  ,  6);//繁体字用の地図
define('SHOP_TYPE_MAP_TW'  ,  7);//繁体字用の地図
define('SHOP_TYPE_BARCODE' ,  8);//クーポン印刷画面用のバーコード画像

//coupon log method
define('COUPON_LOG_EDIT',     0);
define('COUPON_LOG_DROP',     1);

//お知らせターゲット
define('TARGET_ALL',        0);
define('TARGET_USER',       1);
define('TARGET_BUY_BEFORE', 2);
?>