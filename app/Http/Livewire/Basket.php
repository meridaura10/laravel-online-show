<?php

namespace App\Http\Livewire;

use App\Services\BasketService;
use Livewire\Component;

class Basket extends Component
{

    protected $listeners = ['refreshParentComponent' => '$refresh'];

    public function refresh()
    {
        $this->emit('cart-refresh');
    }

    public function render()
    {
        return view('livewire.basket');
    }
}
