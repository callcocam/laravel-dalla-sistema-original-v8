<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Http\Controllers\Admin;


use App\Http\Requests\BonificationStore;
use App\Models\Admin\Bonification;


class BonificationController extends AbstractController
{

   protected $template = 'bonifications';

   protected $model = Bonification::class;


   public function application ($id)
   {

       if(!$this->model){

           notify()->error("O modelo não foi informado, se o problema persistir contate o administardor!!!!");

           return back()->withErrors("O modelo não foi informado, se o problema persistir contate o administardor!!!!");

       }

       $rows = $this->getModel()->findById($id);

       if(!$rows){
           notify()->error(__("O modelo não foi informado, se o problema persistir contate o administardor!!!!"));

           return back()->withErrors(__("O modelo não foi informado, se o problema persistir contate o administardor!!!!"));
       }
       $rows->status = 'draft';

       if($rows->update()){
           notify()->success(__("Bonificação aplicada com sucesso!!"));

           return back()->withErrors(__("Bonificação aplicada com sucesso!!"));
       }

       notify()->error(__("Não foi possivel aplicar a bonificação!!"));

       return back()->withErrors(__("Não foi possivel aplicar a bonificação!!"));

   }

    /**
     * Store a newly created resource in storage.
     *
     * @param BonificationStore $request
     * @return \Illuminate\Http\Response
     */
    public function store(BonificationStore $request)
    {
        return $this->save($request);
    }

}
