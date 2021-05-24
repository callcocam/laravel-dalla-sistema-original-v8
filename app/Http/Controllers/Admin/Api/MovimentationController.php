<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Admin\AbstractController;
use App\Http\Requests\MovimentationStore;
use App\Models\Admin\Client;
use App\Models\Admin\Lending;
use App\Models\Admin\Movimentation;

class MovimentationController extends AbstractController
{


    protected $model = Movimentation::class;


    public function index()
    {

        $this->results['rows'] = $this->getSource()->orderBy($this->order, $this->direction)->paginate($this->perPage);

        return response()->json($this->results);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param MovimentationStore $request
     * @return \Illuminate\Http\Response
     */
    public function store(MovimentationStore $request)
    {

        $client = Client::query()->where('document', str_replace(['.','-','/'],'',$request->get('document')))->first();
        // It will automatically use current request, get the rules, and do the validation
        if (!$client) {
            return response()->json([
                'message' => "Cliente não encontrado"
            ], 500);
        }

        $lending = Lending::find($request->input('lending_id'));


        if(!$lending){
            return response()->json([
                'message' => "Produto não encontrado"
            ], 500);
        }

       if($request->input('type') == 'out'){
           $quantity = $lending->sun($lending,$client->id);
           if($quantity < $request->input('quantity')){
               return response()->json([
                   'message' => "O estoque do produto é menor que a quantidade enviada!"
               ], 500);
           }
       }

        $moviment = $client->moviment()->where('lending_id', $request->input('lending_id'))->first();
        if ($moviment) {
            $data = $request->input();
            $data['client_id'] = $client->id;
            $this->getModel()->saveBy($data);
        } else {
            $data = $request->input();
            $data['client_id'] = $client->id;
            $this->getModel()->saveBy($data);
        }
        return response()->json([
            'message' => $this->getModel()->getMessage()
        ], 500);
    }
}
