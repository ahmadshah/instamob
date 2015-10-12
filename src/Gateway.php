<?php

namespace Instamob;

use \Exception;
use Instamob\Contracts\GatewayInterface;
use Instamob\Contracts\Service\UserInterface;

class Gateway implements GatewayInterface
{
    protected $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    public function __call($prop, $params)
    {
        if (! property_exists($this, $prop)) {
            throw new Exception(ucwords($prop).' endpoint is not yet supported');
        }

        return $this->{$prop};
    }
}
