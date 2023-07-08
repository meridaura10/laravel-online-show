<?php

namespace App\Http\Livewire\Components;

use App\Models\Product;
use Livewire\Component;

class Search extends Component
{
    public $search = '';
    public function render()
    {
        $products = Product::query()
            ->whereTranslationLike('name', "%$this->search%")->with('translations', 'bannerImage', 'categories')
            ->get();

        return view('livewire.components.search', [
            'products' => $products,
            'dropdown' => $this->search ? true : false,
        ]);
    }
}