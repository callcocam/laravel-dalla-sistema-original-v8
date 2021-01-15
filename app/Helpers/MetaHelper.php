<?php


namespace App\Helpers;


use App\Models\Admin\Item;
use App\Models\Admin\Meta;
use App\Models\Admin\Score;
use Illuminate\Support\Facades\DB;

class MetaHelper
{

    public static function make($client, $currentDate)
    {

        if (!$client)
            return;

        $orders = $client->orders()->whereMonth('created_at', $currentDate->format('m'))->get();

        if ($orders):
            $products = [];
            foreach ($orders as $order):
                foreach ($order->items as $item):
                    $products[$item->product_id] = $item->product_id;
                endforeach;
            endforeach;

            if ($products):
                $count = Item::query()->whereIn('product_id', array_values($products))
                    ->whereMonth('created_at', $currentDate)->select(DB::raw('sum( amount ) as quantity'))
                    ->first();
                $meta = $client->meta($currentDate->format('m'));

                if ($meta) {
                    $meta->meta = $count->quantity ?? 0;
                    $meta->save();
                } else {
                    Meta::create([
                        'user_id' => auth()->id(),
                        'client_id' => $client->id,
                        'meta' => $count->quantity ?? 0,
                        'status' => 'published',
                        'created_at' => $currentDate->format('y-m-d'),
                        'updated_at' => today()->format('y-m-d'),
                    ]);
                }
            endif;
        endif;
    }


    public static function score($client)
    {

        if (!$client)
            return;
        //pega todas os ids das ordens do client
        $orders = $client->orders()->pluck('id')->toArray();
        if ($orders):
            //pega todos os items das ordems relacionada ao client
            $sum = Item::query()->whereIn('order_id', array_values($orders))->select(DB::raw('sum( total ) as result'))
                ->first();
           //veja se ele ja tem um score
            $score = $client->score();
            //veja se o sistema de pontos ta ativo, se não tivaer cadastrar eles na configuração
            if (get_tenant()->pontos):
                if ($score && $sum->result && $sum->result >= get_tenant()->pontos['score_meta']) {
                    $sum = Calcular(form_read($sum->result), get_tenant()->pontos['score_meta'], '/');
                    $score->amount = form_w(Calcular($sum, get_tenant()->pontos['score_amount'], '*'));
                    $score->save();
                } else {
                    if ($sum->result && $sum->result >= get_tenant()->pontos['score_meta']) {
                        $sum = Calcular(form_read($sum->result), get_tenant()->pontos['score_meta'], '/');
                        Score::create([
                            'user_id' => auth()->id(),
                            'client_id' => $client->id,
                            'amount' => form_w(Calcular($sum, get_tenant()->pontos['score_amount'], '*')),
                            'status' => 'published',
                            'create_at' => today()->format('y-m-d'),
                            'updated_at' => today()->format('y-m-d'),
                        ]);
                    }
                }
            endif;
        endif;
    }
}
