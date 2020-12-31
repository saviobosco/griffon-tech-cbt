<?php


namespace GriffonTech\Admin\Providers;


use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use GriffonTech\Admin\Http\Middleware\Bouncer as BouncerMiddleware;

class AdminServiceProvider extends ServiceProvider
{

    public function boot(Router $router)
    {
        $this->loadRoutesFrom(__DIR__ . '/../Http/routes.php');

        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'admin');

        $router->aliasMiddleware('admin', BouncerMiddleware::class);

    }

    public function register()
    {

    }
}
