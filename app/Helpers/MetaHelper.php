<?php


namespace App\Helpers;


use App\Models\Admin\Item;
use App\Models\Admin\Meta;
use Illuminate\Support\Facades\DB;

class MetaHelper
{

    public static function make($client,$currentDate){

        if(!$client)
            return;

        if ($orders = $client->orders()->whereMonth('created_at', $currentDate)->get()):
            $products = [];
            foreach ($orders as $order):
                foreach ($order->items as $item):
                    $products[$item->product_id] = $item->product_id;
                endforeach;
            endforeach;
            if ($products):
                $count = Item::query()->whereIn('product_id',array_values($products))
                    ->whereMonth('created_at',$currentDate)->select( DB::raw('sum( amount ) as quantity') )
                    ->first();
                if ($meta = $client->meta($currentDate)) {
                    $meta->meta = $count->quantity ?? 0;
                    $meta->save();
                } else {
                    Meta::create([
                        'user_id' => auth()->id(),
                        'client_id' => $client->id,
                        'meta' => $count->quantity ?? 0,
                        'status' => 'published',
                        'create_at' => today()->format('y-m-d'),
                        'updated_at' => today()->format('y-m-d'),
                    ]);
                }
            endif;
        endif;
    }
}
