<?php

namespace Dsone\Support\Plugins\Dashboard;

use Vanguard\Plugins\Plugin;
use Dsone\Support\Sidebar\Item;

class Dashboard extends Plugin
{
    public function sidebar()
    {
        return Item::create(__('Dashboard'))
            ->route('dashboard')
            ->icon('fas fa-home')
            ->active("/");
    }
}
