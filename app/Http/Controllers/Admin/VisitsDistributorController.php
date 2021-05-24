<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Http\Controllers\Admin;


use App\Events\VisitorEvent;
use App\Forms\VisitsDistributorForm;
use App\Http\Requests\VisitsDistributorStore;
use App\Models\Admin\VisitsDistributor;

class VisitsDistributorController extends AbstractController
{

    protected $template = 'visits-distributors';

    protected $model = VisitsDistributor::class;

    protected $formClass = VisitsDistributorForm::class;

    protected $event = VisitorEvent::class;

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

    public function updateVisit(VisitsDistributorStore $request){

        $this->getModel()->saveBy($request->all());
        if($this->getModel()->getResultLastId()){

            if($this->event){
                $this->setEvent($this->getModel()->findById($this->getModel()->getResultLastId()));
            }

        }
        return response()->json([
            'id'=>$this->getModel()->getResultLastId(),
            'redirect'=>route('admin.visits-distributors.edit',$this->getModel()->getResultLastId()),
            'message'=>$this->getModel()->getMessage(),
        ]);
    }
}
