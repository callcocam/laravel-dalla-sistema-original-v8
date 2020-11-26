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

    public function sun($model,$user, $type="in"){

        $sum = DB::table('movimentations')
            ->select( DB::raw('SUM(quantity) as total'))
            ->where('client_id',$user)
            ->where('type',$type)
            ->where('lending_id',$model->id)
            ->first();

        return $sum->total;
    }
}
