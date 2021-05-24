<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Models\Admin;

use App\AbstractModel;

class Addres extends AbstractModel
{

    protected $table = "address";

    protected $fillable = [
        'user_id','name','slug','zip','city','state','country', 'street','district','number','complement','created_at','updated_at'
    ];

    public function addresable(){

        return $this->morphTo();
    }


}
