<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Models\Admin;

use App\AbstractModel;

class Score extends AbstractModel
{

    protected $table = "scores";

    protected $fillable = [
        'user_id','client_id','amount','status','created_at','updated_at'
    ];

}
