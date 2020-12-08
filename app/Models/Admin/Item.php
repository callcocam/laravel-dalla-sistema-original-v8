<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Models\Admin;


use App\AbstractModel;
use Illuminate\Support\Facades\DB;

class Item extends AbstractModel
{
    protected $fillable = [
        'user_id','order_id','product_id','amount','price','total','status', 'description','updated_at',
    ];


    public function meta($product, $client, $order){

        return Meta::query()
            ->where('product_id',$product)
            ->where('client_id', $client
            )->whereMonth('created_at',$order->created_at->format('m'))->first();
    }

    public function countItems($product, $order){

        $data = $this->query()
            ->where('product_id',$product)
            ->whereMonth('created_at',$order->created_at->format('m'))->select( DB::raw('sum( amount ) as quantity') )
            ->first();

        if($data)
            return $data->quantity;

        return '0';
    }
    public function saveBy($data)
    {

        $product = Product::find($data['product_id']);

        if(!$product){
            $this->messages = "Falhou, não foi possivel adicionar o registro, modelo não foi encontrado!!";
            return false;
        }
        $curentItem = null;

        if(isset($data['id'])){
            //$curentItem = parent::findById($data['id']);
        }

        $data['total'] = form_w(Calcular(form_read($data['amount']), form_read($product->price), '*'));
        $data['price'] = 0;
       if ($product->price){
           $data['price'] = form_read($product->price);
       }

        $result =  parent::saveBy($data);

        if($this->getResultLastId()){

            $sum = $this->model->select( DB::raw('sum( total ) as valor') )->where('order_id',$data['order_id'])->first();

            $order = $this->model->order()->first();

            $price = $sum->valor;
            if($order){
                if($order->client){
                    if($order->client->discount){
                        $discount = Calcular(form_read($price), form_read($order->client->discount), "tj");
                        $price = form_w(Calcular(form_read($price), $discount, "-"));
                        $order->discount = form_w($discount);
                    }
                }
            }
            $order->total = $price;
            $order->price = $sum->valor;

            $order->update();

            //$this->addBonus($data,$order,$curentItem);

        }

        return $result;
    }

    public function deleteBy($model)
    {
        $result =  parent::deleteBy($model);

        if($result){

            $sum = $model->select( DB::raw('sum( total ) as valor') )->first();

            $order = $model->order()->first();

            $order->total = $sum->valor;

            $order->update();

        }

        return $result;
    }

    public function products(){

        return $this->belongsTo(Product::class,'product_id');
    }

    public function order(){

        return $this->belongsTo(Order::class);
    }

    public function orders(){

        return $this->belongsTo(Order::class);
    }
    private function addBonus($data,$order){


        $product = $this->model->products()->first();

        if(!$product)
            return $this;

        $client = $order->client()->first();

        $orders = $client->orders()->get(['id']);

        if(!$orders)
            return $this;

        $ordersId = array_values($orders->toArray());

        $sum = $this->model->select( DB::raw('sum( amount ) as total') )->whereIn('order_id',$ordersId)->where('product_id',$data['product_id'])->first();

        $bonus = $product->bonus()->orderBy('meta','DESC')->where('meta','<=', $sum->total);

        if($bonus->count()){

            $bonusCurrent = $bonus->first();

            $bonificationsAplicatios = $product->bonifications()->where([
                'product_id'=>$data['product_id'],
                'client_id'=>$order->client_id,
                'status'=>'draft'
            ]);

            $bonifications = $product->bonifications()->where([
                'product_id'=>$data['product_id'],
                'client_id'=>$order->client_id,
                'status'=>'published'
            ]);

            if($bonificationsAplicatios->count()){
                $bonificationsAplicatiosTotal = $bonificationsAplicatios->first()->amount;
            }

            $total = (int)Calcular(form_read($sum->total), $bonificationsAplicatiosTotal, '-');

            //dd($sum->total,$total,$bonificationsAplicatiosTotal,$bonusCurrent->meta);
            if($total >= $bonusCurrent->meta){
                if($bonifications->count()){
                    $currentBonification = $bonifications->first();
                    $currentBonification->amount = $total;
                    $currentBonification->bonu_id = $bonusCurrent->id;
                    $currentBonification->update();
                    return $this;
                }

                $bonifications->getRelated()->saveBy([
                    'amount'=>$total,
                    'product_id'=>$data['product_id'],
                    'bonu_id'=>$bonusCurrent->id,
                    'client_id'=>$order->client_id,
                ]);
            }
            return $this;
        }
        return $this;
    }
}
