<?php
//防止XSS攻击方法
function fangXSS($string){
    require_once './Application/Common/Plugin/htmlpurifire/HTMLPurifier.auto.php';
    $cfg=HTMLPurifier_Config::createDefault();
    $cfg->set('Core.Encoding','UTF-8');
    $cfg->set('HTML.Allowed','div,bstrong,i,em,a[href|title],ul,ol,li,br,span[style],img[width|height|alt|src]');
    $cfg->set('CSS.AllowedProperties','font,font-size,font-weight,font-style,font-family,text-decorarion,padding-left,color,background-color,text-align');
    $cfg->set('HTML.TagetBlank',true);
    $obj=new HTMLPurifier($cfg);
    return $obj->purify($string);

}
//遍历无限极分类
function generateTree($info,$parent_id=0,$level=0){
    static $list=array();
    foreach ($info as $v){
        if($v['auth_pid']==$parent_id){
            $v['level']=$level;
            $list[]=$v;
            generateTree($info,$v['auth_id'],$level+1);
        }
    }
    return $list;
}
//短信验证码
function sendMsg($to,$datas,$tempId='1'){
    // 初始化REST SDK
    global $accountSid,$accountToken,$appId,$serverIP,$serverPort,$softVersion;
    //主帐号,对应开官网发者主账号下的 ACCOUNT SID
    $accountSid= '8a216da85d158d1b015d3b1fd4c51080';

//主帐号令牌,对应官网开发者主账号下的 AUTH TOKEN
    $accountToken= 'c120d2de733740c6ae47cec72c63d594';

//应用Id，在官网应用列表中点击应用，对应应用详情中的APP ID
//在开发调试的时候，可以使用官网自动为您分配的测试Demo的APP ID
    $appId='8a216da85d158d1b015d3b1fd6331087';

//请求地址
//沙盒环境（用于应用开发调试）：sandboxapp.cloopen.com
//生产环境（用户应用上线使用）：app.cloopen.com
    $serverIP='app.cloopen.com';


//请求端口，生产环境和沙盒环境一致
    $serverPort='8883';

//REST版本号，在官网文档REST介绍中获得。
    $softVersion='2013-12-26';
    vendor('ShortMessage.CCPRestSmsSDK');
    $rest = new REST($serverIP,$serverPort,$softVersion);
    $rest->setAccount($accountSid,$accountToken);
    $rest->setAppId($appId);

    // 发送模板短信
    //echo "Sending TemplateSMS to $to <br/>";
    $result = $rest->sendTemplateSMS($to,$datas,$tempId);
    if($result == NULL ) {
        //echo "result error!";
        //break;
        return false;
    }
    if($result->statusCode!=0) {
        //echo "error code :" . $result->statusCode . "<br>";
        //echo "error msg :" . $result->statusMsg . "<br>";

        return false;
    }else{
        //echo "Sendind TemplateSMS success!<br/>";
        // 获取返回信息
       // $smsmessage = $result->TemplateSMS;
       // echo "dateCreated:".$smsmessage->dateCreated."<br/>";
        //echo "smsMessageSid:".$smsmessage->smsMessageSid."<br/>";
        return true;
    }
}
//邮件发送
function sendMail($title, $msghtml, $sendAddress) {
    //引入发送类phpmailer.php
    vendor('Mail.phpmailer');
    //实列化对象
    $mail = new PHPMailer();
    /*服务器相关信息*/
    $mail->IsSMTP(); //设置使用SMTP服务器发送
    $mail->SMTPAuth = true; //开启SMTP认证
    $mail->Host = 'smtp.163.com'; //设置 SMTP 服务器,自己注册邮箱服务器地址
    $mail->Username = 'phpztrtest'; //发信人的邮箱用户名
    $mail->Password = 'ztr2012dl'; //发信人的邮箱密码
    /*内容信息*/
    $mail->IsHTML(true); //指定邮件内容格式为：html
    $mail->CharSet = "UTF-8"; //编码
    $mail->From = 'phpztrtest@163.com'; //发件人完整的邮箱名称
    $mail->FromName = "php_ztr"; //发信人署名
    $mail->Subject = $title; //信的标题
    $mail->MsgHTML($msghtml); //发信主体内容
    // $mail->AddAttachment("fish.jpg");      //附件
    /*发送邮件*/
    $mail->AddAddress($sendAddress); //收件人地址
    //使用send函数进行发送
    if ($mail->Send()) {
        //发送成功返回真
        return true;
        // echo '您的邮件已经发送成功！！！';
    } else {
        return $mail->ErrorInfo; //如果发送失败，则返回错误提示
    }


}