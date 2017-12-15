<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Services\WechatService;

class WeChatController extends Controller
{
    public $wechatService;

    public function __construct(WechatService $wechatService)
    {
        $this->wechatService = $wechatService;
    }

    public function index(Request $request)
    {
        $url = $this->wechatService->getWechatAuthUrl($request->state ?: 'index');
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


}
