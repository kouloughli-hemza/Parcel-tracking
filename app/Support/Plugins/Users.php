<?php

namespace Dsone\Support\Plugins;

use Vanguard\Plugins\Plugin;
use Dsone\Support\Sidebar\Item;

class Users extends Plugin
{
    public function sidebar()
    {
        return Item::create(__('Users'))
            ->route('users.index')
            ->icon('fas fa-users')
            ->active("users*")
            ->permissions('users.manage');
    }
}
