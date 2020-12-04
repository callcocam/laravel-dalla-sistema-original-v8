<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use  App\Http\Controllers\Admin\AdminController;
use  App\Http\Controllers\Admin\ProfileController;
use  App\Http\Controllers\Admin\SettingController;
use  App\Http\Controllers\Admin\ProductController;
use  App\Http\Controllers\Admin\BonificationController;
use  App\Http\Controllers\Admin\EventLastController;
use  App\Http\Controllers\Admin\EventNextController;
use  App\Http\Controllers\Admin\VisitsDistributorController;

Route::get('/home', function (){
    return redirect('/');
})->name('home-redirect');


Route::get('/remove-pontuacao-users', function (){
   $users  = \App\Models\Admin\Client::all();

   if($users){

       foreach ($users as $user){
           $user->saveBy([
               'id'=>$user->id,
               'document'=>str_replace(['.','-','/'],'',$user->document),
               'phone'=>str_replace(['.','-','/'],'',$user->phone)
           ]);

           dump($user->getMessage());
       }
   }
});



Auth::routes();

Route::get('/aguardando-aprovacao', function (){
    return view('aguardando-aprovacao');
})->middleware('auth')->name('home-aguardando-aprovacao');

Route::group(['prefix'=>'/','middleware'=>['auth', 'status-published']],function (\Illuminate\Routing\Router $router) {

    //BLOCK USERS ADMIN
    $router->get('/', [AdminController::class,'index'])->name('admin.admin.index');
    $router->get('/passport-clients', [AdminController::class,'passportClients'])->name('passport-clients');
    $router->get('/passport-authorized-clients', [AdminController::class,'passportAuthorizedClients'])->name('passport-authorized-clients');
    $router->get('/passport-personal-access-tokens', [AdminController::class,'passportPersonalAccessTokens'])->name('passport-personal-access-tokens');

    $router->get('/remove-file/{id}', [AdminController::class,'removeFile'])->name('admin.admin.remove-file');

    $router->get('/profile', [ProfileController::class,'profile'])->name('admin.auth.profile.form');

    $router->post('/profile', [ProfileController::class, 'store'])->name('admin.auth.profile');

    $router->get('/empresa', [ SettingController::class, 'setting'])->name('admin.settings.setting')->middleware('can:admin.settings.show');

    $router->post('/empresa', [ SettingController::class, 'store'])->name('admin.settings.store')->middleware('can:admin.settings.store');

    $router->get('/historico-barrils', [ \App\Http\Controllers\Admin\HistoryBarrelController::class, 'index'])->name('admin.history-barrels.index');

    $router->get('/todas-as-notificacoes', [ \App\Http\Controllers\Admin\PostController::class, 'all'])->name('admin.posts.all.index');
    $router->get('/generate-prermissions', [ \App\Http\Controllers\Admin\PermissionController::class, 'generate_prermissions'])->name('admin.posts.generate-prermissions.index');

    \App\Suports\AliasRouteService::resources('usuarios', \App\Http\Controllers\Admin\UserController::class,'users');
    \App\Suports\AliasRouteService::resources('permissions', \App\Http\Controllers\Admin\PermissionController::class,'permissions');
    \App\Suports\AliasRouteService::resources('roles', \App\Http\Controllers\Admin\RoleController::class,'roles');
    \App\Suports\AliasRouteService::resources('produtos', ProductController::class,'products');
    \App\Suports\AliasRouteService::resources('orders', \App\Http\Controllers\Admin\OrderController::class,'orders');
    \App\Suports\AliasRouteService::resources('ultimos-eventos', EventLastController::class,'events-last');
    \App\Suports\AliasRouteService::resources('proximos-eventos', EventNextController::class,'events-next');
    \App\Suports\AliasRouteService::resources('tarefas', \App\Http\Controllers\Admin\TaskController::class,'tasks');
    \App\Suports\AliasRouteService::resources('clientes', \App\Http\Controllers\Admin\ClientController::class,'clients');
    \App\Suports\AliasRouteService::resources('items', \App\Http\Controllers\Admin\ItemController::class,'items');
    \App\Suports\AliasRouteService::resources('visitas-ditribuidor', \App\Http\Controllers\Admin\VisitsDistributorController::class,'visits-distributors');
    \App\Suports\AliasRouteService::resources('comodatas', \App\Http\Controllers\Admin\LendingController::class,'lendings');
    \App\Suports\AliasRouteService::resources('posts', \App\Http\Controllers\Admin\PostController::class,'posts');
    \App\Suports\AliasRouteService::resources('downloads', \App\Http\Controllers\Admin\DownloadController::class,'downloads');

    $router->group(['prefix'=>'produtos'], function($router){

        $router->post('/bonus/cadastrar', [ProductController::class,'bonus'])->name('admin.products.bonus.stores')->middleware('can:admin.products.bonus.stores');

        $router->get('/bonus/{product}/delete/{bonus}', [ProductController::class, 'destroyBonu'])->name('admin.products.bonus.destroy')->middleware('can:admin.products.bonus.destroy');

    });

    $router->group(['prefix'=>'bonificacoes'], function($router){

        $router->get('/{id}/aplicar', [ BonificationController::class, 'application'])->name('admin.bonificacoes.application')->middleware('can:admin.bonificacoes.application');

    });

    $router->group(['prefix'=>'ultimos-eventos'], function(\Illuminate\Routing\Router $router){

        $router->get('/{id}/tarefas', [ EventLastController::class, 'task'])->name('admin.tasks-last.index')->middleware('can:admin.tasks-last.index');

        $router->post('/tarefas/{id}/update', [ EventLastController::class, 'updateTask'])->name('admin.tasks-last.update')->middleware('can:admin.tasks-last.update');

        $router->post('/pos-evento/store', [EventLastController::class, 'posEvent'])->name('admin.pos-events-last.store')->middleware('can:admin.pos-events-last.store');

        $router->get('/{id}/lista/tarefas', [EventLastController::class, 'taskList'])->name('admin.tasks-last.list')->middleware('can:admin.tasks-last.list');

    });


    $router->group(['prefix'=>'proximos-eventos'], function($router){

        $router->get('/{id}/tarefas', [ EventNextController::class, 'task'])
            ->name('admin.tasks-next.index')->middleware('can:admin.tasks-next.index');

        $router->get('/{id}/lista/tarefas', [ EventNextController::class, 'taskList'])->name('admin.tasks-next.list')->middleware('can:admin.tasks-next.list');

        $router->post('/tarefas/{id}/update', [ EventNextController::class, 'updateTask'])->name('admin.tasks-next.update')->middleware('can:admin.tasks-next.update');

        $router->delete('/tarefas/{id}/delete', [ EventNextController::class, 'deleteTask'])->name('admin.tasks-next.delete')->middleware('can:admin.tasks-next.delete');

        $router->post('/pos-evento/store', [ EventNextController::class, 'posEvent'])->name('admin.pos-events-next.store')->middleware('can:admin.pos-events-next.store');
    });

    $router->post('/visitas-ditribuidor/store-json/save', [VisitsDistributorController::class, 'updateVisit'])->name('admin.visits-distributors.update-visit-json')->middleware('can:visits-distributors.update-visit-json');

    $router->get('/meus-barrils', [\App\Http\Controllers\Admin\HistoryBarrelController::class, 'barrels'])->name('admin.barrels.client.index');

});
