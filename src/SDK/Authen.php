<?php

namespace xXutianyi\FeishuSDK\SDK;

use xXutianyi\FeishuSDK\SDK;

class Authen extends SDK
{
    const AUTHEN_BY_CODE = "/authen/v1/access_token";
    const REFRESH_ACCESS_TOKEN = "/authen/v1/refresh_access_token";
    const USER_INFO = "/authen/v1/user_info";

    public function AuthenByCode($code): array
    {
        $params = [
            'grant_type' => 'authorization_code',
            'code' => $code
        ];
        return $this->post(self::AUTHEN_BY_CODE, [], $params);
    }

    public function RefreshUserAccessToken($refreshToken): array
    {
        $params = [
            'grant_type' => 'refresh_token',
            'code' => $refreshToken
        ];
        return $this->post(self::REFRESH_ACCESS_TOKEN, [], $params);
    }

    public function GetUserInfo($accessToken): array
    {
        return $this->get(self::USER_INFO, [], $accessToken);
    }

}