<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Http\Controllers\Admin;


use App\Models\Admin\HistoryBarrel;
use Illuminate\Support\Facades\Auth;

class HistoryBarrelController extends AbstractController
{

   protected $template = 'history-barrels';

   protected $model = HistoryBarrel::class;

   public function barrels()
   {
       $user = Auth::user();

       $this->results['user'] = $user;

       $this->results['tenant'] = get_tenant();

       $this->results['rows'] = $this->getModel()->findBy(['client_id'=>$user->id])->get();

       if(!$this->results['rows']){

           notify()->error("O modelo não foi informado, se o problema persistir contate o administardor!!!!");

           return redirect()->route(sprintf("admin.%s.index", $this->template))->withErrors("O modelo não foi informado, se o problema persistir contate o administardor!!!!");

       }

       $this->getAppends();

       return view(sprintf('admin.%s.show', $this->template), $this->results);
   }

}
