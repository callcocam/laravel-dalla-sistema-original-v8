<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Http\Controllers\Admin;

use App\Forms\ItemForm;
use App\Helpers\MetaHelper;
use App\Http\Requests\ItemStore;
use App\Models\Admin\Item;
use App\Models\Admin\Meta;
use Illuminate\Support\Facades\DB;

class ItemController extends AbstractController
{

    protected $template = 'items';

    protected $model = Item::class;

    protected $formClass = ItemForm::class;


    /**
     * Store a newly created resource in storage.
     *
     * @param ItemStore $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemStore $request)
    {
        // It will automatically use current request, get the rules, and do the validation

        $this->getModel()->saveBy($request->all());

        if($this->getModel()->getResultLastId()){
            $order = $this->getModel()->getModel()->order;

            MetaHelper::make($order->client,$order->created_at);
            notify()->success($this->getModel()->getMessage());
            return back()->with('success', $this->getModel()->getMessage());
        }

        notify()->error($this->getModel()->getMessage());

        return back()->withErrors($this->getModel()->getMessage())->withInput();
    }

    public function destroy($id)
    {
        if(!$this->model){

            notify()->error("O modelo não foi informado, se o problema persistir contate o administardor!!!!");

            return back()->withErrors("O modelo não foi informado, se o problema persistir contate o administardor!!!!");

        }

        $model = $this->getModel()->findById($id);

        if(!$model){

            notify()->error("O modelo não foi informado, se o problema persistir contate o administardor!!!!");

            return back()->withErrors("O modelo não foi informado, se o problema persistir contate o administardor!!!!");

        }

        if($this->getModel()->deleteBy($model)){

            notify()->success($this->getModel()->getMessage());

            return back()->with('success', $this->getModel()->getMessage());

        }

        notify()->error($this->getModel()->getMessage());

        return back()->withErrors($this->getModel()->getMessage());
    }
}
