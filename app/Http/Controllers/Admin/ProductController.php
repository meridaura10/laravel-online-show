<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ProductImageDisk;
use App\Enums\ProductImageType;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $validatedData = $request->validated();

        $product = Product::create([
            config('app.fallback_locale') => [
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
            ],
            'price' => $validatedData['price'],
        ]);

        $product->categories()->attach($validatedData['categories']);

        function createImage($image, $product, $order, $type, $disk)
        {
            $image->store("/product/$product->id/");
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs($disk . '/images', $imageName);
            $product->images()->create([
                'disk' => $disk,
                'path' => $imageName,
                'order' => $order + 1,
                'type' => $type,    
            ]);
        }

        $images = $request->file('images');
        $imageOrder = $request->input('image_order');
        $imageCount = count($imageOrder);
        for ($i = 0; $i < $imageCount; $i++) {
            $image = $images[$i];
            $imageName = $image->getClientOriginalName();
            dd($imageName);
            createImage($image, $product, $i, ProductImageType::SLIDER->value, ProductImageDisk::PUBLIC ->value);
        }

        if ($request->hasFile('banner_image')) {
            $bannerImage = $request->file('banner_image');
            createImage($bannerImage, $product, 0, ProductImageType::BANNER->value, ProductImageDisk::PUBLIC ->value);
        }



        return redirect()->route('admin.products.show', $product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }


    public function update(ProductRequest $request, Product $product)
    {

        $data = $request->all();
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        $image->storeAs('public/images', $imageName);
        $product->update([
            $data['locale'] => [
                'name' => $data['name'],
                'description' => $data['description'],
            ]
        ]);
        $product->price = $data['price'];
        $product->image = $imageName;
        $product->save();

        $product->categories()->sync($data['categories']);


        return redirect()->route('admin.products.show', compact('product'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Storage::delete('public/images/' . $product->image);

        $product->delete();
        return view('admin.products.index');
    }
}