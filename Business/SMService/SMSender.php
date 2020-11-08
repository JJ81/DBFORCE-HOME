<?php

namespace JCORP\Business\SMService;

require_once __dir__ . '/sms_aligo_info.php';

class SMSender
{

    private $user_id=ALIGO_USER_ID;
    private $api_key=ALIGO_API_KEY;
    protected $url=ALIGO_URL;
    protected $url_query=ALIGO_QUERY_URL;

    protected $subject=null;
    protected $msg=null;
    protected $sender=null;
    protected $receiver=null;
    protected $testmode_yn=null;

    private $send_result=null;

    public function __construct(){}


    /**
     * 데이터를 전달하기 전에 설정해야 하는 메서드
     * @param $msg
     * @param $sender
     * @param $receiver
     * @param $testMode
     */
    public function setSMSData($msg, $sender, $receiver, $testMode){
        $this->msg=$msg;
        $this->sender=$sender;
        $this->receiver=$receiver;
        $this->testmode_yn=$testMode;
    }

    // SMS 메시지를 전송하는 메서드
    public function sendMsg(){
        $sms['user_id']=$this->user_id;
        $sms['key']=$this->api_key;
        $sms['msg'] = stripslashes($this->msg);
        $sms['receiver'] = $this->receiver;
        $sms['sender'] = $this->sender;
        $sms['testmode_yn'] = empty($this->testmode_yn) ? '' : $this->testmode_yn;
        $host_info = explode("/", $this->url);
        $port = $host_info[0] == 'https:' ? 443 : 80;

        $oCurl = curl_init();
        curl_setopt($oCurl, CURLOPT_PORT, $port);
        curl_setopt($oCurl, CURLOPT_URL, $this->url);
        curl_setopt($oCurl, CURLOPT_POST, 1);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($oCurl, CURLOPT_POSTFIELDS, $sms);
        curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
        $ret = curl_exec($oCurl);
        curl_close($oCurl);

        $this->send_result=$ret;

        return $ret;
    }

    public function checkStatus($msg_id){}

    public function getMessage(){}


}
