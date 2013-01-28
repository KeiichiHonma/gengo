<?php
require_once('fw/tableManager.php');
class seoTable extends tableManager
{
    static private $table_info = array
        (
            array('column'=>'_id',               'as'=>'seo_id',    'type'=>MINIMUM,   'input'=>FALSE, 'group'=>null),
            array('column'=>'ctime',             'as'=>null,        'type'=>COMMON,    'input'=>FALSE, 'group'=>null),
            array('column'=>'mtime',             'as'=>null,        'type'=>COMMON,    'input'=>FALSE, 'group'=>null),
            array('column'=>'uid',               'as'=>null,        'type'=>COMMON,    'input'=>TRUE,  'group'=>null),
            array('column'=>'absolute_html_file','as'=>null,        'type'=>COMMON,    'input'=>TRUE,  'group'=>null),
            array('column'=>'keyword',           'as'=>null,        'type'=>COMMON,    'input'=>TRUE,  'group'=>null),
            array('column'=>'description',       'as'=>null,        'type'=>COMMON,    'input'=>TRUE,  'group'=>null),
            array('column'=>'title',             'as'=>null,        'type'=>COMMON,    'input'=>TRUE,  'group'=>null)
        );
    
    static public function get($type = COMMON){
        return parent::get(self::$table_info,$type);
    }

    //aliasあり
    //aliasありの場合、第2引数は配列となる
    static public function getAlias($type = COMMON){
        return parent::getAlias(self::$table_info,array('type'=>$type,'alias'=>A_SEO));
    }

    static public function getInput(){
        return parent::getInput(self::$table_info);
    }

}
?>