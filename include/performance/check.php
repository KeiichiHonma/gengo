<?php
require_once('fw/checkManager.php');

//check
class checkPerformance extends checkManager
{
    static private $check_list = array
    (
    );
            
    static public function checkError(){
        parent::checkError(self::$check_list);
    }
}
?>