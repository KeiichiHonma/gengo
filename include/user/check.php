<?php
require_once('fw/checkManager.php');

//entry check
class checkUserEntry extends checkManager
{
    static private $check_list = array
    (
        'name'=>array
        (
            array('message'=>'！お名前は必須です。','func'=>'checkMust','arg'=>null),
            array('message'=>null,'func'=>'replaceInput','arg'=>'name')
        ),
        'directory'=>array
        (
            array('message'=>'！ディレクトリは必須です。','func'=>'checkMust','arg'=>null),
            array('message'=>'！同名のディレクトリが既に存在しています。','func'=>'checkUserDirectoryDuplication','arg'=>null),
            array('message'=>'！ディレクトリは英語のみ記載できます。','func'=>'checkEigoInt','arg'=>null),
            array('message'=>null,'func'=>'replaceInput','arg'=>'directory')
        ),
        'url'=>array
        (
            array('message'=>'！URLは必須です。','func'=>'checkMust','arg'=>null),
            array('message'=>'！URLが不正です。','func'=>'checkUrl','arg'=>null),
            array('message'=>null,'func'=>'replaceInput','arg'=>'directory')
        ),
        'domain'=>array
        (
            array('message'=>'！許可ドメインは必須です。','func'=>'checkMust','arg'=>null),
            array('message'=>null,'func'=>'replaceInput','arg'=>'directory')
        ),
        'depth'=>array
        (
            array('message'=>'！深さは数字のみ記載できます。','func'=>'checkInt','arg'=>null),
            array('message'=>null,'func'=>'replaceInput','arg'=>'directory')
        )
    );
            
    static public function checkError(){
        parent::checkError(self::$check_list);
    }
}

//entry check
class checkUserEdit extends checkManager
{
    static private $check_list = array
    (
        'name'=>array
        (
            array('message'=>'！お名前は必須です。','func'=>'checkMust','arg'=>null),
            array('message'=>null,'func'=>'replaceInput','arg'=>'name')
        ),
        'directory'=>array
        (
            array('message'=>'！ディレクトリは必須です。','func'=>'checkMust','arg'=>null),
            //array('message'=>'！同名のディレクトリが既に存在しています。','func'=>'checkUserDirectoryDuplication','arg'=>null),
            array('message'=>'！ディレクトリは英語のみ記載できます。','func'=>'checkEigoInt','arg'=>null),
            array('message'=>null,'func'=>'replaceInput','arg'=>'directory')
        ),
        'url'=>array
        (
            array('message'=>'！URLは必須です。','func'=>'checkMust','arg'=>null),
            array('message'=>'！URLが不正です。','func'=>'checkUrl','arg'=>null),
            array('message'=>null,'func'=>'replaceInput','arg'=>'directory')
        ),
        'domain'=>array
        (
            array('message'=>'！許可ドメインは必須です。','func'=>'checkMust','arg'=>null),
            array('message'=>null,'func'=>'replaceInput','arg'=>'directory')
        ),
        'depth'=>array
        (
            array('message'=>'！深さは数字のみ記載できます。','func'=>'checkInt','arg'=>null),
            array('message'=>null,'func'=>'replaceInput','arg'=>'directory')
        )
    );
            
    static public function checkError(){
        parent::checkError(self::$check_list);
    }
}
?>