<?php
require_once('fw/tableManager.php');
class inquiryTable extends tableManager
{
    static private $table_info = array
        (
            array('column'=>'_id',               'as'=>'inquiry_id', 'type'=>MINIMUM,  'input'=>FALSE),
            array('column'=>'ctime',             'as'=>null,        'type'=>ALL,       'input'=>FALSE),
            array('column'=>'mtime',             'as'=>null,        'type'=>ALL,       'input'=>FALSE),
            array('column'=>'company',           'as'=>null,        'type'=>COMMON,    'input'=>TRUE),
            array('column'=>'division',          'as'=>null,        'type'=>COMMON,    'input'=>TRUE),
            array('column'=>'name',              'as'=>null,        'type'=>COMMON,    'input'=>TRUE),
            array('column'=>'mail',              'as'=>null,        'type'=>COMMON,    'input'=>TRUE),
            array('column'=>'telephone1',        'as'=>null,        'type'=>COMMON,    'input'=>TRUE),
            array('column'=>'telephone2',        'as'=>null,        'type'=>COMMON,    'input'=>TRUE),
            array('column'=>'telephone3',        'as'=>null,        'type'=>COMMON,    'input'=>TRUE),
            array('column'=>'postcode1',         'as'=>null,        'type'=>COMMON,    'input'=>TRUE),
            array('column'=>'postcode2',         'as'=>null,        'type'=>COMMON,    'input'=>TRUE),
            array('column'=>'address',           'as'=>null,        'type'=>COMMON,    'input'=>TRUE),
            array('column'=>'detail',            'as'=>null,        'type'=>COMMON,    'input'=>TRUE)
        );
    
    static public function get($type = COMMON){
        return parent::get(self::$table_info,$type);
    }

    //aliasあり
    //aliasありの場合、第2引数は配列となる
    static public function getAlias($type = COMMON){
        return parent::getAlias(self::$table_info,array('type'=>$type,'alias'=>A_PARTNER_INQUIRY));
    }

    static public function getInput(){
        return parent::getInput(self::$table_info);
    }
}
?>