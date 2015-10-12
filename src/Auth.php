<?php

namespace Instamob;

use League\OAuth2\Client\Provider\Instagram as OAuthProvider;

class Auth implements Contracts\AuthInterface
{
    protected $provider;

    protected $session;

    protected $accessToken;

    public function __construct(OAuthProvider $provider, $session)
    {
        $this->provider = $provider;
        $this->session = $session;
    }

    public function redirect()
    {
        $authorizationUrl = $this->provider->getAuthorizationUrl();

        header('Location: '.$authorizationUrl);
    }

    public function authorize($authorizationCode)
    {
        $this->accessToken = $this->provider->getAccessToken('authorization_code', [
            'code' => $authorizationCode
        ]);

        $this->session->put('instamob.oauth_access_token', $this->accessToken->getToken());

        return $this;
    }

    public function accessToken()
    {
        return $this->session->get('instamob.oauth_access_token');
    }
}
