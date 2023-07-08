<?php

namespace App\Http\Livewire\Admin\Products;

use App\Enums\ProductImageDisk;
use App\Enums\ProductImageType;
use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;
    public $price;
    public $categories;
    public $selectedCategories;
    public $images;
    public $bannerImage;
    public $multilangsData;


    public $langs;

    public $activeTab = 'en';
    public function mount()
    {
        $this->langs = localization()->getSupportedLocales();
        $this->categories = Category::all();

    }
    public function rules()
    {
        $rules = [
            'selectedCategories' => 'required|array',
            'selectedCategories.*' => 'exists:categories,id',
            'images' => 'required',
            'price' => 'required|numeric',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'bannerImage' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
        foreach ($this->langs as $index => $language) {
            if ($index === config('app.fallback_locale')) {
                $rules["multilangsData.{$index}.name"] = 'required|string';
                $rules["multilangsData.{$index}.description"] = 'required|string';
            } else {
                $rules["multilangsData.{$index}.name"] = 'string';
                $rules["multilangsData.{$index}.description"] = 'string';
            }
        }
        return $rules;
    }
    public function updateOrCreate()
    {
        $app = $this->validate();

        $product = Product::create([
            ...$this->multilangsData,
            'price' => $this->price,
        ]);

        $product->categories()->attach($this->selectedCategories);

        function createImage($image, $product, $order, $type, $disk)
        {
            $imageName = uniqid() . '.' . $type . '.' . $image->getClientOriginalExtension();
            $image->storeAs($disk . '/images', $imageName);
            $product->images()->create([
                'disk' => $disk,
                'path' => $imageName,
                'order' => $order + 1,
                'type' => $type,
            ]);
        }

        for ($i = 0; $i < count($this->images); $i++) {
            $image = $this->images[$i];
            createImage($image, $product, $i, ProductImageType::SLIDER->value, ProductImageDisk::PUBLIC ->value);
        }




        createImage($this->bannerImage, $product, 0, ProductImageType::BANNER->value, ProductImageDisk::PUBLIC ->value);



        return redirect()->route('admin.products.show', $product);
    }
    public function changeTab($tab)
    {
        $this->activeTab = $tab;
    }
    public function reorder($list)
    {
        $newImages = [];
        foreach ($list as $index => $photoName) {
            foreach ($this->images as $image) {
                if ($image->getClientOriginalName() === $photoName['value']) {
                    $newImages[] = $image;
                    break;
                }
            }
        }
        if (count($newImages) === count($this->images)) {
            $this->images = $newImages;
        }
    }
    public function render()
    {
        return view('livewire.admin.product.form', [
            'categories' => $this->categories,
            'activeTab' => $this->activeTab,
            'langs' => $this->langs,
            'images' => $this->images,
            'multilangsData' => $this->multilangsData,
            'price' => $this->price,
        ]);
    }
}