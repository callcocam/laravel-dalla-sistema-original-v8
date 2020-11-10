<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Models\Admin;


use App\AbstractModel;
use Illuminate\Support\Facades\DB;

class Company extends AbstractModel
{
    protected $fillable = [
        'user_id','name', 'email', 'phone', 'document','updated_at',
    ];

    public function address(){

        return $this->morphOne(Addres::class, 'addresable');
    }

    public function orders($status='open'){

        if(auth()->user()->hasAnyRole('cliente')){
            return $this->hasMany(Order::class)->latest()->where('status',$status)->where('client_id', auth()->id())->limit(5)->get();
        }
        return $this->hasMany(Order::class)->where('status',$status)->limit(5)->get();
    }

    public function counts($table){
        if(auth()->user()->hasAnyRole('cliente')){
            return DB::table($table)->whereNull('deleted_at')->where('client_id', auth()->id())->count();
        }
        return DB::table($table)->whereNull('deleted_at')->count();
    }
}
