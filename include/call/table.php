<?php
require_once('fw/tableManager.php');
class callTable extends tableManager
{
    //check内のキーは数時である必要あり
    static private $table_info = array
        (
            array('column'=>'_id',      'as'=>'call_id', 'type'=>COMMON, 'input'=>FALSE, 'group'=>null),
            array('column'=>'ctime',    'as'=>null,         'type'=>COMMON,    'input'=>FALSE, 'group'=>null),
            array('column'=>'mtime',    'as'=>null,         'type'=>COMMON,    'input'=>FALSE, 'group'=>null),
            array('column'=>'uid',     'as'=>null,         'type'=>COMMON, 'input'=>FALSE,  'group'=>null),
            array('column'=>'mid',     'as'=>null,         'type'=>COMMON, 'input'=>FALSE,  'group'=>null),
            array('column'=>'type',     'as'=>'call_type',         'type'=>COMMON, 'input'=>FALSE,  'group'=>null),
            array('column'=>'assign',  'as'=>null,         'type'=>COMMON, 'input'=>FALSE, 'group'=>null),
            array('column'=>'finish',  'as'=>null,         'type'=>COMMON, 'input'=>FALSE, 'group'=>null)
        );
    
    static public function get($type = COMMON){
        return parent::get(self::$table_info,$type);
    }

    //aliasあり
    //aliasありの場合、第2引数は配列となる
    static public function getAlias($type = COMMON){
        return parent::getAlias(self::$table_info,array('type'=>$type,'alias'=>A_CALL));
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