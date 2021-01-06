<?php

namespace Dsone\Support\Plugins\Dashboard\Widgets;

use Vanguard\Plugins\Widget;
use Dsone\Repositories\User\UserRepository;
use Dsone\Support\Enum\UserStatus;

class UnconfirmedUsers extends Widget
{
    /**
     * {@inheritdoc}
     */
    public $width = '3';

    /**
     * {@inheritdoc}
     */
    protected $permissions = 'users.manage';

    /**
     * @var UserRepository
     */
    private $users;

    /**
     * UnconfirmedUsers constructor.
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * {@inheritdoc}
     */
    public function render()
    {
        return view('plugins.dashboard.widgets.unconfirmed-users', [
            'count' => $this->users->countByStatus(UserStatus::UNCONFIRMED)
        ]);
    }
}
