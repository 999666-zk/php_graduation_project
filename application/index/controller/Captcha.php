<?php
namespace app\index\controller;
use think\Controller;
use Qcloud\Sms\SmsSingleSender;


class Captcha extends Controller
{
    /*public function index()
    {
    //$params = $this->request->param();
    //        $phone = $params['phone'];
    //$phone = 15539234100;
    $code = mt_rand(100000,999999);   //生产随机6位验证码
    return Sms::SendSmsCode(15539234100,$code);
    }*/

    public function index(){
/*        // 短信应用 SDK AppID
        $appid = 1400534045; // SDK AppID 以1400开头
        // 短信应用 SDK AppKey
        $appkey = "38756a9cf7010ba6dd23008e28625812";
        // 需要发送短信的手机号码
//        $phoneNumbers = input("phone");
        $phoneNumbers = input("post.str");
        // 短信模板 ID，需要在短信控制台中申请
        $templateId = 994181;  // NOTE: 这里的模板 ID`7839`只是示例，真实的模板 ID 需要在短信控制台中申请
        $smsSign = "赵凯技术学心得"; // NOTE: 签名参数使用的是`签名内容`，而不是`签名ID`。这里的签名"腾讯云"只是示例，真实的签名需要在短信控制台申请

        try {
            $ssender = new SmsSingleSender($appid, $appkey);
            $params = [rand(1000, 9999)];//生成随机数
            $result = $ssender->sendWithParam("86", $phoneNumbers, $templateId, $params, $smsSign, "", "");
            $rsp = json_decode($result);
            return json(["result"=>$rsp->result,"code"=>$params]);
        } catch(\Exception $e) {
            echo var_dump($e);
        }*/
        return view();
    }

}

