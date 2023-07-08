<?php

namespace App\Services;

use App\Models\City;
use App\Models\CityWarehouse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NovaPoshtaService
{
    public function updateOrCreateCities($cities)
    {
        foreach ($cities as $city) {
            City::updateOrCreate(
                ['ref' => $city['Ref']],
                ['name' => $city['Description']]
            );
        }
    }

    public function getCities($page, $limit)
    {
        try {
            $requestPayload = [
                "modelName" => "Address",
                "calledMethod" => "getCities",
                "methodProperties" => [
                    "Page" => "$page",
                    "Warehouse" => "1",
                    "Limit" => $limit
                ]
            ];
            $response = Http::withBody(json_encode($requestPayload), 'application/json')
                ->get('https://api.novaposhta.ua/v2.0/json/Address/getCities')->json();
            $this->updateOrCreateCities($response['data']);
            if (!empty($response['errors'])) {
                return false;
            }

            if (empty($response['data'])) {
                return false;
            }
            return $response;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function getWareHouses($page, $limit)
    {
        try {
            $requestPayload = [
                "modelName" => "Address",
                "calledMethod" => "getWarehouses",
                "methodProperties" => [
                    "Page" => "$page",
                    "Limit" => $limit,
                    "Language" => "UA"
                ]
            ];
            $response = Http::withBody(json_encode($requestPayload), 'application/json')
                ->get('https://api.novaposhta.ua/v2.0/json/Address/getWarehouses')->json();
            if (!empty($response['errors'])) {
                return false;
            }

            if (empty($response['data'])) {
                return false;
            }

            return $response;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function updateOrCreateWareHouses($wareHouses)
    {
        foreach ($wareHouses as $wareHouse) {
            CityWarehouse::updateOrCreate([
                'address' => $wareHouse['Description'],
                'city_ref' => $wareHouse['CityRef'],
                'number' => $wareHouse['Number']
            ]);
        }
    }
}
