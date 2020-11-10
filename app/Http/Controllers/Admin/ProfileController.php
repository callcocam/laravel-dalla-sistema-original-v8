<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Http\Controllers\Admin;


use App\Forms\ProfileForm;
use App\Http\Requests\ProfileStore;
use App\Models\Admin\Client;
use App\Models\Admin\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends AbstractController
{

    protected $template = "profile";

    protected $model = User::class;

    // protected $rules = ProfileRequest::class;

    public function profile()
    {

        if(Auth::user()->hasAnyRole('cliente')){

            $this->model = Client::class;
        }

        $this->results['user'] = Auth::user();
        $this->results['tenant'] = get_tenant();
        $rows = [];
        if($this->model){

            $rows = $this->getModel()->findById(Auth::id());
        }
        if(!$rows)
            return back()->with('error', "Usuário não encontrado!!");

        $this->results['rows'] = $rows;

        $form = $this->formBuilder->create(ProfileForm::class, [
            'model'=>$rows,

        ]);

        $form->setFormOption('model',$rows);
        $form->setFormOption('method','POST');
        $form->setFormOption('url',route('admin.auth.profile'));
        $this->results['form'] = $form;
        return view(sprintf('admin.%s.show', $this->template), $this->results);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProfileStore $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileStore $request)
    {

        if(Auth::user()->hasAnyRole('cliente')){

            $this->model = Client::class;
        }

        $this->getModel()->saveBy($request->all());

        if($this->getModel()->getResultLastId()){

            notify()->success($this->getModel()->getMessage());
            return back()->with('success', $this->getModel()->getMessage());
         }
        notify()->error($this->getModel()->getMessage());
        return back()->withInput()->withErrors($this->getModel()->getMessage());
    }

}
