<?php

namespace spec\Instamob;

use Prophecy\Argument;
use PhpSpec\ObjectBehavior;
use Instamob\Services\User;

class GatewaySpec extends ObjectBehavior
{
    function let(User $user)
    {
        $this->beConstructedWith($user);
    }

    function it_return_user_endpoint(User $user)
    {
        $this->user()->shouldBeAnInstanceOf($user);
    }
}
