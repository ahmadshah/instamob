<?php

namespace Instamob;

use \Exception;
use Instamob\Contracts\Service\UserInterface;

class Gateway
{
    /**
     * Instagram user endpoint
     *
     * @var \Instamob\Contracts\Service\UserInterface
     */
    protected $user;

    /**
     * Create a new Gateway instance
     *
     * @param \Instamob\Contracts\Service\UserInterface $user
     */
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * Call endpoint method
     *
     * @param  string $prop
     * @param  array $params
     *
     * @return array
     */
    public function __call($prop, $params)
    {
        if (! property_exists($this, $prop)) {
            throw new Exception(ucwords($prop).' endpoint is not yet supported');
        }

        return $this->{$prop};
    }
}
