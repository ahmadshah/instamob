<?php

namespace Instamob\Services;

use GuzzleHttp\Client;

abstract class AbstractableService
{
    const BASEURI = 'https://api.instagram.com/v1/';

    protected $endpoint;

    protected $client;

    public function __construct()
    {
        $this->client = new Client;
    }

    public function getClient()
    {
        return $this->client;
    }

    public function call($method, $request)
    {
        $response = call_user_func_array([$this->getClient(), $method], [$request]);

        return $this->extractResponse($response->getBody());
    }

    public function get($method)
    {
        $request = $this->createRequest($method);

        $response = call_user_func_array([$this->getClient(), 'get'], [$request]);

        return $this->extractResponse($response->getBody());
    }

    protected function createRequest($method)
    {
        $url  = self::BASEURI.$this->endpoint.'/'.$method.'?access_token='.app('instamob.auth')->accessToken();

        return $url;
    }

    protected function extractResponse($stream)
    {
        $response = json_decode($stream, true);

        return [
            'data' => $response['data']
        ];
    }
}
