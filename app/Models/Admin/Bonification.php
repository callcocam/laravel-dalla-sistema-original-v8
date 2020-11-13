<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Models\Admin;


use App\AbstractModel;
use Illuminate\Support\Facades\DB;

class Bonification extends AbstractModel
{
    protected $fillable = [
        'user_id','client_id','product_id','bonu_id','amount','status', 'description','updated_at',
    ];

    public function product(){

        return $this->hasOne(Product::class);
    }

    public function bonusId($Bonification){
        $bonus = Bonu::find($Bonification->bonu_id);
        return $bonus;
    }

    public function client(){

        return $this->hasOne(Client::class, 'client_id');
    }

    public function countItems($where){

        $data = $this->where($where)->select( DB::raw('sum( amount ) as quantity') )->first();

        if($data)
            return $data->quantity;

        return '0';
    }
}
