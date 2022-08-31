<?php

namespace Dsone\Support\Plugins;

use Vanguard\Plugins\Plugin;
use Dsone\Support\Sidebar\Item;

class Colis extends Plugin
{
    public function sidebar()
    {

        return Item::create(__('Colis'))
            ->route('parcels.index')
            ->icon('fas fa-box')
            ->active("parcels*")
            ->permissions('users.manage');
    }
}
