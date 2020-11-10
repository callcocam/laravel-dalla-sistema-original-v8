<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Models\Admin;


use App\AbstractModel;

class Task extends AbstractModel
{
    protected $fillable = [
        'user_id','name','slug','status', 'description','updated_at',
    ];



    public function task(){

        return $this->belongsTo(EventTask::class);
    }


    public function getTaskAttribute(){

        return $this->task();
    }

}
