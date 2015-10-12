<?php

namespace Instamob\Contracts;

interface AuthInterface
{
    public function redirect();

    public function authorize($authorizationCode);

    public function accessToken();
}
