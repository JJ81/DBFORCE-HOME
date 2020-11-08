<?php

namespace JCORP\Email;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;


require_once (__dir__ . '/google_info.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

// 구글을 통해서 이메일을 전달할 경우 처리
class EmailService
{
    private $ClientId=G_CLIENT;
    private $ClientSecret=G_SECRET;
    private $RefreshToken=G_REFRESH;
    private $EmailAddr=G_EMAIL_ADDR; // 이메일 발신 주체

    private $Error=null;
    private $Email=null; // object from PHPMailer


    /**
     * 이메일 전송을 위한 기본 서버세팅
     * EmailService constructor.
     */
    public function __construct(){
        $this->Email=new PHPMailer(true);
        $this->Email->CharSet = 'utf-8';


        // 0 = off (for production use, No debug messages)
        // 1 = client messages
        // 2 = client and server messages

        //Server settings
        $this->Email->SMTPDebug = 0; // Enable verbose
        $this->Email->isSMTP();                                      // Set mailer to use SMTP
        $this->Email->Host = G_HOST;  // Specify main and backup SMTP servers
        $this->Email->SMTPAuth = true;                               // Enable SMTP authentication
        $this->Email->SMTPSecure = G_SMTPSECURE;                            // Enable TLS encryption, `ssl` also accepted
        $this->Email->Port = G_PORT;                                    // TCP port to connect to
        $this->Email->AuthType = G_AUTHTYPE;

        $this->setAuth();
    }

    /**
     * google auth connection
     * @return bool
     */
    private function setAuth(){
        $result=false;
        try{
            //Create a new OAuth2 provider instance
            $provider = new Google(
                [
                    'clientId' => G_CLIENT,
                    'clientSecret' => G_SECRET
                ]
            );

            $this->Email->setOAuth(
                new OAuth(
                    [
                        'provider' => $provider,
                        'clientId' => G_CLIENT,
                        'clientSecret' => G_SECRET,
                        'refreshToken' => G_REFRESH,
                        'userName' => G_EMAIL_ADDR,
                    ]
                )
            );

            $result=true;
            // TODO auth login을 하지 못했을 경우 에러 처리는 어떻게 해야 하는가??
        } catch (Exception $e) {
            $this->Error=$e;
           // echo 'Message could not be set. Mailer Error: ', $this->Email->ErrorInfo;
        }

        return $result;
    }

    // 일단 하나의 계정에 대해서만 이메일을 보내는 기능을 추가한다.

    /**
     * 이메일 기본 정보를 세팅한다.
     * @param $receiverEmail
     */
    public function setEmailinfo($receiverEmail){
        $this->Email->setFrom($this->EmailAddr, G_SENDER_NAME); // 발신인 정보
        $this->Email->addAddress($receiverEmail); // 수취인 이메일
        $this->Email->addReplyTo($this->EmailAddr, G_SENDER_NAME); // 리턴받을 대상
    }

    /**
     * 이메일 정보를 세팅한다
     * @param $title
     * @param $html
     */
    public function setHTMLEmail($title, $html){
        $this->Email->isHTML(true);
        $this->Email->Subject = $title;
        $this->Email->Body    = $html;
    }

    /**
     * 이메일을 전송한다.
     */
    public function sendEmail(){
        $result=false;
        try {
            if(!$this->Email->send()){
                //echo 'Mailer error ' . $this->Email->ErrorInfo;
            }else{
                //echo 'Message has been sent';
                $result=true;
            }
        } catch (Exception $e) {
            $this->Error=$e;
            //echo 'Message could not be sent. Mailer Error: ', $this->Email->ErrorInfo;
        }

        return $result;
    }
}
