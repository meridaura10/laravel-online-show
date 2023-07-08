<?php

namespace App\Services;

use App\Contracts\BasketInterface;
use App\Models\Basket;
use App\Models\BasketProduct;

class BasketService implements BasketInterface
{

    public function sum()
    {
        return $this->getItems()->sum('sum');
    }

    public function updateItem(BasketProduct $product, $count = 1)
    {
        $product->update([
            'quantity' => $count,
        ]);
    }

    public function getItems()
    {
        return $this->getBasket()->basketProducts;
    }

    public function createBasket()
    {
       return Basket::create([
            'user_id'=> auth()->user()->id,
            'total'=>0,
        ]);
    }

    public function getBasket()
    {
        if (auth()->user()->basket){
            return auth()->user()->basket;
        }else{
            return $this->createBasket();
        }
    }
}
