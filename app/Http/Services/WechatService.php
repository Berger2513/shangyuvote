<?php
namespace App\Http\Services;
use GuzzleHttp\Client;

class WechatService
{
    public $appId;
    public $secret;

    public function __construct()
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

    public function getWechatAuthUrl($state)
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

    private function getClient()
    {
        if (!$this->client) {
            $this->client = new Client();
        }

        return $this->client;
    }
}