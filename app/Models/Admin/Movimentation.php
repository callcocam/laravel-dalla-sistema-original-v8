<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Models\Admin;


use App\AbstractModel;
use Illuminate\Support\Facades\DB;

class Movimentation extends AbstractModel
{
    protected $fillable = [
        'user_id','lending_id','client_id','quantity','type','status', 'description','updated_at',
    ];

    public function lending(){

        return $this->belongsTo(Lending::class);
    }

    public function client(){

        return $this->belongsTo(Client::class, 'client_id');
    }

}
