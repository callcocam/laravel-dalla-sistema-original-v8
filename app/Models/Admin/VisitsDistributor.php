<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Models\Admin;


use App\AbstractModel;

class VisitsDistributor extends AbstractModel
{
    protected $fillable = [
        'user_id',
        'client_id',
        'resbonsible',
        'date_visit',
        'quantity_of_distributor_draft_beer',
        'quantity_of_matriz_draft_beer',
        'number_of_distributor_barrels',
        'number_of_matriz_barrels',
        'cities_serving_region','meet_each_city',
        'disclose_and_increase_sales','date_works',
        'comparative_privious_year',
        'considerations_beer',
        'considerations_distributor',
        'considerations_beer',
        'status',
        'description',
        'updated_at',
    ];


    protected $dates = [
        'date_visit','updated_at'
    ];

    protected $casts = [
        'date_visit'=>'date:d-m-Y','updated_at'=>'date:d-m-Y'
    ];

    protected $question;

    public function beers_scores(){

        return $this->hasMany(BeersScore::class);
    }
    public function client(){

        return $this->belongsTo(Client::class,'client_id');
    }

    public function beers_score($question){

        return $this->hasMany(BeersScore::class)->where('assets', $question)->first(['visits_distributor_id','name','visits','assets','selected','date_option', 'description']);
    }

    public function setQuestion($question){

        $this->question =$question;

        return $this;
    }

    public function getQuestion01Attribute()
    {

        return $this->beers_score($this->question);
    }

    public function getQuestion02Attribute()
    {

        return $this->beers_score($this->question);
    }


    public function getQuestion03Attribute()
    {

        return $this->beers_score($this->question);
    }


    public function getQuestion04Attribute()
    {

        return $this->beers_score($this->question);
    }


    public function getQuestion05Attribute()
    {

        return $this->beers_score($this->question);
    }


    public function getQuestion06Attribute()
    {

        return $this->beers_score($this->question);
    }


    public function getQuestion07Attribute()
    {

        return $this->beers_score($this->question);
    }


    public function getQuestion08Attribute()
    {

        return $this->beers_score($this->question);
    }


    public function getQuestion09Attribute()
    {

        return $this->beers_score($this->question);
    }


    public function getQuestion10Attribute()
    {

        return $this->beers_score($this->question);
    }


    public function getQuestion11Attribute()
    {

        return $this->beers_score($this->question);
    }


    public function getQuestion12Attribute()
    {

        return $this->beers_score($this->question);
    }


    public function getQuestion13Attribute()
    {

        return $this->beers_score($this->question);
    }


    public function getQuestion14Attribute()
    {

        return $this->beers_score($this->question);
    }

    public function getQuestion15Attribute()
    {

        return $this->beers_score($this->question);
    }


    public function getQuestion16Attribute()
    {

        return $this->beers_score($this->question);
    }


    public function getQuestion17Attribute()
    {

        return $this->beers_score($this->question);
    }


    public function getQuestion18Attribute()
    {

        return $this->beers_score($this->question);
    }


    public function getQuestion19Attribute()
    {

        return $this->beers_score($this->question);
    }


    public function getQuestion20Attribute()
    {

        return $this->beers_score($this->question);
    }

    public function getScore01Attribute()
    {

        return $this->beers_score($this->question);
    }

    public function getScore02Attribute()
    {

        return $this->beers_score($this->question);
    }

    public function getScore03Attribute()
    {

        return $this->beers_score($this->question);
    }
}
