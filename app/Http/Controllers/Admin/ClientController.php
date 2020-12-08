<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Http\Controllers\Admin;

use App\Forms\ClientForm;
use App\Helpers\MetaHelper;
use App\Http\Requests\ClientStore;
use App\Models\Admin\Client;
use App\Models\Admin\Meta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

class ClientController extends AbstractController
{

   protected $template = 'clients';

   protected $model = Client::class;

   protected $formClass = ClientForm::class;

   protected $appends = ['bonification'];

   public function index()
   {
       $this->getSource()->where('is_admin','0');

       return parent::index();
   }


    /**
     * Store a newly created resource in storage.
     *
     * @param ClientStore $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientStore $request)
    {
        return $this->save($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Gate::denies(Route::currentRouteName())){
            abort(401, 'Não autorizado!!');
        }

         $request->validate([
            'meta'=>'required'
        ], $request->input());

        $client = $this->getModel()->findById($id);

        if($client){
            $client->meta = $request->input('meta');

            $client->saveBy($request->input());

            if (!$client->meta(today()->format('m'))) {
                 Meta::create([
                    'user_id' => auth()->id(),
                    'client_id' => $client->id,
                    'meta' =>  0,
                    'status' => 'published',
                    'create_at' => today()->format('y-m-d'),
                    'updated_at' => today()->format('y-m-d'),
                ]);
            }

            return back()->with('success', $this->getModel()->getMessage());
        }

        return back()->with('error', $this->getModel()->getMessage());;
    }

}
