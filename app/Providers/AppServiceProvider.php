<?php

namespace App\Providers;

use App\Models\Page;
use App\Support\Site;
use App\Support\Themes;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->scoped(Site::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureDefaults();

        // Every public site view gets the settings and the menu.
        View::composer('site.*', function ($view) {
            $view->with([
                'site' => app(Site::class),
                'menu' => $view->getData()['menu'] ?? Page::query()->menu()->get(),
                'page' => $view->getData()['page'] ?? null,
                'theme' => $view->getData()['theme'] ?? Themes::current(app(Site::class)),
            ]);
        });
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(fn (): ?Password => app()->isProduction()
            ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            : null,
        );
    }
}
