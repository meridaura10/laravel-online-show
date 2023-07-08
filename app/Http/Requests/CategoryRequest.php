<?php

namespace App\Http\Requests;


class CategoryRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [    
            'name'=>"required|string:max:25",
            'locale' => 'string'
        ];
    }
}
