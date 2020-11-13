<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Http\Controllers\Admin;


use App\Forms\SettingForm;
use App\Http\Requests\CompanyStore;
use App\Models\Admin\Company;
use Illuminate\Support\Facades\Auth;

class SettingController extends AbstractController
{


    protected $template = 'settings';

    protected $model = Company::class;

    protected $formClass = SettingForm::class;


    public function setting()
    {
        $this->results['user'] = Auth::user();
        $this->results['tenant'] = get_tenant();
        $rows = [];
        if($this->model){

            $rows = $this->getModel()->findById(get_tenant_id());
        }

        $this->results['rows'] = $rows;

        $form = $this->formBuilder->create($this->formClass, [
            'model'=>$rows,

        ]);
        $this->results['form'] = $form;
        $form->setFormOption('model',$rows);
        $form->setFormOption('method','POST');
        $form->setFormOption('url',route('admin.settings.store'));
        return view(sprintf('admin.%s.show', $this->template), $this->results);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CompanyStore $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyStore $request)
    {

        $this->getModel()->saveBy($request->all());

        if($this->getModel()->getResultLastId()){

            notify()->success($this->getModel()->getMessage());
            return back()->with('success', $this->getModel()->getMessage());
        }
        notify()->error($this->getModel()->getMessage());
        return back()->withInput()->withErrors($this->getModel()->getMessage());
    }
}
