<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Models\Admin;


use App\AbstractModel;
use Illuminate\Support\Facades\DB;

class Lending extends AbstractModel
{
    protected $fillable = [
        'user_id','name','slug','status', 'description','updated_at',
    ];

    public function getPriceAttribute($value){
        return form_read($value);
    }

    public function sun($model){

        if(auth()->check() && auth()->user()->hasAnyRole('cliente')){
            return $model->hasMany(Movimentation::class)->where('client_id', auth()->id())->count('quantity');
        }
        else{
            return $model->hasMany(Movimentation::class)->count('quantity');
        }
    }
}
