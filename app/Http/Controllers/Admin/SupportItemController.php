<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Http\Controllers\Admin;

use App\Forms\ItemForm;
use App\Http\Requests\SupportItemStore;
use App\Models\Admin\Support;
use App\Models\Admin\SupportOrderItem;

class SupportItemController extends AbstractController
{

    protected $template = 'items';

    protected $model = SupportOrderItem::class;

    protected $formClass = ItemForm::class;


    /**
     * Store a newly created resource in storage.
     *
     * @param SupportItemStore $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupportItemStore $request)
    {
        // It will automatically use current request, get the rules, and do the validation

        $data = $request->all();
dd($data);
        $product = Support::find($request->get('support_id'));
        $data['price'] = $product->price;
        $data['total'] = $product->price * $request->get('amount');
        $this->getModel()->saveBy($data);

        if($this->getModel()->getResultLastId()){
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
