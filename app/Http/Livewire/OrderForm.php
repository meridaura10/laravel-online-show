<?php

namespace App\Http\Livewire;

use App\Enums\OrderPaySystemEnum;
use App\Models\City;
use App\Models\CityWarehouse;
use App\Services\OrderService;
use Livewire\Component;

class OrderForm extends Component
{
    protected $listeners = ['setCity' => 'setSelectedCity', 'setWerehouse' => 'setSelectedWerehouse'];
    public $paymentMethod;
    public $city;

    public $products;
    public $werehouse;

    public function setSelectedCity(City $city)
    {
        $this->city = $city;
    }
    protected function rules(){
        return [
            'paymentMethod' => ['required','string','in:card,cash'],
            'city' => ['required'],
            'werehouse' => ['required'],
        ];
    }
    public function setSelectedWerehouse(CityWarehouse $werehouse)
    {
        $this->werehouse = $werehouse;
    }

    public function submitOrder(OrderService $service)
    {
       $data =  $this->validate();
        $order = $service->createOrder($this->city, $this->werehouse);

        switch ($data['paymentMethod']) {
            case OrderPaySystemEnum::Card->value:
                $url = $service->cardPay($order);
                return redirect($url);
                break;
            case OrderPaySystemEnum::Cash->value:
                $payment = $service->cashPay($order);
                if ($payment){
                  return redirect()->route('orders.show', ['order' => $order]);
                }
                break;
        }
    }

    public function render()
    {
        return view('livewire.order-form');
    }
}
