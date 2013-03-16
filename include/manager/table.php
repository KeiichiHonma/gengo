<?php
require_once('fw/tableManager.php');
class managerTable extends tableManager
{
    //check内のキーは数時である必要あり
    static private $table_info = array
        (
            array('column'=>'_id',        'as'=>'manager_id',        'type'=>COMMON, 'input'=>FALSE, 'group'=>null),
            array('column'=>'ctime',      'as'=>null,                'type'=>ALL,    'input'=>FALSE, 'group'=>null),
            array('column'=>'mtime',      'as'=>null,                'type'=>ALL,    'input'=>FALSE, 'group'=>null),
            array('column'=>'mail',       'as'=>'manager_mail',      'type'=>COMMON, 'input'=>TRUE,  'group'=>'mail'),
            array('column'=>'given_name', 'as'=>'manager_given_name','type'=>COMMON, 'input'=>TRUE,  'group'=>'name'),
            array('column'=>'password',   'as'=>'manager_password',  'type'=>COMMON, 'input'=>TRUE,  'group'=>'password'),
            array('column'=>'salt',       'as'=>'manager_salt',      'type'=>ALL,    'input'=>FALSE, 'group'=>null),
            array('column'=>'score',      'as'=>'manager_score',     'type'=>COMMON, 'input'=>TRUE,  'group'=>null),
            array('column'=>'status',     'as'=>null,                'type'=>COMMON, 'input'=>TRUE,  'group'=>null),
            array('column'=>'type',       'as'=>'manager_type',      'type'=>COMMON, 'input'=>TRUE,  'group'=>null),
            array('column'=>'validate',   'as'=>'manager_validate',  'type'=>COMMON, 'input'=>FALSE, 'group'=>null)
        );
    
    static public function get($type = COMMON){
        return parent::get(self::$table_info,$type);
    }

    //aliasあり
    //aliasありの場合、第2引数は配列となる
    static public function getAlias($type = COMMON){
        return parent::getAlias(self::$table_info,array('type'=>$type,'alias'=>A_MANAGER));
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
?>