<?php

namespace Instamob\Services;

use Instamob\Contracts\Service\UserInterface;

class User extends AbstractableService implements UserInterface
{
    protected $endpoint = 'users';

    public function profile($userId = null)
    {
        if (is_null($userId)) {
            $userId = 'self';
        }

        $response = $this->get($userId);

        return $response;
    }

    public function feed()
    {
        $response = $this->get('self/feed');

        return $response;
    }

    public function recentMedia($userId = null)
    {
        if (is_null($userId)) {
            $userId = 'self';
        }

        $response = $this->get($userId.'/media/recent');

        return $response;
    }

    public function likedMedia($userId = null)
    {
        if (is_null($userId)) {
            $userId = 'self';
        }

        $response = $this->get($userId.'/media/liked');

        return $response;
    }

    public function search($name)
    {
        $request = self::BASEURI.$this->endpoint.'/search?q='.$name.'&access_token='.app('instamob.auth')->accessToken();

        $response = $this->call('get', $request);

        return $response;
    }
}
