<?php
define('SETTING_INI', 'setting.ini');
define('SITE_NAME',   'gengo translation');

//SP
define('FIRSTSP',       10);

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
define('STATUS_FREE',      0);
define('STATUS_BUSY',     1);
define('STATUS_STOP',    2);

//regist status
define('REGIST_WAIT',         0);//仮登録状態
define('REGIST_FINISH',       1);//完了
define('REGIST_WRONG',        9);//不正

//manager type
define('TYPE_M_MANAGER',      0);
define('TYPE_M_SUPPORT',      8);//サポート
define('TYPE_M_ADMIN',        9);

define('TYPE_LANG_EN',      0);
define('TYPE_LANG_CN',      1);
define('TYPE_LANG_KR',      2);
define('TYPE_LANG_BACK',    99);

define('TYPE_LANG_EN_NAME',      '英語');
define('TYPE_LANG_CN_NAME',      '中国語');
define('TYPE_LANG_KR_NAME',      '韓国語');
define('TYPE_LANG_BACK_NAME',    'バックサポート');

?>