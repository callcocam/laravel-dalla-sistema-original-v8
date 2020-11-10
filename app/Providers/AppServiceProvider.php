<?php

namespace App\Providers;

use App\Forms\Core\FormBuilderServiceProvider;
use App\Suports\Notify\NotifyServiceProvider;
use App\Suports\Shinobi\ShinobiServiceProvider;
use App\Tenant\TenantServiceProvider;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

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
        $this->app->register(NotifyServiceProvider::class);
        $this->app->register(ShinobiServiceProvider::class);
        $this->app->register(FormBuilderServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        $this->bluePrintMacros();
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
