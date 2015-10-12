<?php

namespace Instamob\Contracts\Service;

interface UserInterface
{
    public function profile($userId = null);

    public function feed();

    public function recentMedia($userId = null);

    public function likedMedia($userId = null);

    public function search($name);
}
