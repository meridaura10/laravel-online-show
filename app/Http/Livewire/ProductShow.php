<?php

namespace App\Http\Livewire;

use App\Models\OptionValue;
use Livewire\Component;

class ProductShow extends Component
{
    public $selectedOptions = [];
    public $product;
    public $options;


    public function mount()
    {
        $this->selectedOptions = [
            'розмір' => null,
            'колір' => null,
            'память' => null,
        ];

        $variations = $this->product->variations()->get();

        $app = $variations->flatMap(function ($variation) {
            return $variation->values;
        });
        $app = $app->unique('value');

        $options = $app->mapToGroups(function ($opt) {
            return [$opt->option->title => $opt];
        });

        $this->options = collect($options);
    }
    public function select($optionType, $optionId)
    {
        $this->selectedOptions[$optionType] = $optionId;
        $this->getVariantsToSelectOptions();
    }

    public function getVariantsToSelectOptions()
    {
  //      dd($this->selectedOptions);
        $variations = $this->product->variations()->get();
        $variations = $variations->filter(function ($variation) {
            foreach ($this->selectedOptions as $key => $selectedOption) {
               
                if (!$variation->values->contains('id', $selectedOption)) {
                    return false;
                }
            }
            return true;
        });
        $app = $variations->flatMap(function ($variation) {
            return $variation->values;
        });
        $app = $app->unique('value');

        $options = $app->mapToGroups(function ($opt) {
            return [$opt->option->title => $opt];
        });
        $this->options = collect($options);
    }

    public function render()
    {
        // dd($this->options);
        return view('livewire.product-show', [
            'options' => $this->options,
        ]);
    }
}