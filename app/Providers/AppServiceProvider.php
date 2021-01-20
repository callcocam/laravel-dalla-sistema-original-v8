<?php

namespace App\Providers;

use App\Forms\Core\FormBuilderServiceProvider;
use App\Http\Livewire\Flash\LivewireFlashServiceProvider;
use App\Models\Admin\Post;
use App\Suports\Notify\NotifyServiceProvider;
use App\Suports\Shinobi\ShinobiServiceProvider;
use App\Tenant\TenantServiceProvider;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use ConsoleTVs\Charts\Registrar as Charts;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(TenantServiceProvider::class);
        $this->app->register(LivewireFlashServiceProvider::class);
        $this->app->register(NotifyServiceProvider::class);
        $this->app->register(ShinobiServiceProvider::class);
        $this->app->register(FormBuilderServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Charts $charts)
    {
//        $charts->register([
//            \App\Charts\MetaChart::class
//        ]);
        Paginator::useBootstrap();
        $this->bluePrintMacros();
        $this->component();
    }

    public function component(){
        view()->composer('*', function (View $view){
            $posts = Post::query()->latest()->count();
            $view->with('notificationsCount', $posts);
        });
        view()->composer('*', function (View $view){
            $posts = Post::query()->latest()->limit(5)->get();
            $view->with('notifications', $posts);
        });
    }

    public function bluePrintMacros()
    {
        Blueprint::macro('tenant', function(){
            $this->unsignedBigInteger('company_id')->nullable();
            $this
                ->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Blueprint::macro('user', function(){
            $this->unsignedBigInteger('user_id')->nullable();
            $this
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Blueprint::macro('status', function($status =[]){
            $this->enum('status', array_merge([  'deleted','draft','published'], $status))->default('published');
        });

    }
}
