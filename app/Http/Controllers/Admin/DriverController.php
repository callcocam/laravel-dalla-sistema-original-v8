<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

class DriverController extends AbstractController
{

    protected $template = 'drivers';

    protected $direction = "DESC";

    protected $model = Order::class;

    protected $perPage = 4;


    public function index()
    {
        if(Gate::denies(Route::currentRouteName())){
            abort(401, 'Não autorizado!!');
        }
        $this->results['user'] = Auth::user();
        $this->results['tenant'] = get_tenant();

        return view(sprintf('admin.%s.index', $this->template), $this->results);
    }
}
