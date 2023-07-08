<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\BasketProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function App\Helpers\basket;

class BasketController extends Controller
{

    public function index()
    {
        return view('user.basket.index');
    }

    public function addToBasket(Request $request)
    {
        $basket = basket()->getBasket();
        $product = json_decode($request->input('product'));
        $quantity = $request->input('quantity');

        $basketProduct = $basket->BasketProducts()->whereProductId($product->id)->first();

        if ($basketProduct) {
            $basketProduct->increment('quantity', $quantity);
            $basketProduct->total = $basketProduct->product->price * $quantity;
        } else {
            $basketProduct = $basket->BasketProducts()->create([
                'product_id' => $product->id,
                'quantity' => $quantity,
                'total' => $product->price * $quantity,
            ]);
        }

        return redirect()->route('basket.index');
    }
}
