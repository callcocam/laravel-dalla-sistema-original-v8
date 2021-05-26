<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Models\Admin;

use App\AbstractModel;

class Download extends AbstractModel
{
    protected $fillable = [
        'user_id','category_id','name','slug','file','cover','type','size','status', 'description','views','created_at','updated_at',
    ];

}
