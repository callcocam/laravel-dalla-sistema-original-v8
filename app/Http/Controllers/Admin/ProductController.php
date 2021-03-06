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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

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

    public function copy(Product $product)
    {
        if(Gate::denies(Route::currentRouteName())){
            abort(401, 'Não autorizado!!');
        }
        $new = $product->replicate(['id']);
        $new->name = sprintf("%s - %s", $new->name, date("H-m-d H:i:s"));
        $this->getModel()->saveBy($new->toArray());
        notify()->success(sprintf("Produto %s copiado com sucesso!!!", $product->name));

        return back()->with(sprintf("Produto %s copiado com sucesso!!!", $product->name));
    }

    public function stoque()
    {
        if (Gate::denies(Route::currentRouteName())) {
            abort(401, 'Não autorizado!!');
        }
        $this->results['user'] = Auth::user();
        $this->results['tenant'] = get_tenant();
        $this->results['search'] = '';
        $this->results['status'] = '';

        return view(sprintf('admin.%s.stoque', $this->template), $this->results);
    }

    public function prices()
    {
        if (Gate::denies(Route::currentRouteName())) {
            abort(401, 'Não autorizado!!');
        }
        $this->results['user'] = Auth::user();
        $this->results['tenant'] = get_tenant();
        $this->results['search'] = '';
        $this->results['status'] = '';

        return view(sprintf('admin.%s.prices', $this->template), $this->results);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BonuStore $request
     * @return \Illuminate\Http\Response
     */
    public function bonus(BonuStore $request)
    {

        $product = $this->getModel()->findById($request->get('product_id'));

        $bonus = $product->bonu()->getRelated();

        $bonus->saveBy($request->all());

        if ($bonus->getResultLastId()) {


            notify()->success($bonus->getMessage());

            return back()->with('success', $bonus->getMessage());
        }
        notify()->error($bonus->getMessage());

        return back()->withErrors($bonus->getMessage())->withInput();
    }

    public function destroyBonu($product, $bonus)
    {

        $products = $this->getModel()->findById($product);

        $bonus = $products->bonus()->where('id', $bonus)->first();

        if ($bonus->delete()) {

            notify()->success("Bonus removido com sucesso!!");

            return back()->with('success', "Bonus removido com sucesso!!");

        }

        notify()->error("Não foi possivel remover o bonus!!");

        return back()->withErrors("Não foi possivel remover o bonus!!")->withInput();
    }
}
