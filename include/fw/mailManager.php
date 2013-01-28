<?php

class mailManager
{
    private $mail;
    private $mail_template;
    
    private $halt_real = array
    (
        array( 'halt@813.co.jp' , 'halt' )
    );

    private $halt_debug = array
    (
        array( 'honma@zeus.corp.813.co.jp' , 'halt' )
    );

    private $dev_real = array
    (
        array( 'keiichi-honma@813.co.jp' , 'dev' )
    );

    private $dev_debug = array
    (
        array( 'honma@zeus.corp.813.co.jp' , 'halt' )
    );

    //イルナに送る
    private $hachione_real = array
    (
        array( 'info@813.co.jp' , '[ハチワン]' )
    );

    private $hachione_debug = array
    (
        array( 'honma@zeus.corp.813.co.jp' , '[ハチワン]' )
    );

    function __construct(){
        require_once('fw/qdmail.php');
        mb_language('uni');
        $this->mail =  new Qdmail();
        $this->mail  -> charsetHeader( 'utf-8' ) ;
        $this->mail  -> charsetBody( 'utf-8','Base64') ;
    }

    private function callTemplate(){
        $this->mail->resetHeader();
        require_once('locale/'.LOCALE.'/mailTemplate.php');//翻訳ファイル
        //require_once('fw/mailTemplate.php');
        $this->mail_template = new mailTemplate();
    }

    private function append(){
        //戻し
        $this->mail_template->ca_url = null;
        $this->mail_template->ca_url_ssl = null;
    }

    //宛先/////////////////////////////////////////////////////////////////////////////////////////////////
    public function sendHalt($body,$shutdown_error = null){
        global $con;
        if($con->isDebug){
            $this->mail-> to( $this->halt_debug );
        }else{
            $this->mail-> to( $this->halt_real );
        }

        $body .= "\n\nhalt----------------------------------------------------\n\n";
        $body .= 'URL : '.$_SERVER['SCRIPT_NAME']."\n";
        if(isset($_SERVER['HTTP_REFERER'])) $body .= 'REFERER : '.$_SERVER['HTTP_REFERER']."\n";
        $body .= 'USER_AGENT : '.$_SERVER['HTTP_USER_AGENT']."\n";
        $body .= 'ADDR : '.$_SERVER['REMOTE_ADDR']."\n";
        
        if(!is_null($shutdown_error)){
            foreach ($shutdown_error as $key => $value){
                $body .= $key.$value."\n";
            }
        }
        
        $this->mail-> subject(LOCALE.':adviser:Halt');
        $this->mail->text($body);
        $this->setFrom();
        $this->mail->send();
    }

    private function setRegistTo($mail){
        global $con;
        if($con->isDebug){
            $this->mail -> to( array($mail) );
            $this->mail -> bcc( $this->hachione_debug );
        }else{
            $this->mail -> to( array($mail) );
            $this->mail -> bcc( $this->hachione_real );
        }
    }

    private function setInquiryTo($mail){
        $this->mail -> to( array($mail) );
    }

    private function setHachioneTo(){
        global $con;
        if($con->isDebug){
            $this->mail -> to( $this->hachione_debug );
        }else{
            $this->mail -> to( $this->hachione_real );
        }
    }

    private function setFrom(){
        if($con->isDebug){
            $this->mail->from( $this->hachione_debug );
        }else{
            $this->mail->from( $this->hachione_real );
        }
    }

    public function sendInquiry($isHachione = FALSE){
        require_once('inquiry/form.php');
        $form = new inquiryForm();
        if($isHachione){
            $this->setHachioneTo();
        }else{
            $this->setInquiryTo($_POST['mail']);
        }
        
        $subject = $isHachione ? '[China Adviser]お問い合わせがありました' : '[China Adviser]お問い合わせありがとうございます';
        $this->mail->subject($subject);
        
        $message = '';
        $message .= '━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━'."\n";
        $message .= 'このメールは、登録メールアドレス宛に自動的にお送りしています。'."\n";
        $message .= '━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━'."\n";


        $message .= $_POST['name']." 様\n\n";
        $message .= 'この度は[China Adviser]へのお問い合わせ誠にありがとうございます'."\n\n";

        $message .= "お問い合わせ内容----------------------------------------------------\n";
        $message .= '●会社名'."\n";
        $message .= $_POST['company']."\n\n";

        $message .= '●氏名'."\n";
        $message .= $_POST['name']."\n\n";

        $message .= '●氏名（フリガナ）'."\n";
        $message .= $_POST['kana']."\n\n";

        $message .= '●貴社サイトURL'."\n";
        $message .= $_POST['url']."\n\n";
        
        $message .= '●メールアドレス'."\n";
        $message .= $_POST['mail']."\n\n";

        $message .= '●電話番号'."\n";
        $message .= $_POST['telephone1'].'－'.$_POST['telephone2'].'－'.$_POST['telephone3']."\n\n";
        
        $message .= '●FAX番号'."\n";
        $message .= $_POST['fax1'].'－'.$_POST['fax2'].'－'.$_POST['fax3']."\n\n";
        
        $message .= '●郵便番号'."\n";
        $message .= $_POST['postcode1'].'－'.$_POST['postcode2']."\n\n";
        
        $message .= '●住所'."\n";
        $message .= $_POST['address']."\n\n";


        $message .= '●お問い合わせ内容'."\n";
        foreach ($form->trigger as $key => $value){
            if(in_array($key,$_POST['check'])){
                $message .= $form->trigger[$key];
                if($key == 'etc_check' && isset($_POST['etc_name'])){
                    $message .= ' '.$_POST['etc_name'];
                }
                $message .= "\n";
            }
        }

        $message .= '●ご質問など'."\n";
        $message .= $_POST['detail']."\n";
        if(!$isHachione){
            $message .= "\n".'後日、担当者よりご連絡させていただきます。'."\n";
            $message .= '今後とも「China Adviser」を宜しくお願いいたします。 '."\n";

            $message .= "\n".'━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━'."\n";
            $message .= '┏┏┏ 株式会社81(ハチワン)'."\n";
            $message .= '┏┏┏ +世界をつなぎ、世界を身近に+'."\n";
            $message .= '┏┏┏ URL : http://www.813.co.jp/'."\n";
            $message .= '┏┏┏ Mail: info@813.co.jp'."\n";
            $message .= '━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━';

        }

        $this->mail->text($message);
        
        $from = array
        (
            array( 'info@813.co.jp' , '株式会社ハチワン' )
        );
        $this->mail->from( $from );
        $this->mail->send();
        $this->append();
    }

    public function sendTumblrInquiry($isHachione = FALSE){
        require_once('inquiry/form.php');
        $form = new inquiryForm();
        if($isHachione){
            $this->setHachioneTo();
        }else{
            $this->setInquiryTo($_POST['mail']);
        }
        
        $subject = $isHachione ? '[China Adviser]ブログ経由でお問い合わせがありました' : '[China Adviser]お問い合わせありがとうございます';
        $this->mail->subject($subject);
        
        $message = '';
        $message .= '━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━'."\n";
        $message .= 'このメールは、登録メールアドレス宛に自動的にお送りしています。'."\n";
        $message .= '━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━'."\n";


        $message .= $_POST['name']." 様\n\n";
        $message .= 'この度は[China Adviser]へのお問い合わせ誠にありがとうございます'."\n\n";

        $message .= "お問い合わせ内容----------------------------------------------------\n";
        if(isset( $_POST['company'])){
            $message .= '●会社名'."\n";
            $message .= $_POST['company']."\n\n";
        }

        if(isset( $_POST['name'])){
            $message .= '●氏名'."\n";
            $message .= $_POST['name']."\n\n";
        }
        

        if(isset( $_POST['kana'])){
            $message .= '●氏名（フリガナ）'."\n";
            $message .= $_POST['kana']."\n\n";
        }

        if(isset( $_POST['mail'])){
            $message .= '●メールアドレス'."\n";
            $message .= $_POST['mail']."\n\n";
        }

        if(isset( $_POST['telephone'])){
            $message .= '●電話番号'."\n";
            $message .= $_POST['telephone']."\n\n";
        }

        if(isset( $_POST['address'])){
            $message .= '●住所'."\n";
            $message .= $_POST['address']."\n\n";
        }

        if(isset( $_POST['check'] ) && count($_POST['check']) > 0 ){
            $message .= '●お問い合わせ内容'."\n";
            foreach ($form->trigger as $key => $value){
                if(in_array($key,$_POST['check'])){
                    $message .= $form->trigger[$key];
                    if($key == 'etc_check' && isset($_POST['etc_name'])){
                        $message .= ' '.$_POST['etc_name'];
                    }
                    $message .= "\n";
                }
            }
        }

        if(isset( $_POST['detail'])){
            $message .= '●ご質問など'."\n";
            $message .= $_POST['detail']."\n";
        }

        if(!$isHachione){
            $message .= "\n".'後日、担当者よりご連絡させていただきます。'."\n";
            $message .= '今後とも「China Adviser」を宜しくお願いいたします。 '."\n";

            $message .= "\n".'━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━'."\n";
            $message .= '┏┏┏ 株式会社81(ハチワン)'."\n";
            $message .= '┏┏┏ +世界をつなぎ、世界を身近に+'."\n";
            $message .= '┏┏┏ URL : http://www.813.co.jp/'."\n";
            $message .= '┏┏┏ Mail: info@813.co.jp'."\n";
            $message .= '━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━';

        }

        $this->mail->text($message);
        
        $from = array
        (
            array( 'info@813.co.jp' , '株式会社ハチワン' )
        );
        $this->mail->from( $from );
        $this->mail->send();
        $this->append();
    }

    public function sendPartnerInquiry($isHachione = FALSE){
        if($isHachione){
            $this->setHachioneTo();
        }else{
            $this->setInquiryTo($_POST['mail']);
        }
        
        $subject = $isHachione ? '[China Adviser]セールスパートナーお問い合わせがありました' : '[China Adviser]セールスパートナーお問い合わせありがとうございます';
        $this->mail->subject($subject);
        
        $message = '';
        $message .= '━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━'."\n";
        $message .= 'このメールは、登録メールアドレス宛に自動的にお送りしています。'."\n";
        $message .= '━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━'."\n";


        $message .= $_POST['name']." 様\n\n";
        $message .= 'この度は[China Adviser]へのセールスパートナーお問い合わせ誠にありがとうございます'."\n\n";

        $message .= "お問い合わせ内容----------------------------------------------------\n";
        $message .= '●会社名'."\n";
        $message .= $_POST['company']."\n\n";

        $message .= '●部署'."\n";
        $message .= $_POST['division']."\n\n";

        $message .= '●担当者'."\n";
        $message .= $_POST['name']."\n\n";
                
        $message .= '●メールアドレス'."\n";
        $message .= $_POST['mail']."\n\n";

        $message .= '●電話番号'."\n";
        $message .= $_POST['telephone1'].'－'.$_POST['telephone2'].'－'.$_POST['telephone3']."\n\n";
        
        $message .= '●郵便番号'."\n";
        $message .= $_POST['postcode1'].'－'.$_POST['postcode2']."\n\n";
        
        $message .= '●住所'."\n";
        $message .= $_POST['address']."\n\n";


        $message .= '●お問い合わせ内容'."\n";
        $message .= $_POST['detail']."\n";
        if(!$isHachione){
            $message .= "\n".'後日、担当者よりご連絡させていただきます。'."\n";
            $message .= '今後とも「China Adviser」を宜しくお願いいたします。 '."\n";

            $message .= "\n".'━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━'."\n";
            $message .= '┏┏┏ 株式会社81(ハチワン)'."\n";
            $message .= '┏┏┏ +世界をつなぎ、世界を身近に+'."\n";
            $message .= '┏┏┏ URL : http://www.813.co.jp/'."\n";
            $message .= '┏┏┏ Mail: info@813.co.jp'."\n";
            $message .= '━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━';

        }

        $this->mail->text($message);
        
        $from = array
        (
            array( 'info@813.co.jp' , '株式会社ハチワン' )
        );
        $this->mail->from( $from );
        $this->mail->send();
        $this->append();
    }

    //デバッグ
    public function sendDebug($string){
        global $con;
        if($con->isDebug){
            $this->mail-> to( $this->dev_debug );
        }else{
            $this->mail-> to( $this->dev_real );
        }
        
        $this->mail-> subject('デバッグ');
        $this->mail->text($string);
        $this->setFrom();
        $this->mail->send();
    }
}
?>
