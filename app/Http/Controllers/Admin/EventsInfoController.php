<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Http\Controllers\Admin;


use App\Forms\EventsInfoForm;
use App\Http\Requests\VisitsDistributorStore;
use App\Models\Admin\EventsInfo;

class EventsInfoController extends AbstractController
{

   protected $template = 'events-infos';

   protected $model = EventsInfo::class;

   protected $formClass = EventsInfoForm::class;


    /**
     * Store a newly created resource in storage.
     *
     * @param VisitsDistributorStore $request
     * @return \Illuminate\Http\Response
     */
    public function store(VisitsDistributorStore $request)
    {
        return $this->save($request);
    }
}
