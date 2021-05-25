<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Http\Controllers\Admin;


use App\Forms\CategoryForm;
use App\Http\Requests\CategoryStore;
use App\Models\Admin\Category;

class CategoryController extends AbstractController
{

   protected $template = 'categories';

   protected $model = Category::class;

   protected $formClass = CategoryForm::class;


    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryStore $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStore $request)
    {
        return $this->save($request);
    }
}
