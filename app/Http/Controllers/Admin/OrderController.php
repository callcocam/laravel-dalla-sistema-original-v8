<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Http\Controllers\Admin;

use App\Events\OrderEvent;
use App\Forms\OderForm;
use App\Http\Requests\OrderStore;
use App\Models\Admin\Client;
use App\Models\Admin\Order;
use App\Models\Admin\Product;

class OrderController extends AbstractController
{

   protected $template = 'orders';

   protected $direction = "DESC";

   protected $model = Order::class;

   protected $formClass = OderForm::class;

   protected $classSearch = Client::class;

   protected $event = OrderEvent::class;

   protected $searchId = 'client_id';

    /**
     * Store a newly created resource in storage.
     *
     * @param OrderStore $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderStore $request)
    {
        return $this->save($request);
    }

    public function create()
    {

        $data['number'] = \Faker\Provider\Uuid::numerify();

        $data['delivery_date'] = date('Y-m-d');

        $data['status'] = 'not-accepted';

        if(auth()->user()->hasAnyRole('cliente')){

            $data['client_id'] = auth()->user()->id;
        }

        $this->getModel()->saveBy($data);

        return redirect()->route('admin.orders.edit', $this->getModel()->getResultLastId());
    }

    public function edit($id)
    {
        $this->results['products'] = Product::query()->where('stock','>','0')->get(['id','name']);

        return parent::edit($id);
    }
}
