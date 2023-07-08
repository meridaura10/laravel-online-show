<div class="characteristic-wrap">
    <div class="characteristic-list">
        <ul>
            @foreach ($options as $key => $optionValues)
                {{ $key }}
                <div>
                    @foreach ($optionValues as $option)
                        <button wire:click="select('{{ $key }}', {{ $option['id'] }})"
                            class="btn btn-outline-primary {{ $selectedOptions[$key] == $option['id'] ? 'active' : '' }}">
                            {{ $option['value'] }}
                        </button>
                    @endforeach
                </div>
            @endforeach
        </ul>
    </div>
</div>
