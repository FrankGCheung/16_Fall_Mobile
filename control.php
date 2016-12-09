<?php
/**
  * wechat php test
  */
$servername = "localhost";
$username = "root";
$password = "960724";
$mydb = "house";
//define your token
define("TOKEN", "weixin");
$wechatObj = new wechatCallbackapiTest();
//$wechatObj->echo_server_log($log);
$wechatObj->valid();
//$wechatObj->getPostData();
$wechatObj->responseMsg();
class wechatCallbackapiTest
{
    public function valid()
    {
        $echoStr = $_GET["echostr"];
        //valid signature , option
        if($this->checkSignature()){
            echo $echoStr;
            exit;
        }
    }
    public function responseMsg()
    {
                $servername = "localhost";
                $username = "root";
                $passwd = "960724";
                $mydb = "house";
        //get post data, May be due to the different environments
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        //extract post data
        if (!empty($postStr)){
                            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                            $fromUsername = $postObj->FromUserName;
                            $toUsername = $postObj->ToUserName;
                            $msgType = $postObj->MsgType;
                            if($msgType == 'text'){
                                     $content = $postObj->Content;
                                }else{
                                    $retMsg = 'Only support voice and text message';
                                }
                    if ($content == "sensor_1") {
                     	$conn = new mysqli($servername,$username, $passwd,$mydb);
                     	if ($conn->connect_error) {
                     		die("Connection failed: " . $conn->connect_error);
                     	}
                     	$sql = "select value from sensor where id = 1 ";
                     	$result = $conn->query($sql);
                     	if($result->num_rows >0 ){
                     		$row = $result->fetch_assoc();
                     		$sensor_1 = $row["value"];
                     	}
                    	$retMsg = "The Value of Sensor_1 is ".$sensor_1;
                    	$conn->close();
                    }else if ($content ==  "sensor_2") {
                        $conn = new mysqli($servername,$username, $passwd,$mydb);
                     	if ($conn->connect_error) {
                     		die("Connection failed: " . $conn->connect_error);
                     	}
                     	$sql = "select value from sensor where id = 2 ";
                     	$result = $conn->query($sql);
                     	if($result->num_rows >0 ){
                     		$row = $result->fetch_assoc();
                     		$sensor_2 = $row["value"];
                     	}
                    	$retMsg = "The Value of Sensor_1 is ".$sensor_2;
                    	$conn->close();
                    }else if ($content=="sensor_3") {
                        $conn = new mysqli($servername,$username, $passwd,$mydb);
                     	if ($conn->connect_error) {
                     		die("Connection failed: " . $conn->connect_error);
                     	}
                     	$sql = "select value from sensor where id = 3 ";
                     	$result = $conn->query($sql);
                     	if($result->num_rows >0 ){
                     		$row = $result->fetch_assoc();
                     		$sensor_3 = $row["value"];
                     	}
                    	$retMsg = "The Value of Sensor_1 is ".$sensor_3;
                    	$conn->close();
                    }else if ($content == "switch_1") {
                         $conn = new mysqli($servername,$username, $passwd,$mydb);
                     	if ($conn->connect_error) {
                     		die("Connection failed: " . $conn->connect_error);
                     	}
                     	$sql = "select state from switch where id = 1 ";
                     	$result = $conn->query($sql);
                     	if($result->num_rows >0 ){
                     		$row = $result->fetch_assoc();
                     		$switch_1 = $row["state"];
                     	}
                     	if ($switch_1 == 0)
                     	{
                     		$retMsg = "Close";
                     	}else {
                     		$retMsg = "Open";
                     	}
                    $conn->close();
                    }else if ($content == "switch_2") {
                         $conn = new mysqli($servername,$username, $passwd,$mydb);
                     	if ($conn->connect_error) {
                     		die("Connection failed: " . $conn->connect_error);
                     	}
                     	$sql = "select state from switch where id = 2 ";
                     	$result = $conn->query($sql);
                     	if($result->num_rows >0 ){
                     		$row = $result->fetch_assoc();
                     		$switch_1 = $row["state"];
                     	}
                     	if ($switch_1 == 0)
                     	{
                     		$retMsg = "Close";
                     	}else {
                     		$retMsg = "Open";
                     	}
                    $conn->close();
                    }else if ($content == "open_switch_1") {
                    	$conn = new mysqli($servername,$username, $passwd,$mydb);
                    	if ($conn->connect_error) {
                    		die("Connection failed: " . $conn->connect_error);
                    	}
                    	$sql = "update switch set state = 1 where id =1";
                    	$result = $conn->query($sql);
                    	$conn->close();
                    	$retMsg = "OK";
                    }else if($content == "close_switch_1") {
                    	$conn = new mysqli($servername,$username, $passwd,$mydb);
                    	if ($conn->connect_error) {
                    		die("Connection failed: " . $conn->connect_error);
                    	}
                    	$sql = "update switch set state = 0 where id =1";
                    	$result = $conn->query($sql);
                    	$conn->close();
                    	$retMsg = "OK";
                    }else if ($content == "open_switch_2") {
                    	$conn = new mysqli($servername,$username, $passwd,$mydb);
                    	if ($conn->connect_error) {
                    		die("Connection failed: " . $conn->connect_error);
                    	}
                    	$sql = "update switch set state = 1 where id =2";
                    	$result = $conn->query($sql);
                    	$conn->close();
                    	$retMsg = "OK";
                    }else if($content ==  "close_switch_2") {
                    	$conn = new mysqli($servername,$username, $passwd,$mydb);
                    	if ($conn->connect_error) {
                    		die("Connection failed: " . $conn->connect_error);
                    	}
                    	$sql = "update switch set state = 0 where id =2";
                    	$result = $conn->query($sql);
                    	$conn->close();
                    	$retMsg = "OK";
                    }else{
                        $retMsg = "haven't support yet!";
                    }
                    $msgType = "text";
                            // $keyword = trim($postObj->Content);
                             $textTpl = "<xml>
                   <ToUserName><![CDATA[%s]]></ToUserName>
                   <FromUserName><![CDATA[%s]]></FromUserName>
                   <CreateTime>%s</CreateTime>
                   <MsgType><![CDATA[%s]]></MsgType>
                   <Content><![CDATA[%s]]></Content>
                   <FuncFlag>0</FuncFlag>
                   </xml>";
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, time(), $msgType,$retMsg);
                    echo $resultStr;
        }else {
            echo "";
            exit;
        }
    }
    private function checkSignature(){
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );
        if( $tmpStr == $signature ){
            return true;
    }else{
      return false;
        }
    }
}
?>