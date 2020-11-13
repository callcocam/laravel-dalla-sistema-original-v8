<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Http\Controllers\Admin;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AdminController extends AbstractController
{



    public function passportClients()
    {

        if (Gate::denies('passport.passport-clients')){
            abort(401, 'Not authorized');
        }
        $this->results['user'] = Auth::user();
        $this->results['tenant'] = get_tenant();
        return view('admin.passport.passport-clients.index', $this->results);
    }


    public function passportAuthorizedClients()
    {
        if (Gate::denies('passport-authorized-clients')){
            abort(401, 'Not authorized');
        }
        $this->results['user'] = Auth::user();
        $this->results['tenant'] = get_tenant();
        return view('admin.passport.passport-authorized-clients.index', $this->results);
    }

    public function passportPersonalAccessTokens()
    {
        if (Gate::denies('passport-personal-access-tokens')){
            abort(401, 'Not authorized');
        }
        $this->results['user'] = Auth::user();
        $this->results['tenant'] = get_tenant();
        return view('admin.passport.passport-personal-access-tokens.index', $this->results);
    }

}
