<?php

namespace App\Http\Livewire\Products;

use App\Models\Admin\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Stoque extends Component
{
    use WithPagination;
    public $status = 'published';
    public $search;
    public $stoque;
    public function render()
    {
        return view('livewire.products.stoque',['tenant'=>get_tenant()])->layout('layouts.admin',['tenant'=>get_tenant()]);
    }

    public function update($product){

        if(isset($this->stoque[$product['id']])){
          $product =  Product::find($product['id']);
          $product->stock = $this->stoque[$product['id']];
          $product->update();
          $this->reset(['stoque']);
        }
        flash()->overlay("O estoque foi atualizado com sucesso!!", 'Ação de alterar estoque')->livewire($this);
    }
    public function getProductsProperty(){

        return Product::query()
            ->where( app('db')->raw("CONCAT_WS(' ', name,description)"),"like", "%{$this->search}%")
            ->where('status', $this->status)->paginate(10);
    }
}
