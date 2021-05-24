<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Admin\AbstractController;
use App\Http\Requests\HistoryBarrelStore;
use App\Models\Admin\Client;
use App\Models\Admin\HistoryBarrel;

class HistoryBarrelController extends AbstractController
{


   protected $model = HistoryBarrel::class;



   public function index()
   {

       $this->results['rows'] = $this->getSource()->orderBy($this->order, $this->direction)->paginate($this->perPage);

       return response()->json($this->results);
   }


    /**
     * Store a newly created resource in storage.
     *
     * @param HistoryBarrelStore $request
     * @return \Illuminate\Http\Response
     */
    public function store(HistoryBarrelStore $request)
    {

        $client = Client::query()->where('document', $request->get('document'))->first();
        // It will automatically use current request, get the rules, and do the validation
        if (!$client){
            return response()->json([
                'message'=>"Cliente não encontrado"
            ],500);
        }
        if($request->get('type') === 'in'){
            $client->barrels = (int)$client->barrels +  (int)$request->get('quantity');
        }
        else{
            if((int)$client->barrels > (int)$request->get('quantity')){
                $client->barrels = (int)$client->barrels -  (int)$request->get('quantity');
            }
           else{
               $client->barrels  =0;
           }
        }
        $data = $request->all();

        $data['client_id'] = $client->id;

        $this->getModel()->saveBy($data);

        if($this->getModel()->getResultLastId()){

            $client->save();

            return response()->json([
                'message'=>$this->getModel()->getMessage()
            ]);
        }
        return response()->json([
            'message'=>$this->getModel()->getMessage()
        ],500);
    }
}
