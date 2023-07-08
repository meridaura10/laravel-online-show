<?php

namespace App\Contracts;

interface BasketInterface {
    public function sum();

    public function createBasket();
    public function getBasket();

    public function getItems();
}
