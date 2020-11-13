<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Http\Controllers\Admin;


use App\Forms\ProductForm;
use App\Http\Requests\ProductStore;
use App\Http\Requests\BonuStore;
use App\Models\Admin\Product;

class ProductController extends AbstractController
{

   protected $template = 'products';

   protected $model = Product::class;

   protected $formClass = ProductForm::class;


    /**
     * Store a newly created resource in storage.
     *
     * @param ProductStore $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStore $request)
    {
        return $this->save($request);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param BonuStore $request
     * @return \Illuminate\Http\Response
     */
    public function bonus (BonuStore $request)
    {

        $product = $this->getModel()->findById($request->get('product_id'));

        $bonus = $product->bonu()->getRelated();

        $bonus->saveBy($request->all());

        if($bonus->getResultLastId()){


                notify()->success($bonus->getMessage());

                return back()->with('success', $bonus->getMessage());
        }
        notify()->error($bonus->getMessage());

        return back()->withErrors($bonus->getMessage())->withInput();
    }

    public function destroyBonu($product,$bonus)
    {

        $products = $this->getModel()->findById($product);

        $bonus = $products->bonus()->where('id', $bonus)->first();

        if($bonus->delete()){

            notify()->success("Bonus removido com sucesso!!");

            return back()->with('success', "Bonus removido com sucesso!!");

        }

        notify()->error("Não foi possivel remover o bonus!!");

        return back()->withErrors("Não foi possivel remover o bonus!!")->withInput();
    }
}
