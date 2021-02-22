<?php

namespace App\Http\Livewire\Orders;

use App\Helpers\MetaHelper;
use App\Models\Admin\Item;
use App\Models\Admin\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Items extends Component
{
    public $rows;
    public $current_item;
    public $current;
    public $product_id;
    public $amount;
    public $item;
    protected $model;
    protected $listeners = ['clear'];

    public function mount($rows)
    {
        $this->rows = $rows;
    }
    public function clear()
    {
     //  $this->current_item = null;
      //flash()->dismissable(false)->livewire($this);
    }

    public function render()
    {
        return view('livewire.orders.items');
    }


    public function store()
    {
        // It will automatically use current request, get the rules, and do the validation

        $this->getModel()->saveBy([
            'order_id' => $this->rows->id,
            'product_id' => $this->product_id,
            'amount' => $this->amount,
            'created_at' => today()->format('Y-m-d'),
            'updated_at' => today()->format('Y-m-d'),
        ],$this->rows);
        $this->success($this->getModel());

    }

    public function update($item)
    {
        if ($this->current):
            foreach ($this->current as $key => $value):
                if ($item['id'] == $key):
                    $this->getModel()->saveBy(array_merge($item, $value),$this->rows);
                endif;
            endforeach;
            $this->success($this->getModel());
        endif;
    }

    public function confirm($current_item)
    {
        $this->current_item = $current_item;
         $this->emit('clear');

    }

    public function kill($item)
    {
        $model = $this->getModel()->findById($item);
        $this->getModel()->deleteBy($model);
        flash()->overlay($model->getMessage())->overlay($this);
        $this->rows = $model->order;
    }

    protected function success($model)
    {

        if ($model->getResultLastId()) {
            $order = $model->getModel()->order;
            MetaHelper::make($order->client, $order->created_at);
            flash()->overlay($model->getMessage())->livewire($this);
            $this->rows = $order;
            $this->reset(['amount', 'product_id', 'current']);
        } else {
            flash()->overlay($model->getMessage())->livewire($this);
        }
        $this->emit('clear');
    }

    protected function getModel()
    {
        if (is_null($this->model)) {

            $this->model = new Item();
        }

        return $this->model;
    }

    public function getProductsProperty()
    {

        return Product::query()->where('stock', '>', '0')->get(['id', 'name']);
    }

    public function getUserProperty()
    {

        return Auth::user();
    }

    public function getCurrentsProperty()
    {
        $currents = [];

        if ($this->current) {
            foreach ($this->current as $key => $value):
                if ($value['amount'] > 0):
                    $currents[$key] = $value;
                endif;
            endforeach;
        }
        return array_filter($currents);
    }

    public function getTenantProperty()
    {

        return get_tenant();
    }

    public function getItemsProperty()
    {

        $items = $this->rows->items;
//        foreach ($items as $item){
//            $this->item[$item->id] = $item;
//        }
        return $items;
    }
}
