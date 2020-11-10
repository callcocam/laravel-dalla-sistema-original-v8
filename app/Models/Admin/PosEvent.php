<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Models\Admin;


use App\AbstractModel;

class PosEvent extends AbstractModel
{
    protected $fillable = [
        'user_id','event_id','customer_service', 'draft_beer_quality','event_structure','amount_beer_consumed',
        'make_new_event','team_uniform','status', 'pos_description','updated_at',
    ];


    protected $casts = [
        'updated_at'=>'date:d-m-Y'
    ];


}
