<?php
require_once('fw/formManager.php');
class inquiryForm extends formManager
{
    private $form = array
    (
        'お問い合わせ情報'=>array
        (
            '会社名'=>array(            'name'=>'company',       'type'=>'text',    'func'=>null,                 'class'=>'form_text_common',   'maxlength'=>null,'must'=>TRUE, 'front'=>'','back'=>'','remarks'=>null),
            '部署名'=>array(            'name'=>'division',       'type'=>'text',    'func'=>null,                 'class'=>'form_text_common',   'maxlength'=>null,'must'=>TRUE, 'front'=>'','back'=>'','remarks'=>null),
            '担当者'=>array(            'name'=>'name',       'type'=>'text',    'func'=>null,                 'class'=>'form_text_common',   'maxlength'=>null,'must'=>TRUE, 'front'=>'','back'=>'','remarks'=>null),
            'メールアドレス'=>array('name'=>'mail',             'type'=>'text',    'func'=>null,                 'class'=>'form_text_common',   'maxlength'=>null,'must'=>TRUE, 'front'=>'','back'=>'','remarks'=>null),
            '電話番号'=>array
            (
                array(                  'name'=>'telephone1',   'type'=>'text',    'func'=>null,                 'class'=>'form_text_number','maxlength'=>'3','must'=>TRUE, 'front'=>'','back'=>'－','remarks'=>null),
                array(                  'name'=>'telephone2',  'type'=>'text',    'func'=>null,                 'class'=>'form_text_number','maxlength'=>'4','must'=>TRUE, 'front'=>'','back'=>'－','remarks'=>null),
                array(                  'name'=>'telephone3',    'type'=>'text',    'func'=>null,                 'class'=>'form_text_number','maxlength'=>'4','must'=>TRUE, 'front'=>'','back'=>'','remarks'=>null)
            ),
            '郵便番号'=>array
            (
                array(                  'name'=>'postcode1',        'type'=>'text',    'func'=>null,                 'class'=>'form_text_postcode1','maxlength'=>'3','must'=>FALSE, 'front'=>'','back'=>'','remarks'=>null),
                array(                  'name'=>'postcode2',        'type'=>'text',    'func'=>null,                 'class'=>'form_text_postcode2','maxlength'=>'4','must'=>FALSE, 'front'=>'－','back'=>'','remarks'=>null)
            ),
            '住所'=>array(              'name'=>'address',          'type'=>'text',    'func'=>null,                 'class'=>'form_text_large',   'maxlength'=>null,'must'=>TRUE, 'front'=>'','back'=>'','remarks'=>null),
            'お問い合わせ内容'=>array('name'=>'detail','type'=>'textarea','func'=>null,      'class'=>'form_textarea_common','maxlength'=>null,'must'=>FALSE, 'front'=>'','back'=>'','remarks'=>'')
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