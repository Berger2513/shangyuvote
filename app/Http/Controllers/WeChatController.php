<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use EasyWeChat\Foundation\Application;

class WeChatController extends Controller
{
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
}
