<?php

namespace Instamob;

use League\OAuth2\Client\Provider\Instagram as OAuthProvider;

class Auth implements Contracts\AuthInterface
{
    /**
     * Instagram OAuth2 Provider
     *
     * @var \League\OAuth2\Client\Provider\Instagram
     */
    protected $provider;

    /**
     * Session handler
     *
     * @var \Instamob\Contracts\SessionInterface
     */
    protected $session;

    /**
     * OAuth2 access token
     *
     * @var string
     */
    protected $accessToken;

    /**
     * Create a new Auth instance
     *
     * @param League\OAuth2\Client\Provider\Instagram $provider
     * @param \Instamob\Contracts\SessionInterface $session
     */
    public function __construct(OAuthProvider $provider, $session)
    {
        $this->provider = $provider;
        $this->session = $session;
    }

    /**
     * Redirect user to the OAuth authentication page
     *
     * @return void
     */
    public function redirect()
    {
        $authorizationUrl = $this->provider->getAuthorizationUrl();

        header('Location: '.$authorizationUrl);
    }

    /**
     * Retrieve OAuth2 access token for authenticated user
     *
     * @param  srting $authorizationCode
     *
     * @return \Instamob\Contracts\AuthInterface
     */
    public function authorize($authorizationCode)
    {
        $this->accessToken = $this->provider->getAccessToken('authorization_code', [
            'code' => $authorizationCode
        ]);

        $this->session->put('instamob.oauth_access_token', $this->accessToken->getToken());

        return $this;
    }

    /**
     * Get access token
     *
     * @return string
     */
    public function accessToken()
    {
        return $this->session->get('instamob.oauth_access_token');
    }
}
