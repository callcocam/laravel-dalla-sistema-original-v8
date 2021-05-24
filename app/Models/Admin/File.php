<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Models\Admin;

use App\AbstractModel;

class File extends AbstractModel
{

    protected $fillable = [
        'company_id','user_id', 'uuid','name','fullPath','dir','fileType','ext','size','width','height','description',
    ];

    public function fileable(){

        return $this->morphTo();
    }
}
