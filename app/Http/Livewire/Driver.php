<?php

namespace App\Http\Livewire;

use App\Models\Admin\Order;
use Livewire\Component;
use Livewire\WithPagination;

class Driver extends Component
{
    use WithPagination;


    public $selectedRow;

    public function render()
    {
        $rows = Order::query()->whereIn('status', ['preparing', 'transit'])->paginate();

        return view('livewire.driver', compact('rows'));
    }

    public function confirmed(Order $row)
    {
        $this->selectedRow = $row;
    }

    public function update()
    {
        if ($this->selectedRow->status == 'preparing')
            $this->selectedRow->update(['status' => 'transit']);
        elseif ($this->selectedRow->status == 'transit')
            $this->selectedRow->update(['status' => 'completed']);

        $this->selectedRow = null;
        // flash('Message 2')->warning()->livewire($this);
        flash()->overlay("O registro foi atualizado com sucesso!!", 'Ação de alterar status')->livewire($this);
        //$row->save();
    }
}
