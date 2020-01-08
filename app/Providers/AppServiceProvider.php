<?php

namespace App\Providers;

use App\Modules\Admin\Models\Admin;
use App\Modules\Conversation\Models\Conversation;
use Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Passport::routes();

        Blade::directive('convert', function ($money) {
            return "<?php echo number_format($money, 2, ',', ' '); ?>";
        });

        Blade::directive('formatDate', function ($date) {

            return "<?php echo date_format($date,'d-m-Y').' '.' à'.' '.date_format($date,'H:i:s');  ?>";
        });

        View::composer(['*'], function ($view) {
            $view->with('countConversations', Conversation::whereHas('messages', function ($queryMessage) {
                $queryMessage->where('seen', 0);
                $queryMessage->whereHas('user', function ($q1) {
                    $q1->where('child_type', '!=', Admin::class);
                });
            })->count()
            );

        });

    }
}
