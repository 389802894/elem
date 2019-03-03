<?php

namespace App\Http\Controllers\Api;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
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
use Validator;
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
            $menu_category['goods_list'] = Menu::select('id as goods_id', 'goods_name', 'rating', 'goods_price',
                'description', 'month_sales', 'rating_count', 'tips', 'satisfy_count', 'satisfy_rate',
                'goods_img')->where('category_id', '=', $menu_category->id)->get();
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
                'username.unique' => '用户名存在',
                'password.unique' => '手机号存在',
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

    //收货地址列表
    public function addressList()
    {
        $addresses = Address::select('id', 'user_id', 'province as provence', 'city', 'county as area',
            'tel', 'address as detail_address')->where('user_id', Auth::user()->id)->get();
        return $addresses;
    }

    //添加收货地址
    public function addAddress(Request $request)
    {
        $this->validate($request,
            ['name' => 'required',
                'tel' => 'required|numeric',
                'provence' => 'required',
                'city' => 'required',
                'area' => 'required',
                'detail_address' => 'required']);
        $address = new Address();
        $address->user_id = Auth::user()->id;
        $address->name = $request->name;
        $address->tel = $request->tel;
        $address->province = $request->provence;
        $address->city = $request->city;
        $address->county = $request->area;
        $address->address = $request->detail_address;
        $address->is_default = 0;
        $address->save();
        return json_encode(["status" => "true",
            "message" => "添加成功"]);
    }

    //修改地址回显
    public function address(Request $request)
    {
        $id = $request->id;
        $addresses = Address::select("id", "province as provence", "city", "county as area",
            "address as detail_address", "name", "tel")->where('id', '=', $id)->get();
        return $addresses[0];
    }

    //保存修改
    public function editAddress(Request $request)
    {
        $this->validate($request,
            ['name' => 'required',
                'tel' => 'required|numeric',
                'provence' => 'required',
                'city' => 'required',
                'area' => 'required',
                'detail_address' => 'required']);
        $address = Address::where('id', $request->id)->first();
        $address->name = $request->name;
        $address->tel = $request->tel;
        $address->province = $request->provence;
        $address->city = $request->city;
        $address->county = $request->area;
        $address->address = $request->detail_address;
        $address->save();

        return json_encode([
            "status" => "true",
            "message" => "修改成功"
        ]);
    }

    //保存购物车
    public function addCart(Request $request)
    {
        $goods_lists = $request->goodsList;
        $goods_counts = $request->goodsCount;
//        var_dump($goods_list,$goods_count);
        foreach ($goods_lists as $k => $goods_list) {
            $carts = new Cart();
            $carts->user_id = Auth::user()->id;
            $carts->goods_id = $goods_list;
            $carts->amount = $goods_counts[$k];
            $carts->save();
        }
        return json_encode([
            "status" => "true",
            "message" => "添加成功"
        ]);
    }


    //获取购物车
    public function cart()
    {
        //当前用户购物车所有商品
        $goods_list = Cart::where('user_id', Auth::user()->id)->get();
        $totalCost = 0;  //商品总价
        foreach ($goods_list as $cart) {
            $goods = Menu::where('id', $cart->goods_id)->first();
            $cart['goods_name'] = $goods->goods_name;
            $cart['goods_img'] = $goods->goods_img;
            $cart['goods_price'] = $goods->goods_price;
            $totalCost += $cart->amount * $goods->goods_price;
        }
        return ["goods_list" => $goods_list, "totalCost" => $totalCost];

    }

    //添加订单
    public function addOrder(Request $request)
    {

        DB::beginTransaction();
        try {
            $address_id = $request->address_id;

            //订单表orders
            $orders = new Order();
            $orders['user_id'] = Auth::user()->id; // 用户id
            //查询购物车表中的商品id,根据商品id查出商家id
            $goods_id = Cart::select('goods_id')->first();
            $shop_id = Menu::select('shop_id')->where('id', $goods_id->goods_id)->first();
            $orders['shop_id'] = $shop_id->shop_id; // 商家id
            $orders['sn'] = time(); // 订单编号
            //用户信息
            $address = Address::where('id', $address_id)->first();
            $orders['province'] = $address->province;
            $orders['city'] = $address->city;
            $orders['county'] = $address->county;
            $orders['address'] = $address->address;
            $orders['tel'] = $address->tel;
            $orders['name'] = Auth::user()->username;
            //总价
            $goods_list = Cart::where('user_id', Auth::user()->id)->get();
            $orders['total'] = 0;  //商品总价
            foreach ($goods_list as $cart) {
                $goods = Menu::where('id', $cart->goods_id)->first();
                $orders['total'] += $cart->amount * $goods->goods_price;
            }
            $orders['status'] = 1;  //状态(-1:已取消,0:待支付,1:待发货,2:待确认,3:完成)
            $orders['order_birth_time'] = date('Y-m-d H:i:s', time());
            //随机字符串
            $str = "QWERTYUIOPASDFGHJKLZXCVBNM1234567890";
            $a = substr(str_shuffle($str), mt_rand(0, strlen($str) - 11), 10);
            $orders['out_trade_no'] = $a;  //第三方交易号(微信支付需要)
            $orders->save();
            //订单商品表order_details
            $order_details = new OrderDetail();
            $carts = Cart::all();  //购物车总数据
            foreach ($carts as $cart) {
                $order_details['order_id'] = Order::select('id')->first()->id;  //订单id
                $order_details['goods_id'] = $cart->goods_id;  //商品id
                $order_details['amount'] = $cart->amount;  //商品数量
                $goods = Menu::where('id', $cart->goods_id)->first();
                $order_details['goods_name'] = $goods->goods_name;  //商品名称
                $order_details['goods_img'] = $goods->goods_img;  //商品图片
                $order_details['goods_price'] = $goods->goods_price; //商品价格
            }
            $order_details->save();
//            DB::table("carts")->delete();
            DB::commit();
            return [
                "status" => "true",
                "message" => "添加成功",
                "order_id" => Order::select('id')->first()->id
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                "status" => "false",
                "message" => "添加失败",
            ];
        }
    }

    //获得指定订单接口
    public function order(Request $request)
    {
        $id = $request->id;
        $order = Order::select('id', 'sn as order_code', 'order_birth_time', 'status', 'shop_id', 'address')
            ->where('id', $id)->first();
        if ($order->status == 1) {
            $status = "代付款";
        }
        $order['order_status'] = $status; //订单状态
        //查询商家数据
        $shop = Shop::where('id', $order->shop_id)->first();
        $order['shop_name'] = $shop->shop_name; //商铺名字
        $order['shop_img'] = $shop->shop_img; //商铺图片
        //查询订单商品表
        $order_detail = OrderDetail::where('order_id', $id)->first();
        $order['order_price'] = $order_detail->goods_price; //订单总价
        $order['order_address'] = $order->address; //订单收货地址
        //获取购物车所有数据
        $goods_list = Cart::where('user_id', Auth::user()->id)->get();
        foreach ($goods_list as $cart) {
            $goods = Menu::where('id', $cart->goods_id)->first();
            $cart['goods_name'] = $goods->goods_name;
            $cart['goods_img'] = $goods->goods_img;
            $cart['goods_price'] = $goods->goods_price;
        }
        $order['goods_list'] = $goods_list;
        return $order;
    }

    //修改密码
    public function changePassword(Request $request)
    {
        $this->validate($request,
            ['oldPassword' => 'required',
                'newPassword' => 'required',
            ]);
        $oldPassword = $request->oldPassword;
//        return auth()->user()->password;
        if (//判断原密码是否正确
        !Hash::check($oldPassword, auth()->user()->password)
        ) {
            return ["status" => "false",
                "message" => "原密码不正确"];
        } else {
            //修改密码,并注销用户
            DB::table('members')->where('id',Auth::user()->id)
                ->update(['password'=>Hash::make($request->newPassword)]);
//            Auth::logout();
            return ["status" => "true",
                "message" => "修改密码成功"];
        }

    }

    //重置密码
    public function forgetPassword(Request $request)
    {
        $tel = $request->tel;
        if ($request->sms != Redis::get($tel)) {
            return ["status" => "false", "message" => "验证码错误"];
        }
        Member::where('tel',$tel)->update(["password"=>Hash::make($request->password)]);
        return ["status" => "true", "message" => "重置密码成功"];
    }
}
