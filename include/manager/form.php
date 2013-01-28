<?php
require_once('fw/formManager.php');
class managerForm extends formManager
{
    function __construct(){

    }
    private $form = array
    (
        'ログイン情報'=>array
        (
            'メールアドレス'=>array(  'name'=>'mail',        'type'=>'text',    'func'=>null,      'class'=>'form_text_common','maxlength'=>null,'must'=>TRUE, 'front'=>'','back'=>'','remarks'=>''),
            'パスワード'=>array(      'name'=>'password',    'type'=>'password','func'=>null,      'class'=>'form_text_common','maxlength'=>null,'must'=>TRUE, 'front'=>'','back'=>'','remarks'=>''),
            'パスワードの確認'=>array('name'=>'password_c',  'type'=>'password','func'=>null,      'class'=>'form_text_common','maxlength'=>null,'must'=>TRUE, 'front'=>'','back'=>'','remarks'=>''),
            '表示名(店舗名)'=>array(  'name'=>'given_name',        'type'=>'text',    'func'=>null,      'class'=>'form_text_common','maxlength'=>null,'must'=>TRUE, 'front'=>'','back'=>'','remarks'=>'')
        )
    );

    public function getForm(){
        return parent::getForm($this->form,$this);
    }

    public function assignForm(){
        parent::assignForm($this->form,$this);
    }
}

class managerMailForm extends formManager
{
    function __construct(){

    }
    private $form = array
    (
        'ログイン情報'=>array
        (
            'メールアドレス'=>array(  'name'=>'mail',        'type'=>'text',    'func'=>null,      'class'=>'form_text_common','maxlength'=>null,'must'=>TRUE, 'front'=>'','back'=>'','remarks'=>'')
        )
    );

    public function getForm(){
        return parent::getForm($this->form,$this);
    }

    public function assignForm(){
        parent::assignForm($this->form,$this);
    }
}

class managerPasswordForm extends formManager
{
    function __construct(){

    }
    private $form = array
    (
        'ログイン情報'=>array
        (
            'パスワード'=>array(      'name'=>'password',    'type'=>'password','func'=>null,      'class'=>'form_text_common','maxlength'=>null,'must'=>TRUE, 'front'=>'','back'=>'','remarks'=>''),
            'パスワードの確認'=>array('name'=>'password_c',  'type'=>'password','func'=>null,      'class'=>'form_text_common','maxlength'=>null,'must'=>TRUE, 'front'=>'','back'=>'','remarks'=>'')
        )
    );

    public function getForm(){
        return parent::getForm($this->form,$this);
    }

    public function assignForm(){
        parent::assignForm($this->form,$this);
    }
}

class editManagerForm extends formManager
{
    private $mail_remarks = '';

    private $mid;
    
    function __construct($mid){
        $this->mid = $mid;
    }

    private $mail_form = array
    (
        'メールアドレス'=>array
        (
            '現在のメールアドレス'=>array(        'name'=>'given_name',         'type'=>'noedit',    'func'=>'getCurrentMail','class'=>'form_text_common',   'maxlength'=>null,'must'=>FALSE, 'front'=>'','back'=>'','remarks'=>''),
            '新しいメールアドレス'=>array(        'name'=>'mail',         'type'=>'text','func'=>null,                  'class'=>'form_text_common',   'maxlength'=>null,'must'=>TRUE, 'front'=>'','back'=>'','remarks'=>''),
            '新しいメールアドレスの確認'=>array(  'name'=>'mail_c',       'type'=>'text','func'=>null,                  'class'=>'form_text_common',   'maxlength'=>null,'must'=>TRUE, 'front'=>'','back'=>'','remarks'=>''),
        )
    );

    private $password_form = array
    (
        'パスワード'=>array
        (
            '現在のパスワード'=>array(        'name'=>'old_password',     'type'=>'password','func'=>null,                 'class'=>'form_text_common',   'maxlength'=>null,'must'=>TRUE, 'front'=>'','back'=>'','remarks'=>''),
            '新しいパスワード'=>array(        'name'=>'password',         'type'=>'password','func'=>null,                 'class'=>'form_text_common',   'maxlength'=>null,'must'=>TRUE, 'front'=>'','back'=>'','remarks'=>'※半角英数4～12文字以内で入力してください。'),
            '新しいパスワードの確認'=>array(  'name'=>'password_c',       'type'=>'password','func'=>null,                 'class'=>'form_text_common',   'maxlength'=>null,'must'=>TRUE, 'front'=>'','back'=>'','remarks'=>'※半角英数4～12文字以内で入力してください。'),
        )
    );

    private $name_form = array
    (
        '店舗名'=>array
        (
            '店舗名'=>array(        'name'=>'given_name',        'type'=>'text',    'func'=>'getCurrentName',      'class'=>'form_text_common','maxlength'=>'20','must'=>TRUE, 'front'=>'','back'=>'','remarks'=>'')
        )
    );
    //get
    public function getMailForm(){
        return parent::getForm($this->mail_form,$this);
    }

    public function getPasswordForm(){
        return parent::getForm($this->password_form,$this);
    }

    public function getNameForm(){
        return parent::getForm($this->name_form,$this);
    }

    //assign
    public function assignMailForm(){
        parent::assignForm($this->mail_form,$this);
    }
    
    public function assignPasswordForm(){
        parent::assignForm($this->password_form,$this);
    }

    public function assignNameForm(){
        parent::assignForm($this->name_form,$this);
    }

    public function getCurrentMail(){
        require_once('manager/logic.php');
        $m_logic = new managerLogic();
        $manager_info = $m_logic->getManager($this->mid);
        return $manager_info[0]['col_mail'];
    }

    public function getCurrentName(){
        require_once('manager/logic.php');
        $m_logic = new managerLogic();
        $manager_info = $m_logic->getManager($this->mid);
        return $manager_info[0]['col_name'];
    }
}
?>