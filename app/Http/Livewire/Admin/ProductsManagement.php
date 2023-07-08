<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsManagement extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $selectedProducts = [];
    public $selectedCategories = [];
    public $limit = 10;

    public $categories;
    public $sortBy = 'id';
    public $sortDirection = 'asc';

    public $isSelectAll = false;

    protected $products;

    public function changeSortDirection()
    {
        $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function selectAll()
    {
      dd('all');
    }


    public function sort($column)
    {
        if ($this->sortBy === $column) {
            $this->changeSortDirection();
        } else {
            $this->sortDirection = 'asc';
            $this->sortBy = $column;
        }
        $this->getProducts();
    }

    public function search()
    {
        return Product::where('name', 'like', '%' . $this->search . '%')->paginate($this->limit);
    }

    public function getProducts()
    {
        $this->products = $this->search ? $this->search() : Product::orderBy($this->sortBy, $this->sortDirection)->paginate($this->limit);
    }

    public function deleteSelectedProducts()
    {
        foreach ($this->selectedProducts as $product) {
            $product->delete();
        }
    }

    public function render()
    {
        $this->getProducts();
        return view('livewire.admin.products-management', [
            'products' => $this->products,
            'categories' => $this->categories,
            'sortDirection' => $this->sortDirection,
            'selectedProducts' => $this->selectedProducts,
            'selectedCategories' => $this->selectedCategories,
        ]);
    }
}
