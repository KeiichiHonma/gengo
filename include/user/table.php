<?php
require_once('fw/tableManager.php');
class userTable extends tableManager
{
    //check内のキーは数時である必要あり
    static private $table_info = array
        (
            array('column'=>'_id',        'as'=>'user_id',        'type'=>COMMON, 'input'=>FALSE, 'group'=>null),
            array('column'=>'ctime',      'as'=>null,             'type'=>ALL,    'input'=>FALSE, 'group'=>null),
            array('column'=>'mtime',      'as'=>null,             'type'=>ALL,    'input'=>FALSE, 'group'=>null),
            array('column'=>'mail',       'as'=>'user_mail',      'type'=>COMMON, 'input'=>TRUE,  'group'=>'mail'),
            array('column'=>'given_name', 'as'=>'user_given_name','type'=>COMMON, 'input'=>TRUE,  'group'=>'name'),
            array('column'=>'password',   'as'=>'user_password',  'type'=>COMMON, 'input'=>TRUE,  'group'=>'password'),
            array('column'=>'salt',       'as'=>'user_salt',      'type'=>ALL,    'input'=>FALSE, 'group'=>null),
            array('column'=>'facetime',   'as'=>null,             'type'=>COMMON, 'input'=>TRUE,  'group'=>'name'),
            array('column'=>'score',      'as'=>'user_score',     'type'=>COMMON, 'input'=>FALSE,  'group'=>null),
            array('column'=>'validate',   'as'=>'user_validate',  'type'=>COMMON, 'input'=>FALSE, 'group'=>null)
        );
    
    static public function get($type = COMMON){
        return parent::get(self::$table_info,$type);
    }

    //aliasあり
    //aliasありの場合、第2引数は配列となる
    static public function getAlias($type = COMMON){
        return parent::getAlias(self::$table_info,array('type'=>$type,'alias'=>A_USER));
    }

    static public function getInput(){
        return parent::getInput(self::$table_info);
    }

    static public function getMail(){
        return parent::getGroup(self::$table_info,'mail');
    }

    static public function getPassword(){
        return parent::getGroup(self::$table_info,'password');
    }
}
class autoLoginTable extends tableManager
{
    static private $table_info = array
        (
            array('column'=>'_id',      'as'=>'auto_login_id', 'type'=>COMMON, 'input'=>FALSE),
            array('column'=>'ctime',    'as'=>null,           'type'=>ALL,    'input'=>FALSE),
            array('column'=>'mtime',    'as'=>null,           'type'=>ALL,    'input'=>FALSE),
            array('column'=>'uid',      'as'=>null,           'type'=>COMMON, 'input'=>TRUE),
            array('column'=>'passport', 'as'=>null,           'type'=>COMMON, 'input'=>TRUE)
        );
    
    static public function get($type = COMMON){
        return parent::get(self::$table_info,$type);
    }

    //aliasあり
    //aliasありの場合、第2引数は配列となる
    static public function getAlias($type = COMMON){
        return parent::getAlias(self::$table_info,array('type'=>$type,'alias'=>A_AUTO));
    }

    static public function getInput(){
        return parent::getInput(self::$table_info);
    }
}
?>