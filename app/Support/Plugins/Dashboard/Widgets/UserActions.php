<?php

namespace Dsone\Support\Plugins\Dashboard\Widgets;

use Vanguard\Plugins\Widget;
use Dsone\User;

class UserActions extends Widget
{
    /**
     * UserActions constructor.
     */
    public function __construct()
    {
        $this->permissions(function (User $user) {
            return $user->hasRole('User');
        });
    }

    /**
     * {@inheritdoc}
     */
    public function render()
    {
        return view('plugins.dashboard.widgets.user-actions');
    }
}
