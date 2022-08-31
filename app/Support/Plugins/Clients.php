<?php

namespace Dsone\Support\Plugins;

use Vanguard\Plugins\Plugin;
use Dsone\Support\Sidebar\Item;

class Clients extends Plugin
{
    public function sidebar()
    {

        return Item::create(__('Clients'))
            ->route('clients.index')
            ->icon('fas fa-users')
            ->active("clients*")
            ->permissions('users.manage');
    }
}
