<?php

namespace wiltechsteam\FoundationService;

use wiltechsteam\FoundationService\Commands\FoundationServiceGetConfigCommand;
use wiltechsteam\FoundationService\Commands\FoundationServiceMakeCommand;
use wiltechsteam\FoundationService\Commands\FoundationServiceCommand;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;

class FoundationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->eventBoot(); //事件监听绑定
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/foundation.php', 'foundation'
        );

        $this->app->singleton('foundation:work', function() {
           return new FoundationServiceCommand();
        });
        $this->commands([
            'foundation:work'
        ]);

        $this->app->singleton('foundation:make', function() {
            return new FoundationServiceMakeCommand();
        });
        $this->commands([
            'foundation:make'
        ]);

        $this->app->singleton('foundation:config', function() {
            return new FoundationServiceGetConfigCommand();
        });
        $this->commands([
            'foundation:config'
        ]);
    }

    /**
     * 批量绑定事件监听
     */
    public function eventBoot()
    {
        foreach (config('foundation.listens') as $event => $listeners)
        {
            foreach ($listeners as $listener)
            {
                Event::listen($event, $listener);
            }
        }
    }
}
