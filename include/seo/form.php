<?php
require_once('fw/formManager.php');
class seoForm extends formManager
{
    function __construct(){
    }

    private $form = array
    (
        'ユーザー情報'=>array
        (
            'キーワード'=>array(           'name'=>'keyword',       'type'=>'text',  'func'=>null,               'class'=>'form_text_large',    'maxlength'=>null,'must'=>TRUE, 'front'=>'','back'=>'', 'remarks'=>''),
            'ディスクリプション'=>array(   'name'=>'description',       'type'=>'text',  'func'=>null,               'class'=>'form_text_large',    'maxlength'=>null,'must'=>TRUE, 'front'=>'','back'=>'', 'remarks'=>''),
            'タイトル'=>array(             'name'=>'title',       'type'=>'text',  'func'=>null,               'class'=>'form_text_large',    'maxlength'=>null,'must'=>TRUE, 'front'=>'','back'=>'', 'remarks'=>''),
        )
    );
    
    
    public function getForm(){
        return parent::getForm($this->form,$this);
    }

    public function assignForm(){
        parent::assignForm($this->form,$this);
    }

}
?>