<?php

namespace App\Http\Livewire\Product;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $minPrice;
    public $maxPrice;
    public $categories;
    public $selectedCategories;
    public function selectedCategoriesClear()
    {
        $this->selectedCategories = [];
    }
    public function mount()
    {
        $this->categories = Category::all();
    }
    public function render()
    {
        $products = Product::query();

        // Фільтр за мінімальною ціною
        if ($this->minPrice) {
            $products->where('price', '>=', $this->minPrice);
        }

        // Фільтр за максимальною ціною
        if ($this->maxPrice) {
            $products->where('price', '<=', $this->maxPrice);
        }

        if (!empty($this->selectedCategories)) {
            $products->whereHas('categories', function ($query) {
                $query->whereIn('category_id', $this->selectedCategories);
            });
        }

        $filteredProducts = $products->get();

        return view('livewire.product.index', [
            'products' => $filteredProducts,
            'categories' => $this->categories,
        ]);
    }
}