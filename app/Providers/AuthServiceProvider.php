<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Employee;
use App\Models\Manager;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
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
        Gate::define('view-topic', function(Employee $employee) {
             $managers = Manager::where('employee_id', $employee->employee_id)->pluck('employee_id')->to_array();
             dd($managers);
        });

    }
}
