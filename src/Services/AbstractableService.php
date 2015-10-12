<?php

namespace Instamob\Services;

use GuzzleHttp\Client;
use Instamob\Contracts\AuthInterface;

abstract class AbstractableService
{
    /**
     * Instagram Base URL
     */
    const BASEURI = 'https://api.instagram.com/v1/';

    /**
     * API endpoint
     *
     * @var string
     */
    protected $endpoint;

    /**
     * API client
     *
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * Instamob OAuth authenticator
     *
     * @var \Instamob\Contracts\AuthInterface
     */
    protected $auth;

    /**
     * Create a new Service instacne
     *
     * @param \Instamob\Contracts\AuthInterface $auth
     */
    public function __construct(AuthInterface $auth)
    {
        $this->client = new Client;
        $this->auth = $auth;
    }

    /**
     * Return auth instance
     *
     * @return \Instamob\Contracts\AuthInterface
     */
    public function getAuth()
    {
        return $this->auth;
    }

    /**
     * Return API client instance
     *
     * @return \GuzzleHttp\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Make a call to the API
     *
     * @param  string $method
     * @param  string $request
     *
     * @return array
     */
    public function call($method, $request)
    {
        $response = call_user_func_array([$this->getClient(), $method], [$request]);

        return $this->extractResponse($response->getBody());
    }

    /**
     * Make a get request to the API
     *
     * @param  string $method
     *
     * @return array
     */
    public function get($method)
    {
        $request = $this->createRequest($method);

        $response = call_user_func_array([$this->getClient(), 'get'], [$request]);

        return $this->extractResponse($response->getBody());
    }

    /**
     * Generate API request url
     *
     * @param  string $method
     *
     * @return string
     */
    protected function createRequest($method)
    {
        $url  = self::BASEURI.$this->endpoint.'/'.$method.'?access_token='.$this->auth->accessToken();

        return $url;
    }

    /**
     * Generate API response
     *
     * @param  mixed $stream
     *
     * @return array
     */
    protected function extractResponse($stream)
    {
        $response = json_decode($stream, true);

        return [
            'data' => $response['data']
        ];
    }
}
