<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MailController extends Controller
{
    //审核通过发送邮箱
    public function destroy(Shop $shop)
    {
//        return 1;
        return $shop;
        $shop['status'] = 1;
        $shop->save();
        $title = '商家审核';
        $content = '<p>	恭喜您,审核通过!</p>';
        try {
            \Illuminate\Support\Facades\Mail::send('email.index', compact('title', 'content'),
                function ($message) {
                    $to = 'Cmelo16@163.com';
                    $message->from(env('MAIL_USERNAME'))->to($to)->subject('审核提醒');
                });
        } catch (\Exception $ze) {
            return '邮件发送失败';
        }
        return redirect()->route('shops.index')->with('success', '审核通过');
    }
}
