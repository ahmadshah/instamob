<?php

namespace Instamob\Services;

use Instamob\Contracts\Service\UserInterface;

class User extends AbstractableService implements UserInterface
{
    /**
     * API endpoint
     *
     * @var string
     */
    protected $endpoint = 'users';

    /**
     * Get basic information about a user
     *
     * @param string $userId
     *
     * @return mixed
     */
    public function profile($userId = null)
    {
        if (is_null($userId)) {
            $userId = 'self';
        }

        $response = $this->get($userId);

        return $response;
    }

    /**
     * Get the authenticated user's feed
     *
     * @return mixed
     */
    public function feed()
    {
        $response = $this->get('self/feed');

        return $response;
    }

    /**
     * Get the most recent media published by a user
     *
     * @param string $userId
     *
     * @return mixed
     */
    public function recentMedia($userId = null)
    {
        if (is_null($userId)) {
            $userId = 'self';
        }

        $response = $this->get($userId.'/media/recent');

        return $response;
    }

    /**
     * See the list of media liked by the authenticated user
     *
     * @param string $userId
     *
     * @return mixed
     */
    public function likedMedia($userId = null)
    {
        if (is_null($userId)) {
            $userId = 'self';
        }

        $response = $this->get($userId.'/media/liked');

        return $response;
    }

    /**
     * Search for a user by name
     *
     * @param string $name
     *
     * @return mixed
     */
    public function search($name)
    {
        $request = self::BASEURI.$this->endpoint.'/search?q='.$name.'&access_token='.$this->getAuth()->accessToken();

        $response = $this->call('get', $request);

        return $response;
    }
}
