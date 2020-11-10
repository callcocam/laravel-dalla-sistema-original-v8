<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Models\Admin;


use App\AbstractModel;

class BeersScore extends AbstractModel
{
    protected $fillable = [
        'user_id','visits_distributor_id','name','visits','assets','selected','date_option','status', 'description','updated_at',
    ];


    protected $dates = [
        'date_option','updated_at'
    ];

    protected $casts = [
        'date_visit'=>'date:d-m-Y','updated_at'=>'date:d-m-Y'
    ];



}
