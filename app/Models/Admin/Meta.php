<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Models\Admin;


use App\AbstractModel;
use Illuminate\Support\Facades\DB;

class Meta extends AbstractModel
{
    protected $fillable = [
        'user_id','client_id','meta','status','created_at','updated_at',
    ];

    public function client(){

        return $this->belongsTo(Client::class);
    }

    public function countItems($order){

        $data = $this->product()->items()->whereMonth('created_at',$order->created_at->format('m'))->select( DB::raw('sum( amount ) as quantity') )->first();

        if($data)
            return $data->quantity;

        return '0';
    }
}
