<?php
require_once('fw/checkManager.php');

class checkUserEntry extends checkManager
{
    static private $check_list = array
    (
        'mail'=>array
        (
            array('message'=>'！メールアドレスは必須です。','func'=>'checkMust','arg'=>null),
            array('message'=>'！メールアドレスが不正です。','func'=>'checkMail','arg'=>null),
            //debugでは消す。適当に追加するため
            //array('message'=>'！入力されたメールアドレスは既に使用されています。','func'=>'checkUserDuplication','arg'=>null)
        ),
        'password'=>array
        (
            array('message'=>'！パスワードは必須です。','func'=>'checkMust','arg'=>null)
        ),
        'password_c'=>array
        (
            array('message'=>'！パスワードの確認は必須です。','func'=>'checkMust','arg'=>null),
            array('message'=>'！パスワードとパスワードの確認が一致しません。','func'=>'checkMatch','arg'=>array('key'=>'password'))
        ),
        'given_name'=>array
        (
            array('message'=>'！表示名は必須です。','func'=>'checkMust','arg'=>null),
            array('message'=>'！表示名は全角で20字(半角40字)以内で入力してください。','func'=>'checkLength','arg'=>array('start'=>1,'end'=>40)),
            array('message'=>null,'func'=>'replaceInput','arg'=>'name')
        ),
        'facetime'=>array
        (
            array('message'=>'！facetimeIDは必須です。','func'=>'checkMust','arg'=>null),
            array('message'=>'！facetimeIDは、6文字以上32文字以内の英数字でなければなりません。','func'=>'checkSkypeName','arg'=>null),
            array('message'=>null,'func'=>'replaceInput','arg'=>'name')
        )
    );
            
    static public function checkError(){
        parent::checkError(self::$check_list);
    }
}

class checkUserEdit extends checkManager
{
    static private $check_list = array
    (
        'mail'=>array
        (
            array('message'=>'！メールアドレスは必須です。','func'=>'checkMust','arg'=>null),
            array('message'=>'！メールアドレスが不正です。','func'=>'checkMail','arg'=>null),
            //debugでは消す。適当に追加するため
            //array('message'=>'！入力されたメールアドレスは既に使用されています。','func'=>'checkUserDuplication','arg'=>null)
        ),
/*        'password'=>array
        (
            array('message'=>'！パスワードは必須です。','func'=>'checkMust','arg'=>null)
        ),
        'password_c'=>array
        (
            array('message'=>'！パスワードの確認は必須です。','func'=>'checkMust','arg'=>null),
            array('message'=>'！パスワードとパスワードの確認が一致しません。','func'=>'checkMatch','arg'=>array('key'=>'password'))
        ),*/
        'given_name'=>array
        (
            array('message'=>'！ユーザー名は必須です。','func'=>'checkMust','arg'=>null),
            array('message'=>'！ユーザー名は全角で20字(半角40字)以内で入力してください。','func'=>'checkLength','arg'=>array('start'=>1,'end'=>40)),
            array('message'=>null,'func'=>'replaceInput','arg'=>'name')
        )
    );
            
    static public function checkError(){
        parent::checkError(self::$check_list);
    }
}

class checkUserMailEdit extends checkManager
{
    static private $check_list = array
    (
        'mail'=>array
        (
            array('message'=>'！メールアドレスは必須です。','func'=>'checkMust','arg'=>null),
            array('message'=>'！メールアドレスが不正です。','func'=>'checkMail','arg'=>null),
            //debugでは消す。適当に追加するため
            //array('message'=>'！入力されたメールアドレスは既に使用されています。','func'=>'checkUserDuplication','arg'=>null)
        )
    );
            
    static public function checkError(){
        parent::checkError(self::$check_list);
    }
}

class checkUserPasswordEdit extends checkManager
{
    static private $check_list = array
    (
        'password'=>array
        (
            array('message'=>'！パスワードは必須です。','func'=>'checkMust','arg'=>null)
        ),
        'password_c'=>array
        (
            array('message'=>'！パスワードの確認は必須です。','func'=>'checkMust','arg'=>null),
            array('message'=>'！パスワードとパスワードの確認が一致しません。','func'=>'checkMatch','arg'=>array('key'=>'password'))
        )
    );
            
    static public function checkError(){
        parent::checkError(self::$check_list);
    }
}

class checkLogin extends checkManager
{
    static private $check_list = array
    (
        'mail'=>array
        (
            array('message'=>'メールアドレスは必須です。','func'=>'checkMust','arg'=>null),
            array('message'=>'メールアドレスが不正です。','func'=>'checkMail','arg'=>null)
        ),
        'password'=>array
        (
            array('message'=>'パスワードは必須です。','func'=>'checkMust','arg'=>null)
            //array('message'=>'パスワードは半角英数4～12文字以内で入力してください。','func'=>'checkLength','arg'=>array('start'=>4,'end'=>12))
        )
    );

    static public function checkError(){
        parent::checkError(self::$check_list);
    }

}
?>