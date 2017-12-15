<?php

namespace App\Http\Service;

class WechatService
{
    public __constuct()
    {
        $this->appId = 'wxfbd2619af5964cf2';
        $this->secret = 'aa4c42d452bec3d8cd1fb87c66057f3f';
    }

    public function getWechatUser($code)
    {
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token'
            . '?appid=' . $this->appId
            . '&secret=' . $this->secret
            . '&code=' . $code
            . '&grant_type=authorization_code';

        $result = $this->getClient()
            ->request('GET', $url)
            ->getBody()
            ->getContents();

        return json_decode($result);
    }
}