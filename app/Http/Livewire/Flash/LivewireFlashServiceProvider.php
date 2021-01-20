<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Http\Livewire\Flash;

use Livewire\Livewire;
use Illuminate\Support\ServiceProvider;

class LivewireFlashServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Http\Livewire\Flash\SessionStore',
            'App\Http\Livewire\Flash\LaravelSessionStore'
        );

        $this->app->singleton('lwflash', function () {
            return $this->app->make('App\Http\Livewire\Flash\LivewireFlashNotifier');
        });
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadViewsFrom(app_path('Http/Livewire/Flash/views/livewire-flash'), 'livewire-flash');
        $this->mergeConfigFrom(app_path('Http/Livewire/Flash/livewire-flash.php'), 'livewire-flash');
        Livewire::component('flash-container', \App\Http\Livewire\Flash\Livewire\FlashContainer::class);
        Livewire::component('flash-message', \App\Http\Livewire\Flash\Livewire\FlashMessage::class);
        Livewire::component('flash-overlay', \App\Http\Livewire\Flash\Livewire\FlashOverlay::class);
    }
}
