<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Http\Controllers\Admin;


use App\Models\Admin\HistoryBarrel;
use App\Models\Admin\Movimentation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HistoryBarrelController extends AbstractController
{

   protected $template = 'history-barrels';

   protected $model = Movimentation::class;

   public function barrels()
   {
       $user = Auth::user();

       $sum = DB::table('movimentations')
           ->select( DB::raw('SUM(quantity) as total'))
           ->where('client_id',$user->id)
           ->first();
       $this->results['count_moviment'] = $sum->total;

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
