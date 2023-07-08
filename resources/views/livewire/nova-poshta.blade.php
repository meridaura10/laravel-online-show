<div class="container">
    <div class="my-4">
        <input wire:model="searchCity" wire:input="searchCity" type="text" class="form-control" placeholder="Пошук міста...">
        @if($searchCity)
            <ul class="list-group">
                @foreach($cities as $item)
                    <li class="list-group-item">
                        {{ $item->name }}
                        <button wire:click="selectCity('{{ $item->id }}')" class="btn btn-primary btn-sm">Вибрати</button>
                    </li>
                @endforeach
            </ul>
        @endif
       @if($selectedCity)
            <p  class="mt-3">Вибране місце: <span class="fw-bold fs-6">{{ $selectedCity->name }}</span></p>
       @endif
    </div>
    <div>
        <input @if(!$selectedCity) disabled @endif wire:model="searchWerehouse" wire:input="searchWerehouse" type="text" class="form-control" placeholder="Пошук пункту прийому...">
            <ul class="list-group mt-2 mb-4">
                @foreach($werehouses as $item)
                    <li class="list-group-item">
                        {{ $item->address }}
                        <button wire:click="selectWerehouse('{{ $item->id }}')" class="btn btn-primary btn-sm">Вибрати</button>
                    </li>
                @endforeach
            </ul>

        @if($selectedWerehouse)
            <p  class="mt-3">Вибраний пункт прийому: <span class="fw-bold fs-6">{{ $selectedWerehouse->address }}</span></p>
        @endif
    </div>
</div>
