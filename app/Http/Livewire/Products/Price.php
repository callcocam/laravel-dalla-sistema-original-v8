<?php

namespace App\Http\Livewire\Products;

use App\Models\Admin\Client;
use App\Models\Admin\Price as PriceAlias;
use App\Models\Admin\Product;
use Livewire\Component;

class Price extends Component
{
    public $client;
    public $status = PriceAlias::PUBLISHD;

    public $form_data;

    public function render()
    {
        return view('livewire.products.price');
    }

    public function updatePrice()
    {
        if ($this->form_data):
            foreach ($this->form_data as $key => $value) {
                $product = PriceAlias::find($key);
                if ($product):
                    $product->price = form_w($value);
                    $product->update();
                endif;
            }
            $this->reset(['form_data']);
            flash()->overlay("O valor do produto foi atualizado com sucesso!!", 'Ação de alterar estoque')->livewire($this);
        else:
            flash()->overlay("O campo Novo valor do item atualizado deve ser preechido corretamente!!", 1)->livewire($this);
        endif;
    }

    public function getPricesProperty()
    {
        if ($this->client):
            $products = Product::query()->where('status', Product::PUBLISHD)->get();
            foreach ($products as $product):
                if (!$product->prices()->where('client_id', $this->client)->count()):
                    $product->prices()->create([
                        'user_id' => auth()->id(),
                        'client_id' => $this->client,
                        'product_id' => $product->id,
                        'price' => form_w($product->price),
                        'created_at' => today()->format('Y-m-d'),
                    ]);
                endif;
            endforeach;
            $prices = Client::find($this->client)->prices;
            if ($prices)
                return $prices;
        endif;

    }

    public function getClientsProperty()
    {
        return Client::query()->where('status', Client::PUBLISHD)->get();
    }
}
