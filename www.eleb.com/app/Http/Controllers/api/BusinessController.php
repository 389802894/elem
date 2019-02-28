<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Qcloud\Sms\SmsSingleSender;
use App\Models\Member;
use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Shop;
use App\Models\ShopCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BusinessController extends Controller
{
    //商家列表
    public function businessList(Request $request)
    {
        $keyword = $request->keyword;
        if ($keyword) {
            $shops = Shop::where('status', 1)->where('shop_name', 'like', "%$keyword%")->get();
        } else {
            $shops = Shop::where('status', 1)->get();
        }
        return $shops;
    }

    //z指定商家
    public function business(Request $request)
    {
        $id = $request->id;
        $shop = Shop::find($id);
        $menu_categories = MenuCategory::where('shop_id', '=', $id)->get();
        foreach ($menu_categories as $menu_category) {
            $menu_category['goods_list'] = Menu::where('category_id', '=', $menu_category->id)->get();
        }
        $shop['commodity'] = $menu_categories;
        return $shop;
    }

    //短信验证
    public function sms(Request $request)
    {
        $tel = $request->tel;
        // 短信应用SDK AppID
        $appid = 1400189719; // 1400开头
        // 短信应用SDK AppKey
        $appkey = "7571e72a66c0d376d93346d2ce7fb416";
        // 需要发送短信的手机号码
        $phoneNumber = $tel;
        // 短信模板ID，需要在短信应用中申请
        $templateId = 285069;  // NOTE: 这里的模板ID`7839`只是一个示例，真实的模板ID需要在短信控制台中申请
        $smsSign = "陈贸生活记录"; // NOTE: 这里的签名只是示例，请使用真实的已申请的签名，签名参数使用的是`签名内容`，而不是`签名ID`
        try {
            $ssender = new SmsSingleSender($appid, $appkey);
            $code = mt_rand(1000, 9999);
            $params = [$code, 5];
            $result = $ssender->sendWithParam("86", $phoneNumber, $templateId,
                $params, $smsSign, "", "");  // 签名参数未提供或者为空时，会使用默认签名发送短信
            var_dump($result);
            //把验证存入Redis
            Redis::setex($tel, 300, $code);
        } catch (\Exception $e) {
            var_dump($e);
        }
    }

    //用户注册
    public function regist(Request $request)
    {
        $this->validate($request,
            ['username' => 'required|unique:members',
                'password' => 'required|min:4',
                'tel' => 'required|min:11|max:11|unique:members'],
            ['username.required' => '用户名不能为空',
                'password,required' => '密码不能为空',
                'password.min' => '密码不小于4个字符',
                'tel,min' => '手机号位数错误',
                'tel,max' => '手机号位数错误']);
        $code = Redis::get($request->tel);
        if ($code != $request->sms) {
            return json_encode(["status" => "false", "message" => "验证码输入错误"]);
        }
        $members = new Member();
        $members->username = $request->username;
        $members->password = Hash::make($request->password);
        $members->tel = $request->tel;
        $members->save();
        return json_encode(["status" => "true", "message" => "注册成功"]);

    }

    //用户登录
    public function loginCheck(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required'],
            ['name.required' => '用户名不能为空',
                'password.required' => '密码不能为空']);
        if (Auth::attempt(
            ['username' => $request->name,
                'password' => $request->password],
            $request->has('rememberMe')
        )
        ) {
            return json_encode(["status" => "true",
                "message" => "登录成功",
                "user_id" => auth()->user()->id,
                "username" => auth()->user()->username]);
        }
        return json_encode(["status" => "false", "message" => "账号或密码错误"]);
    }


}
