<?php

session_start();

require __DIR__.'/../vendor/autoload.php';


use Instamob\Auth;
use Instamob\Gateway;
use Instamob\Services\User;
use Instamob\Contracts\SessionInterface;
use League\OAuth2\Client\Provider\Instagram as OAuthProvider;

class Session implements SessionInterface
{
    public function put($key, $value)
    {
        $_SESSION[$key]  = $value;
    }

    public function get($key)
    {
        return $_SESSION[$key];
    }
}

$credentials = [
    'clientId' => '12188ab52775409198d0f7bd81b34636',
    'clientSecret' => '19f7d1c930274af1906f962cf1eeb448',
    'redirectUri' => 'http://orchestra.app/instamob'
];
$oauth = new OAuthProvider($credentials);
$auth = new Auth($oauth, new Session);
$user = new User($auth);
$gateway = new Gateway($user);

$response = $gateway->user()->profile();

var_dump($response);
