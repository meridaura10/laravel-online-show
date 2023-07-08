<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;

class CategoriesManagement extends Component
{
    public $categories = [];
    public function mount()
    {
        $this->categories = Category::all();
    }
    public function deleteCategory(Category $category)
    {
        $category->delete();
        $this->categories = Category::all();
    }
    
    public function render()
    {
        
        return view('livewire.admin.categories-management', [
            'categories' => $this->categories,
        ]);
    }
}