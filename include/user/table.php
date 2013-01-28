<?php
require_once('fw/tableManager.php');
class userTable extends tableManager
{
    static private $table_info = array
        (
            array('column'=>'_id',               'as'=>'user_id',   'type'=>MINIMUM,   'input'=>FALSE, 'group'=>null),
            array('column'=>'ctime',             'as'=>null,        'type'=>COMMON,    'input'=>FALSE, 'group'=>null),
            array('column'=>'mtime',             'as'=>null,        'type'=>COMMON,    'input'=>FALSE, 'group'=>null),
            array('column'=>'name',              'as'=>null,        'type'=>COMMON,    'input'=>TRUE,  'group'=>null),
            array('column'=>'directory',         'as'=>null,        'type'=>COMMON,    'input'=>TRUE,  'group'=>null),
            array('column'=>'url',               'as'=>null,        'type'=>COMMON,    'input'=>TRUE,  'group'=>null),
            array('column'=>'domain',            'as'=>null,        'type'=>COMMON,    'input'=>TRUE,  'group'=>null),
            array('column'=>'depth',             'as'=>null,        'type'=>COMMON,    'input'=>TRUE,  'group'=>null),
            array('column'=>'rollover',          'as'=>null,        'type'=>COMMON,    'input'=>TRUE,  'group'=>null),
            array('column'=>'direct',            'as'=>null,        'type'=>COMMON,    'input'=>TRUE,  'group'=>null),
            array('column'=>'replace',           'as'=>null,        'type'=>COMMON,    'input'=>TRUE,  'group'=>null),
            array('column'=>'validate',          'as'=>null,        'type'=>COMMON,    'input'=>TRUE,  'group'=>null)
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

}
?>