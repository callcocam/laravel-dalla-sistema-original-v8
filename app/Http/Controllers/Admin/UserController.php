<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Http\Controllers\Admin;

use App\Forms\UserForm;
use App\Http\Requests\UserStore;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends AbstractController
{

   protected $template = 'users';

   protected $model = User::class;

   protected $formClass = UserForm::class;

    public function index()
    {
        $this->getSource()->where('is_admin','1');

        return parent::index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserStore $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStore $request)
    {


        return $this->save($request);
    }
}
