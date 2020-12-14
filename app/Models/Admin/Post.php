<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Models\Admin;

use App\AbstractModel;

class Post extends AbstractModel
{
    protected $fillable = [
        'user_id','name','slug','status', 'description','published_up','published_down','views','created_at','updated_at',
    ];

}
