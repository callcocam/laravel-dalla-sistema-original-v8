<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Models\Admin;


use App\AbstractModel;

class EventNext extends AbstractModel
{

    protected $table ="events";

    protected $showColumnOrder = "start_event";
    protected $showOrderDirection = "ASC";

    protected $fillable = [
        'user_id','name','slug','client_id','contractor','observations','local','chopp_price','distance',
        'trucks','truck_driver','team','departure_date_and_time',
        'arrival_date_and_time','start_time_event','pre_checklist',
        'general_observations','start_event','end_event', 'consumption','status', 'description','updated_at',
    ];


    protected $dates = [
        'start_event','end_event','updated_at'
    ];

    protected $casts = [
        'start_event'=>'date:d-m-Y','end_event'=>'datetime:d-m-Y','updated_at'=>'date:d-m-Y'
    ];

    public function saveBy($data)
    {
        $result =  parent::saveBy($data);

        if ($this->getResultLastId()){

            if(isset($data['info'])){

                $info = $data['info'];

                 if($this->getModel()->event_info()->first()){

                    $info['id'] = $this->getModel()->event_info()->first()->id;
                }

                $info['event_id'] = $this->getResultLastId();
                $info['status'] = 'published';
                $info['updated_at'] = date("Y-m-d");

                $this->getModel()->event_info()->getRelated()->saveBy($info);
            }
        }

        return  $result;
    }

    public function client(){

        return $this->belongsTo(Client::class);
    }

    public function event_info(){

        return $this->hasOne(EventsInfo::class,'event_id');
    }


    public function pos_event(){

        return $this->hasOne(PosEvent::class,'event_id');
    }

    public function task(){

        return $this->hasMany(EventTask::class,'event_id');
    }


    public function pos_eventJson(){

        return json_encode($this->hasOne(PosEvent::class,'event_id')->first([
            'id','event_id','customer_service', 'draft_beer_quality','event_structure','amount_beer_consumed',
            'make_new_event','team_uniform','status', 'pos_description','updated_at'
        ])->toArray());
    }



    public function getInfoAttribute(){

        return $this->hasOne(EventsInfo::class, 'event_id')->first(['important']);
    }


}
