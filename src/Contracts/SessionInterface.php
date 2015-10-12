<?php

namespace Instamob\Contracts;

interface SessionInterface
{
    public function put($key, $value);

    public function get($key);
}
