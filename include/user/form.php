<?php
require_once('fw/formManager.php');
class userForm extends formManager
{
    function __construct(){
    }

    private $form = array
    (
        'ユーザー情報'=>array
        (
            '名前'=>array(            'name'=>'name',      'type'=>'text',  'func'=>null,               'class'=>'form_text_common',   'maxlength'=>null,'must'=>TRUE, 'front'=>'','back'=>'', 'remarks'=>''),
            'ディレクトリ名'=>array(  'name'=>'directory', 'type'=>'text',  'func'=>null,               'class'=>'form_text_common',   'maxlength'=>null,'must'=>TRUE, 'front'=>'','back'=>'', 'remarks'=>''),
            'URL'=>array(             'name'=>'url',       'type'=>'text',  'func'=>null,               'class'=>'form_text_large',    'maxlength'=>null,'must'=>TRUE, 'front'=>'','back'=>'', 'remarks'=>''),
            '深さ'=>array(            'name'=>'depth',      'type'=>'text',  'func'=>null,               'class'=>'form_text_common',   'maxlength'=>null,'must'=>FALSE, 'front'=>'','back'=>'', 'remarks'=>''),
            '許可ドメイン'=>array(  'name'=>'domain', 'type'=>'textarea',  'func'=>null,               'class'=>'form_textarea_little',   'maxlength'=>null,'must'=>TRUE, 'front'=>'','back'=>'', 'remarks'=>'カンマ区切り'),
            'ロールオーバー'=>array(  'name'=>'rollover', 'type'=>'textarea',  'func'=>null,               'class'=>'form_textarea_little',   'maxlength'=>null,'must'=>FALSE, 'front'=>'','back'=>'', 'remarks'=>'カンマ,改行区切り'),
            'ファイル直接指定'=>array(  'name'=>'direct', 'type'=>'textarea',  'func'=>null,               'class'=>'form_textarea_little',   'maxlength'=>null,'must'=>FALSE, 'front'=>'','back'=>'', 'remarks'=>'改行区切り'),
            '置換文字列指定'=>array(  'name'=>'replace', 'type'=>'textarea',  'func'=>null,               'class'=>'form_textarea_little',   'maxlength'=>null,'must'=>FALSE, 'front'=>'','back'=>'', 'remarks'=>'カンマ,改行区切り'),
            '有効/無効'=>array(       'name'=>'validate',  'type'=>'radio', 'func'=>'getValidateRadio', 'class'=>'',                   'maxlength'=>null,'must'=>TRUE, 'front'=>'','back'=>'','m_text_style'=>null, 'remarks'=>''),
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