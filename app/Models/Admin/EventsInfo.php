<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Models\Admin;


use App\AbstractModel;

class EventsInfo extends AbstractModel
{
    protected $fillable = [
        'user_id','event_id','status', 'important','updated_at',
    ];


    protected $casts = [
        'updated_at'=>'date:d-m-Y'
    ];


}
