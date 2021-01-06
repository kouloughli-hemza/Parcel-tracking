<?php

namespace Dsone\Providers;

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
            \Dsone\Support\Plugins\Dashboard\Dashboard::class,
            \Dsone\Support\Plugins\Users::class,
            UserActivity::class,
            \Dsone\Support\Plugins\RolesAndPermissions::class,
            \Dsone\Support\Plugins\Settings::class,
            \Vanguard\Announcements\Announcements::class,
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
