<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Models\Admin;
use App\AbstractModel;
use App\Suports\Shinobi\Concerns\HasRolesAndPermissions;

class User extends AbstractModel
{
 use HasRolesAndPermissions;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','slug', 'email','phone','document', 'status', 'password', 'is_admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','email_verified_at'
    ];

    public function address(){

        return $this->morphOne(Addres::class, 'addresable');
    }


    public function orders(){

        return $this->hasMany(Order::class);
    }

    public function getAddressAttribute(){

        return $this->address()->first(['zip','city','state','country', 'street','district','number','complement']);
    }

    public function lendings(){

        return Lending::query()->whereIn('id',auth()->user()->moviments()->pluck('lending_id')->unique()->toArray())->get();
    }

    public function moviments(){
        if(auth()->check() && auth()->user()->hasAnyRole('cliente')){
            return $this->hasMany(Movimentation::class,'client_id')->get();
        }
        else{
            return Movimentation::query()->get();
        }

    }
    public function movimentsAll(){
         return Movimentation::query()->orderByDesc('created_at')->get();
    }

    public function score(){

          return $this->hasMany(Score::class, 'client_id')->first();
    }
}
