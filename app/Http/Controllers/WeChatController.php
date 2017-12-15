<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use EasyWeChat\Foundation\Application;
use App\Http\Services\WechatService;

class WeChatController extends Controller
{
    public function __construct(WechatService $wechatService)
    {
        $this->wechatService = $wechatService;
    }

    public function serve()
    {
        $options = [
            'debug'  => true,
            'app_id' => 'wxfbd2619af5964cf2',
            'secret' => 'aa4c42d452bec3d8cd1fb87c66057f3f',
            'token'  => 'easywechat',
            // 'aes_key' => null, // 可选
        ];

        $app = new Application($options);
        $response = $app->server->serve();
        // // 将响应输出
        return $response; // Laravel 里请使用：return $response;
    }

    public function index(Request $request)
    {
        $url = $this->getWechatAuthUrl($request->state ?: 'index');
        return redirect($url);
    }

    public function solve(Request $request)
    {
        $parameters = $request->all();
        if (isset($parameters['code'])) {
            $user = $this->wechatService->getWechatUser($parameters['code']);

            if (isset($user->openid)) {
                return redirect(url('/vote'));
            } else {
                return 'test';
            }
        }
        return redirect(route('wechat'));
    }

    private function getWechatAuthUrl($state)
    {
        $redirectUrl = url('/wechat/solve');
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize'
            . '?appid=' . $this->appId
            . '&redirect_uri=' . urlencode($redirectUrl)
            . '&response_type=code'
            . '&scope=snsapi_base'
            . '&state=' . $state
            . '#wechat_redirect';

        return $url;
    }
}
