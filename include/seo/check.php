<?php
require_once('fw/checkManager.php');

//entry check
class checkSeo extends checkManager
{
    static private $check_list = array
    (
        'uid'=>array
        (
            array('message'=>'！uidは必須です。','func'=>'checkMust','arg'=>null),
            array('message'=>null,'func'=>'replaceInput','arg'=>'name')
        ),
        'absolute_html_file'=>array
        (
            array('message'=>'！absolute_html_fileは必須です。','func'=>'checkMust','arg'=>null),
            array('message'=>null,'func'=>'replaceInput','arg'=>'name')
        ),
        'keyword'=>array
        (
            array('message'=>'！キーワードは必須です。','func'=>'checkMust','arg'=>null),
            array('message'=>null,'func'=>'replaceInput','arg'=>'name')
        ),
        'description'=>array
        (
            array('message'=>'！ディスクリプションは必須です。','func'=>'checkMust','arg'=>null),
            array('message'=>null,'func'=>'replaceInput','arg'=>'directory')
        ),
        'title'=>array
        (
            array('message'=>'！タイトルは必須です。','func'=>'checkMust','arg'=>null),
            array('message'=>null,'func'=>'replaceInput','arg'=>'directory')
        )
    );
            
    static public function checkError(){
        parent::checkError(self::$check_list);
    }
}
?>