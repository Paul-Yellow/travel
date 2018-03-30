<?php
namespace App\Services;
class Jwt
{
    private $token;
    public function __construct($token)
    {
        $this->token = $token;
    }
    /*返回jwt 过期时间*/
    public function getTokenTTL()
    {
        $payload = $this->decodeToken();
        return isset($payload['exp'])?$payload['exp']:0;
    } 
    // 解码token
    private function decodeToken()
    {
        $payloadArray = [];
        $parts = $this->sliceToken();

        if (isset($parts[1])) {
            $json = base64_decode($parts[1]);
            $payloadArray = json_decode($json, true);
        }

        return $payloadArray;
    }
    // 分割token
    private function sliceToken()
    {
        $parts = explode('.', $this->token);

        return count($parts) ? $parts : [];
    }
}