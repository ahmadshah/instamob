<?php

namespace spec\Instamob\Services;

use Instamob\Auth;
use Prophecy\Argument;
use PhpSpec\ObjectBehavior;

class UserSpec extends ObjectBehavior
{
    function let(Auth $auth)
    {
        $this->beConstructedWith($auth);
    }
}
