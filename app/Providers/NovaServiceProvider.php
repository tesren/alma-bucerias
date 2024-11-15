<?php

namespace App\Providers;

use App\Nova\Unit;
use App\Nova\User;
use App\Nova\Shape;
use App\Nova\Tower;
use App\Nova\Message;
use App\Nova\Section;
use App\Nova\UnitType;
use Laravel\Nova\Nova;
use Laravel\Nova\Tool;
use App\Nova\PaymentPlan;
use Laravel\Nova\Menu\Menu;
use Illuminate\Http\Request;
use App\Nova\Dashboards\Main;
use App\Nova\Filters\UserType;
use Laravel\Nova\Menu\MenuItem;
use App\Nova\ConstructionUpdate;
use Laravel\Nova\Menu\MenuGroup;
use Laravel\Nova\Menu\MenuSection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Nova::withBreadcrumbs();

        Nova::mainMenu(function (Request $request) {
            return [
                MenuSection::dashboard(Main::class)->icon('template'),
               
                MenuSection::resource(Unit::class)->icon('home'), 
                MenuSection::resource(Tower::class)->icon('office-building'), 
                //MenuSection::resource(Section::class)->icon('eye'), 
                MenuSection::resource(UnitType::class)->icon('collection'),     
                MenuSection::resource(PaymentPlan::class)->icon('currency-dollar'),
                MenuSection::resource(Message::class)->icon('inbox-in'),
                MenuSection::resource(ConstructionUpdate::class)->icon('camera'),
                MenuSection::resource(Shape::class)->icon('cube'),

                MenuSection::make('Marketing', [
                    MenuItem::externalLink(__('Inicio'), '/dashboard/home')->openInNewTab(),
                    MenuItem::externalLink(__('Inventario'), '/dashboard/inventory')->openInNewTab(),
                ])->icon('star')->collapsable(),

                MenuSection::make(__('Usuarios'), [
                    //MenuItem::filter('Clientes', User::class, UserType::make(), 'client'),
                    MenuItem::externalLink(__('Clientes'), '/nova/resources/users?users_page=1&users_filter=W3siU2VsZWN0OnJvbGUiOiJjbGllbnQifV0%3D'),
                    MenuItem::externalLink(__('Asesores'), '/nova/resources/users?users_page=1&users_filter=W3siU2VsZWN0OnJvbGUiOiJhZ2VudCJ9XQ%3D%3D'),
                    MenuItem::externalLink(__('Administradores'), '/nova/resources/users?users_page=1&users_filter=W3siU2VsZWN0OnJvbGUiOiJhZG1pbiJ9XQ%3D%3D'),
                    MenuItem::resource(User::class),
                ])->icon('user')->collapsable(),
            ];
        });

        Nova::userMenu(function (Request $request, Menu $menu) {
            
            $menu->append(
                MenuItem::externalLink(__('Ver Sitio Web'), url('/'))
            );

            $menu->prepend(
                MenuItem::link(__('Mi Perfil'), '/resources/users/'.$request->user()->getKey())
            );

            return $menu;
        });

        Nova::footer(function ($request) {
            return Blade::render('
                <div class="mt-8 leading-normal text-xs text-gray-500 space-y-1">
                    <p class="text-center">Powered by <a href="https://punto401.com/" target="_blank" rel="noopener noreferrer" class="link-default">Punto401</a></p>
                </div>
            ');
        });
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    
    }
}
