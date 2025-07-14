<?php
namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */

    public function boot(): void
    {
        $this->registerPolicies();
        auth()->shouldUse('admin');

        foreach (config('permissions', []) as $code => $label) {
            Gate::define($code, function ($admin) use ($code) {
                return $admin->role && $admin->role->permissions->pluck('permission')->contains($code);
            });
        }
    }
}
