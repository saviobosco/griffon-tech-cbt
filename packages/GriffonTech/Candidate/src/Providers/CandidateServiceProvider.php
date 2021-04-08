<?php


namespace GriffonTech\Candidate\Providers;


use Illuminate\Support\ServiceProvider;
use GriffonTech\Admin\Http\Middleware\Bouncer as BouncerMiddleware;
use Illuminate\Routing\Router;

class CandidateServiceProvider extends ServiceProvider
{

    public function boot(Router $router)
    {
        $this->loadRoutesFrom(__DIR__ . '/../Http/routes.php');

        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'candidate');

        //$router->aliasMiddleware('admin', BouncerMiddleware::class);

    }
}
