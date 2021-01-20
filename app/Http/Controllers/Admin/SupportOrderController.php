<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Http\Controllers\Admin;

use App\Forms\SupportOrderForm;
use App\Http\Requests\SupportOrderStore;
use App\Models\Admin\Support;
use App\Models\Admin\SupportOrder;

class SupportOrderController extends AbstractController
{

   protected $template = 'supports-orders';

   protected $model = SupportOrder::class;

    protected $direction = "DESC";

   protected $formClass = SupportOrderForm::class;

   public function create()
   {

       $data['number'] = \Faker\Provider\Uuid::numerify();

       $data['delivery_date'] = date('Y-m-d');

       $data['status'] = 'not-accepted';

       if(auth()->user()->hasAnyRole('cliente')){

           $data['client_id'] = auth()->user()->id;
       }

       $this->getModel()->saveBy($data);

       return redirect()->route('admin.supports-orders.edit', $this->getModel()->getResultLastId());
   }

    /**
     * Store a newly created resource in storage.
     *
     * @param SupportOrderStore $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupportOrderStore $request)
    {
        return $this->save($request);
    }

    public function edit($id)
    {
        $this->results['products'] = Support::query()->where('stock','>','0')->get(['id','name','price']);

        return parent::edit($id);
    }
}
