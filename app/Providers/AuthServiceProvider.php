<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Policies\CarPolicy;
use App\Policies\CustomerPolicy;
use App\Policies\RentalOrderPolicy;
use App\Car;
use App\Customer;
use App\RentalOrder;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Car::class => CarPolicy::class,
        Customer::class => CustomerPolicy::class,
        RentalOrder::class => RentalOrderPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('book',function($user){
            if($user->roles == "customer"){
                return true;
            }
            return false;
        });

        //
    }
}
