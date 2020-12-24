<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Http\Controllers\Admin;


use App\Forms\SupportForm;
use App\Http\Requests\SupportStore;
use App\Models\Admin\Support;

class SupportController extends AbstractController
{

   protected $template = 'supports-material';

   protected $model = Support::class;

   protected $formClass = SupportForm::class;


    /**
     * Store a newly created resource in storage.
     *
     * @param SupportStore $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupportStore $request)
    {
        return $this->save($request);
    }
}
