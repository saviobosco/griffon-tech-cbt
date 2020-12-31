<?php


namespace GriffonTech\Quiz\Providers;


use Illuminate\Support\ServiceProvider;

class QuizServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'quiz');
    }

}
