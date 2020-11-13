<?php

namespace App\Listeners;

use App\Events\VisitorEvent;
use App\Http\Requests\VisitsDistributorStore;
use App\Suports\Common\Options;
use Illuminate\Support\Facades\Auth;

class VisitorListener
{
    /**
     * @var $visitsDistributorStore
     */
    private $visitsDistributorStore;

    /**
     * Create the event listener.
     *
     * @param VisitsDistributorStore $visitsDistributorStore
     */
    public function __construct(VisitsDistributorStore $visitsDistributorStore)
    {
        //
        $this->visitsDistributorStore = $visitsDistributorStore;
    }

    /**
     * Handle the event.
     *
     * @param VisitorEvent $event
     * @return bool
     */
    public function handle(VisitorEvent $event)
    {
        $event = $event->event;



        if(!$this->visitsDistributorStore->all()){

            return true;

        }

        $beers_scores = $this->visitsDistributorStore->all();

        foreach ($beers_scores as $key => $score) {

            if(!in_array($key, [Options::DEFAULT_COLUMN_FILE])){

                if(is_array($score)){

                    try{
                        $data['user_id'] = Auth::id();
                        $data['visits_distributor_id'] = $event->id;
                        $data['name'] = isset($score['name'])?$score['name']:null;
                        $data['visits'] = isset($score['visits'])?$score['visits']:null;
                        $data['assets'] = $key;
                        $data['date_option'] = isset($score['date_option'])?date_carbom_format($score['date_option'])->format('Y-m-d'):null;
                        $data['selected'] = isset($score['selected'])?$score['selected']:null;
                        $data['description'] = $score['description'];
                        $data['status'] = 'published';
                        $data['updated_at'] = date("Y-m-d");

                        $scoreExist = $event->beers_scores()->where('assets', $key)->first();

                        if($scoreExist){

                            $data['id'] = $scoreExist->id;

                        }

                        $event->beers_scores()->getRelated()->saveBy($data);

                    }catch (\Exception $exception){

                    }
                }


            }
        }

    }
}
