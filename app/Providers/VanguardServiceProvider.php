<?php

namespace Dsone\Providers;

use Dsone\Support\Plugins\Clients;
use Dsone\Support\Plugins\Colis;
use Dsone\Support\Plugins\Dashboard\Dashboard;
use Dsone\Support\Plugins\Factures;
use Dsone\Support\Plugins\RolesAndPermissions;
use Dsone\Support\Plugins\Settings;
use Dsone\Support\Plugins\Users;
use Vanguard\Announcements\Announcements;
use Vanguard\Plugins\VanguardServiceProvider as BaseVanguardServiceProvider;
use Dsone\Support\Plugins\Dashboard\Widgets\BannedUsers;
use Dsone\Support\Plugins\Dashboard\Widgets\LatestRegistrations;
use Dsone\Support\Plugins\Dashboard\Widgets\NewUsers;
use Dsone\Support\Plugins\Dashboard\Widgets\RegistrationHistory;
use Dsone\Support\Plugins\Dashboard\Widgets\TotalUsers;
use Dsone\Support\Plugins\Dashboard\Widgets\UnconfirmedUsers;
use Dsone\Support\Plugins\Dashboard\Widgets\UserActions;
use Vanguard\UserActivity\UserActivity;
use Vanguard\UserActivity\Widgets\ActivityWidget;

class VanguardServiceProvider extends BaseVanguardServiceProvider
{
    /**
     * List of registered plugins.
     *
     * @return array
     */
    protected function plugins()
    {
        return [
            Dashboard::class,
            Users::class,
            Clients::class,
            Colis::class,
            Factures::class,
            UserActivity::class,
            //RolesAndPermissions::class,
            Settings::class,
            //Announcements::class,
        ];
    }

    /**
     * Dashboard widgets.
     *
     * @return array
     */
    protected function widgets()
    {
        return [
            UserActions::class,
            TotalUsers::class,
            NewUsers::class,
            BannedUsers::class,
            UnconfirmedUsers::class,
            RegistrationHistory::class,
            LatestRegistrations::class,
            ActivityWidget::class
        ];
    }
}
