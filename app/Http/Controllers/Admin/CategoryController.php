<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.categories.index');
    }
    public function store(CategoryRequest $request)
    {
        Category::create([
            config('app.fallback_locale') => [
                'name' => $request->validated()['name'],
            ]
        ]);
        return redirect()->route('products.index');
    }
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }
    public function create()
    {
        return view('admin.categories.create');
    }

    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->validated();

        $category->update($data);

        $category->update([
            $data['locale'] => [
                'name' => $data['name'],
            ]
        ]);
        return redirect()->route('admin.categories.show', compact('category'));
    }
}