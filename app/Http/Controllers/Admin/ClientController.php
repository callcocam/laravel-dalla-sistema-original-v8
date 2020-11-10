<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Http\Controllers\Admin;

use App\Forms\ClientForm;
use App\Http\Requests\ClientStore;
use App\Models\Admin\Client;

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
}
