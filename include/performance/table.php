<?php
require_once('fw/tableManager.php');
class performanceTable extends tableManager
{
    static private $table_info = array
        (
            array('column'=>'_id',               'as'=>'performance_id', 'type'=>MINIMUM,  'input'=>FALSE),
            array('column'=>'ctime',             'as'=>null,             'type'=>ALL,    'input'=>FALSE),
            array('column'=>'mtime',             'as'=>null,             'type'=>ALL,    'input'=>FALSE),
            array('column'=>'url',               'as'=>null,             'type'=>COMMON, 'input'=>TRUE),
            array('column'=>'seconds',           'as'=>null,             'type'=>COMMON, 'input'=>TRUE),
            array('column'=>'result',            'as'=>null,             'type'=>COMMON, 'input'=>TRUE),

        );
    
    static public function get($type = COMMON){
        return parent::get(self::$table_info,$type);
    }

    //aliasあり
    //aliasありの場合、第2引数は配列となる
    static public function getAlias($type = COMMON){
        return parent::getAlias(self::$table_info,array('type'=>$type,'alias'=>A_PERFORMANCE));
    }

    static public function getInput(){
        return parent::getInput(self::$table_info);
    }
}
?>