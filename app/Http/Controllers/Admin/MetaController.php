<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Http\Controllers\Admin;


use App\Http\Requests\MetaStore;
use App\Models\Admin\Meta;


class MetaController extends AbstractController
{

   protected $template = 'metas';

   protected $model = Meta::class;


    /**
     * Store a newly created resource in storage.
     *
     * @param MetaStore $request
     * @return \Illuminate\Http\Response
     */
    public function store(MetaStore $request)
    {
        return $this->save($request);
    }

  public function index()
  {
      if(auth()->user()->hasAnyRole('cliente')){
          $this->getSource()->where('client_id', auth()->id());
      }
      return parent::index();
  }
}
