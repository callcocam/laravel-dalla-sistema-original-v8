<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Http\Controllers\Admin;


use App\Http\Requests\CompanyStore;
use App\Models\Admin\Company;

class CompanyController extends AbstractController
{

   protected $template = 'companies';

   protected $model = Company::class;

    /**
     * Store a newly created resource in storage.
     *
     * @param CompanyStore $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyStore $request)
    {

        return $this->save($request);
    }
}
