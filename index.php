<?php
define("APPID","wxe53f432c460f2eed");//填写自己的APPID
define("APPSECRET","cfdb494139836ba603f7dea89ae6e8a2");//填写自己的APPSECRET
define("TOKEN", "anthony123");//token随便填，只要一致就行。
$wechat = new wechat();
$wechat->valid();//微信公众号安全验证
  
class wechat{
    private $_appid;
    private $_appsecret;
    private $_token;
    public function __construct(){
        $this->_appid =APPID;
        $this->_appsecret =APPSECRET;
        $this->_token =TOKEN;
    }
    /**
      *接入微信平台时验证
    **/
    public function valid()//检查安全性
    {
        $echoStr = $_GET["echostr"];
  
        //valid signature , option
        if($this->checkSignature()){//检查签名是否一致
            echo $echoStr;//验证成功后，输出
            exit;
        }
    }
    /**
      *验证签名
    **/
    private function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );
          
        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }
}
