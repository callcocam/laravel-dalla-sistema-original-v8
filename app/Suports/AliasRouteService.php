<?php

namespace App\Suports;

use Illuminate\Support\Facades\Route;

class AliasRouteService
{

    public static function resources($path, $controller, $name=null, $pattern=null, $middleware=null){

        $router = new static();

        $name = is_null($name) ? $path : $name;

        if ($router->middleware($middleware)) {

            Route::resource($router->pattern($path,$pattern), $controller)->names([
                'index'=>sprintf('admin.%s.index', $name),
                'create'=>sprintf('admin.%s.create', $name),
                'store'=>sprintf('admin.%s.store', $name),
                'show'=>sprintf('admin.%s.show', $name),
                'edit'=>sprintf('admin.%s.edit', $name),
                'update'=>sprintf('admin.%s.update', $name),
                'destroy'=>sprintf('admin.%s.destroy', $name),
            ])->middleware($middleware);



        } else {

            Route::resource($router->pattern($path), $controller)->names([
                'index'=>sprintf('admin.%s.index', $name),
                'create'=>sprintf('admin.%s.create', $name),
                'store'=>sprintf('admin.%s.store', $name),
                'show'=>sprintf('admin.%s.show', $name),
                'edit'=>sprintf('admin.%s.edit', $name),
                'update'=>sprintf('admin.%s.update', $name),
                'destroy'=>sprintf('admin.%s.destroy', $name),
            ]);

        }

        $router->print($path, $controller,$name,$middleware);
        $router->find($path, $controller,$name,$middleware);


    }

    private function print($path, $controller,$name,$middleware=null){
        if ($this->middleware($middleware)) {
            Route::get(sprintf("%s/{id}/imprimir",$path), [$controller, "print"])
                ->name(sprintf('admin.%s.print', $name))->middleware($middleware);
        } else {
            Route::get(sprintf("%s/{id}/imprimir",$path), [$controller, "print"])
                ->name(sprintf('admin.%s.print', $name));
        }
    }
    private function find($path, $controller,$name,$middleware=null){
        if ($this->middleware($middleware)) {
            Route::get(sprintf("%s/find/select",$path), [$controller, "find"])
                ->name(sprintf('admin.%s.find', $name))->middleware($middleware);
        } else {
            Route::get(sprintf("%s/find/select",$path), [$controller, "find"])
                ->name(sprintf('admin.%s.find', $name));
        }
    }

    private function middleware($middleware){
        if (!is_null($middleware)) {
            return true;
        }
        return false;
    }

    private function pattern($path, $pattern=null){

        if(!is_null($pattern)){
            return sprintf("%s/%s", $path, $pattern);
        }

        return $path;
    }

}
