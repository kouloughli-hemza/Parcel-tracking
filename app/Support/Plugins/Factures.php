<?php

namespace Dsone\Support\Plugins;

use Vanguard\Plugins\Plugin;
use Dsone\Support\Sidebar\Item;

class Factures extends Plugin
{
    public function sidebar()
    {

        return Item::create(__('Factures'))
            ->route('factures.index')
            ->icon('fas fa-file')
            ->active("factures*")
            ->permissions('users.manage');
    }
}
