<?php

namespace App\Providers;

use App\Policies\MoviePolicy;
use App\Policies\PackagePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\Roles\src\Models\Module;
use Modules\Users\src\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Modules\Customers\src\Models\Customer;
use Modules\Movies\src\Models\Movie;
use Modules\Packages\src\Models\Package;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Movie::class => MoviePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //Thiết lập thời gian sống của token
        Passport::tokensExpireIn(now()->addMinutes(60));
        Passport::refreshTokensExpireIn(now()->addDays(7));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));


        //Thiết lập đường dẫn lấy lại mật khẩu cho users
        $this->registerPolicies();
        // Passport::routes();
        // Thiết lập đường dẫn lấy lại mật khẩu cho Users
        ResetPasswordNotification::createUrlUsing(function ($user, string $token) {
            return route('admin.password.reset', ['token' => $token]) . "?email=" . $user->email;
        });

        // Thiết lập đường dẫn lấy lại mật khẩu cho Customers
        ResetPasswordNotification::createUrlUsing(function ($customer, string $token) {
            return route('xacthuc.reset', ['token' => $token]) . "?email=" . $customer->email;
        });


        $modules = Module::all();
        if ($modules->count() > 0) {
            foreach ($modules as $module) {
                //Quyền xem
                Gate::define($module->name, function (User $user) use ($module) {

                    $roleJson = $user->roles->permissions;
                    if (!empty($roleJson)) {
                        $roleArr = json_decode($roleJson, true);
                        $check = isRole($roleArr, $module->name);
                        return $check;
                    }
                    return false;
                });

                //Quyền thêm
                Gate::define($module->name . '.add', function (User $user) use ($module) {
                    $roleJson = $user->roles->permissions;
                    if (!empty($roleJson)) {
                        $roleArr = json_decode($roleJson, true);
                        $check = isRole($roleArr, $module->name, 'add');
                        return $check;
                    }
                    return false;
                });

                //Quyền sửa
                Gate::define($module->name . '.edit', function (User $user) use ($module) {
                    $roleJson = $user->roles->permissions;
                    if (!empty($roleJson)) {
                        $roleArr = json_decode($roleJson, true);
                        $check = isRole($roleArr, $module->name, 'edit');
                        return $check;
                    }
                    return false;
                });

                //Quyền xóa
                Gate::define($module->name . '.delete', function (User $user) use ($module) {
                    $roleJson = $user->roles->permissions;
                    if (!empty($roleJson)) {
                        $roleArr = json_decode($roleJson, true);
                        $check = isRole($roleArr, $module->name, 'delete');
                        return $check;
                    }
                    return false;
                });

                Gate::define($module->name . '.permissions', function (User $user) use ($module) {
                    $roleJson = $user->roles->permissions;
                    if (!empty($roleJson)) {
                        $roleArr = json_decode($roleJson, true);
                        $check = isRole($roleArr, 'permissions', 'permissions');
                        return $check;
                    }
                    return false;
                });
            }
        }
    }
}
