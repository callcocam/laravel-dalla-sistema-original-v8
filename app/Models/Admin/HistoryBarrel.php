<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Models\Admin;


use App\AbstractModel;

class HistoryBarrel extends AbstractModel
{
    protected $fillable = [
        'user_id','client_id','type','quantity','status', 'description','updated_at',
    ];


    protected $casts = [
        'created_at'=>'date:d-m-Y','updated_at'=>'date:d-m-Y'
    ];


    public function client(){

        return $this->belongsTo(Client::class,'client_id');
    }

}
