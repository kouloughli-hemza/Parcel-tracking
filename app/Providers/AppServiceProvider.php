<?php

namespace Dsone\Providers;

use Carbon\Carbon;
use Dsone\Repositories\Client\ClientRepository;
use Dsone\Repositories\Client\EloquentClient;
use Dsone\Repositories\Coli\ColiRepository;
use Dsone\Repositories\Coli\EloquentColi;
use Dsone\Repositories\Expediteur\EloquentExpediteur;
use Dsone\Repositories\Expediteur\ExpediteurRepository;
use Dsone\Repositories\Facture\EloquentFacture;
use Dsone\Repositories\Facture\FactureRepository;
use Illuminate\Database\Eloquent\Factories\Factory;
use Dsone\Repositories\Country\CountryRepository;
use Dsone\Repositories\Country\EloquentCountry;
use Dsone\Repositories\Permission\EloquentPermission;
use Dsone\Repositories\Permission\PermissionRepository;
use Dsone\Repositories\Role\EloquentRole;
use Dsone\Repositories\Role\RoleRepository;
use Dsone\Repositories\Session\DbSession;
use Dsone\Repositories\Session\SessionRepository;
use Dsone\Repositories\User\EloquentUser;
use Dsone\Repositories\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale(config('app.locale'));
        config(['app.name' => setting('app_name')]);
        \Illuminate\Database\Schema\Builder::defaultStringLength(191);

        Factory::guessFactoryNamesUsing(function (string $modelName) {
            return 'Database\Factories\\'.class_basename($modelName).'Factory';
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UserRepository::class, EloquentUser::class);
        $this->app->singleton(RoleRepository::class, EloquentRole::class);
        $this->app->singleton(PermissionRepository::class, EloquentPermission::class);
        $this->app->singleton(SessionRepository::class, DbSession::class);
        $this->app->singleton(CountryRepository::class, EloquentCountry::class);
        $this->app->singleton(ClientRepository::class, EloquentClient::class);
        $this->app->singleton(ColiRepository::class, EloquentColi::class);
        $this->app->singleton(ExpediteurRepository::class, EloquentExpediteur::class);
        $this->app->singleton(FactureRepository::class, EloquentFacture::class);

        if ($this->app->environment('local')) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
    }
}
