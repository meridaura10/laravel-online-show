<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\CityWarehouse;
use Livewire\Component;

class NovaPoshta extends Component
{
    public $searchCity = '';

    public $selectedCity;
    public $cities = [];
    public $searchWerehouse = '';
    public $selectedWerehouse;
    public $werehouses = [];


    public function searchCity()
    {
        $this->cities = City::whereRaw('LOWER(name) LIKE ?', '%' . strtolower($this->searchCity) . '%')
            ->take(15)
            ->get();
    }

    public function selectCity($cityId)
    {
        $this->selectedCity = City::find($cityId);
        $this->werehouses = $this->selectedCity->warehouses()->take(20)->get();
        $this->searchCity = '';
        $this->emit('setCity',$this->selectedCity);
    }

    public function searchWerehouse()
    {
        $this->werehouses = $this->selectedCity->warehouses()->whereRaw('LOWER(address) LIKE ?', '%' . strtolower($this->searchWerehouse) . '%')
            ->take(15)
            ->get();
    }

    public function selectWerehouse($werehouseId)
    {
        $this->selectedWerehouse = CityWarehouse::find($werehouseId);
        $this->werehouses = [];
        $this->searchWerehouse = '';
        $this->emit('setWerehouse',$this->selectedWerehouse);
    }

    public function render()
    {
        return view('livewire.nova-poshta', [
            'searchCity' => $this->searchCity,
            'searchWerehouse' => $this->searchWerehouse,
            'cities' => $this->cities,
            'selectedCity' => $this->selectedCity,
            'selectedWerehouse' => $this->selectedWerehouse,
            'werehouses' => $this->werehouses,
        ]);
    }
}
