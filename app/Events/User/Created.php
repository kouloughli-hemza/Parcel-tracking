<?php

namespace Dsone\Events\User;

use Dsone\User;

class Created
{
    /**
     * @var User
     */
    protected $createdUser;

    public function __construct(User $createdUser)
    {
        $this->createdUser = $createdUser;
    }

    /**
     * @return User
     */
    public function getCreatedUser()
    {
        return $this->createdUser;
    }
}
