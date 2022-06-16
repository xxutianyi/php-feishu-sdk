<?php

namespace xXutianyi\FeishuSDK\utils;

use GuzzleHttp\Client;

class HttpCall
{

    /**
     * @param string $url
     * @param array $query
     * @param array $headers
     * @return \Psr\Http\Message\StreamInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function get(string $url,  array $query = [], array $headers = [])
    {
        $client = new Client();
        return $client->get(
            $url,
            [
                'headers' => $headers,
                'query' => $query,
            ]
        )->getBody();
    }

    /**
     * @param string $url
     * @param array $query
     * @param array $params
     * @param array $headers
     * @return \Psr\Http\Message\StreamInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function post(string $url,  array $query = [], array $params = [], array $headers = [])
    {
        $client = new Client();
        return $client->post(
            $url,
            [
                'headers' =>  $headers,
                'query' => $query,
                'json' => $params,
            ]
        )->getBody();
    }

    /**
     * @param string $url
     * @param array $query
     * @param array $params
     * @param array $headers
     * @return \Psr\Http\Message\StreamInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function put(string $url,  array $query = [], array $params = [], array $headers = [])
    {
        $client = new Client();
        return $client->put(
            $url,
            [
                'headers' =>  $headers,
                'query' => $query,
                'json' => $params,
            ]
        )->getBody();
    }

    /**
     * @param string $url
     * @param array $query
     * @param array $headers
     * @return \Psr\Http\Message\StreamInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function delete(string $url, array $query = [], array $headers = [])
    {
        $client = new Client();
        return $client->delete(
            $url,
            [
                'headers' => $headers,
                'query' => $query,
            ]
        )->getBody();
    }
}