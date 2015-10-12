<?php

namespace Instamob\Contracts\Service;

interface UserInterface
{
    /**
     * Get basic information about a user
     *
     * @param string $userId
     *
     * @return mixed
     */
    public function profile($userId = null);

    /**
     * Get the authenticated user's feed
     *
     * @return mixed
     */
    public function feed();

    /**
     * Get the most recent media published by a user
     *
     * @param string $userId
     *
     * @return mixed
     */
    public function recentMedia($userId = null);

    /**
     * See the list of media liked by the authenticated user
     *
     * @param string $userId
     *
     * @return mixed
     */
    public function likedMedia($userId = null);

    /**
     * Search for a user by name
     *
     * @param string $name
     *
     * @return mixed
     */
    public function search($name);
}
