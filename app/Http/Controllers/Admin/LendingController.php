<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Http\Controllers\Admin;


use App\Forms\LendingForm;
use App\Http\Requests\LendingtStore;
use App\Models\Admin\Lending;
use Illuminate\Support\Facades\Auth;

class LendingController extends AbstractController
{

   protected $template = 'lendings';

   protected $model = Lending::class;

   protected $formClass = LendingForm::class;

   public function index()
   {

       if(auth()->user()->hasAnyRole('cliente')){
           $this->getSource()->whereIn('id',auth()->user()->moviments()->pluck('lending_id')->unique()->toArray())->orderBy($this->order, $this->direction);

       }
       return parent::index();
   }

    /**
     * Store a newly created resource in storage.
     *
     * @param LendingtStore $request
     * @return \Illuminate\Http\Response
     */
    public function store(LendingtStore $request)
    {
        return $this->save($request);
    }

}
