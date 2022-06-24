<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    private $s=['Responsable','Admin'];
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /* define a admin user role */

        Gate::define('isAdmin', function($user) {

            return $user->perfil == 'Administrador';

        });

        /* define a manager user role */

        Gate::define('isResponsable', function($user) {

            return $user->perfil == 'Responsable_de_Formacion';

        });

        /* define a user role */

        Gate::define('isFormador', function($user) {

            return $user->perfil == 'Formador';

        });
        Gate::define('isAdminOrResponsable', function($user) {

            return $user->perfil ==   'Administrador' ||$user->perfil ==   'Responsable_de_Formacion' ;

        });
        Gate::define('isResponsableOrFormador', function($user) {

            return $user->perfil ==   'Formador' ||$user->perfil ==   'Responsable_de_Formacion' ;

        });

        Gate::define('isHaveEntitade', function($user) {


            return $user->perfil ==   ('Responsable_de_Formacion' && !isset($user->entidad)) || $user->perfil == 'Administrador' ;

        });
        //
    }
}
