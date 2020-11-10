<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Http\Controllers\Admin;


use App\Forms\ContractForm;
use App\Http\Requests\ContracStore;
use App\Models\Admin\Contract;

class ContractController extends AbstractController
{

   protected $template = 'clients-events';

   protected $model = Contract::class;

   protected $formClass = ContractForm::class;

   public function index()
   {
       $this->getSource()->where('is_admin','2');

       return parent::index();
   }

    /**
     * Store a newly created resource in storage.
     *
     * @param ContracStore $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContracStore $request)
    {

        return $this->save($request);
    }
}
