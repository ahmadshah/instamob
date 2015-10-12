<?php

namespace Instamob\Contracts;

interface AuthInterface
{
    /**
     * Redirect user to the OAuth authentication page
     *
     * @return void
     */
    public function redirect();

    /**
     * Retrieve OAuth2 access token for authenticated user
     *
     * @param  srting $authorizationCode
     * @return \Instamob\Contracts\AuthInterface
     */
    public function authorize($authorizationCode);

    /**
     * Get access token
     *
     * @return string
     */
    public function accessToken();
}
