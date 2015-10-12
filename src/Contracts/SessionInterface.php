<?php

namespace Instamob\Contracts;

interface SessionInterface
{
    /**
     * Store value into session
     *
     * @param  string $key   [description]
     * @param  string $value [description]
     *
     * @return void
     */
    public function put($key, $value);

    /**
     * Retrieve value from session
     *
     * @param  string $key
     *
     * @return mixed
     */
    public function get($key);
}
