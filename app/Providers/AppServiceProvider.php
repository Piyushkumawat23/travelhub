<?php

namespace App\Providers;

use App\Models\Role;
use App\Models\Permission; // ✅ Add this import for the Permission model
use Illuminate\Support\Facades\Gate; // ✅ Add this import for Gates
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // --------------------------------------------------
        // ✅ NEW CODE FOR AUTHORIZATION GATES (START)
        // --------------------------------------------------
        
        // 1. Admin (Super User) को सारी permissions दें (Gate::before)
        Gate::before(function ($user, $ability) {
            if ($user->role === 'admin') {
                return true;
            }
        });

        // 2. Dynamic Permissions Gates Define करें
        // Note: Production में Performance के लिए permissions को cache करना बेहतर होता है
        try {
            // Check if the permissions table exists before querying
            if (\Schema::hasTable('permissions')) {
                $permissions = Permission::all();
                
                foreach ($permissions as $permission) {
                    // Gate name will be like 'permissions.view'
                    Gate::define($permission->module . '.' . $permission->action, function ($user) use ($permission) {
                        
                        // Admin already passed the Gate::before() check
                        
                        $role = Role::where('name', $user->role)->first();
                        if (!$role) {
                            return false;
                        }
                        
                        // Role के पास वह specific permission है या नहीं, चेक करें (using the id is generally more robust)
                        return $role->permissions->contains('id', $permission->id);
                    });
                }
            }
        } catch (\Exception $e) {
            // Handle case where database migration hasn't run yet during fresh install
            // You can log the error if needed
        }
        
        // --------------------------------------------------
        // ✅ NEW CODE FOR AUTHORIZATION GATES (END)
        // --------------------------------------------------

        View::composer('*', function ($view) {
            $user = Auth::user();

            // Default empty permissions
            $globalPermissions = [];

            if ($user) {
                $roleName = $user->role;
                $role = Role::where('name', $roleName)->first();

                $globalPermissions = $role
                ? $role->permissions->map(function($perm){
                    return $perm->module . '.' . $perm->action;
                })->toArray()
                : [];
            }

            // Pass to all views
            $view->with([
                'user' => $user,
                'globalPermissions' => $globalPermissions
            ]);
        });
    }
}