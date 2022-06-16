<?php

namespace xXutianyi\FeishuSDK;

use Exception;
use JetBrains\PhpStorm\ArrayShape;
use xXutianyi\FeishuSDK\SDK\TenantAccessToken;
use xXutianyi\FeishuSDK\utils\HttpCall;

abstract class SDK
{

    const BASE_URL = "https://open.feishu.cn/open-apis";

    const HEADERS = [
        'Authorization' => "string",
        'Content-Type' => "string"
    ];

    private string $TenantAccessToken;

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function __construct(Config $config)
    {
        $TenantAccessTokenInstance = new TenantAccessToken($config);
        $this->TenantAccessToken = $TenantAccessTokenInstance->GetTenantAccessToken();
    }

    /**
     * @throws Exception
     */
    public function unpackResponse($raw): array
    {
        $raw = json_decode($raw, true);
        $this->checkError($raw);
        return $raw;
    }

    /**
     * @throws Exception
     */
    private function checkError($response)
    {
        $code = $response['code'];
        $msg = $response['msg'];
        if ($code) {
            $errorMsg = "Feishu Api Call Error: $msg($code)";
            throw new Exception($errorMsg, $code);
        }
    }

    /**
     * @param string $url
     * @return string
     */
    private function makeUrl(string $url): string
    {
        return self::BASE_URL . $url;
    }

    /**
     * @return array
     */
    #[ArrayShape(self::HEADERS)]
    private function makeHeader(string $UserAccessToken = ""): array
    {
        return [
            'Authorization' => 'Bearer ' . $UserAccessToken ?: $this->TenantAccessToken,
            'Content-Type' => 'application/json; charset=utf-8',
        ];
    }

    /**
     * @param string $url
     * @param array $query
     * @param string $UserAccessToken
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws Exception
     */
    public function get(string $url, array $query = [], string $UserAccessToken = ""): array
    {
        $res = HttpCall::get(
            $this->makeUrl($url),
            $query,
            $this->makeHeader($UserAccessToken)
        );
        return $this->unpackResponse($res);
    }

    /**
     * @param string $url
     * @param array $query
     * @param array $params
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws Exception
     */
    public function post(string $url, array $query = [], array $params = [], string $UserAccessToken = ""): array
    {
        $res = HttpCall::post(
            $this->makeUrl($url),
            $query,
            $params,
            $this->makeHeader($UserAccessToken)
        );
        return $this->unpackResponse($res);
    }

    /**
     * @param string $url
     * @param array $query
     * @param array $params
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws Exception
     */
    public function put(string $url, array $query = [], array $params = [], string $UserAccessToken = ""): array
    {
        $res = HttpCall::put(
            $this->makeUrl($url),
            $query,
            $params,
            $this->makeHeader($UserAccessToken)
        );
        return $this->unpackResponse($res);
    }

    /**
     * @param string $url
     * @param array $query
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws Exception
     */
    public function delete(string $url, array $query = [], string $UserAccessToken = ""): array
    {
        $res = HttpCall::delete(
            $this->makeUrl($url),
            $query,
            $this->makeHeader($UserAccessToken)
        );
        return $this->unpackResponse($res);
    }
}