<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Models\Admin;


use App\AbstractModel;

class EventTask extends AbstractModel
{
    protected $fillable = [
        'user_id','updated_by','task_id','event_id','name','date_limit','description','observations','status','updated_at',
    ];


    protected $casts = [
        'updated_at'=>'date:d-m-Y'
    ];

    public function task(){

        return $this->belongsTo(Task::class);
    }

}
