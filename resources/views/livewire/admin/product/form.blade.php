<div class="container">
    <ul class="nav nav-tabs" id="languageTabs" role="tablist">
        @foreach ($langs as $key => $lang)
            <li class="nav-item " role="presentation">
                <button wire:click='changeTab("{{ $key }}")'
                    class="nav-link {{ $activeTab === $key ? 'active' : '' }} " id="{{ $key }}-tab"
                    data-bs-toggle="tab" data-bs-target="#{{ $key }}" type="button" role="tab"
                    aria-controls="{{ $key }}"
                    wire:loading.attr="disabled"
                    aria-selected="{{ $activeTab === $key ? 'true' : 'false' }}">{{ $key }}</button>
            </li>
        @endforeach
    </ul>
    <form wire:submit.prevent="updateOrCreate">

        <div class="tab-content mb-3" id="languageTabsContent">
            @foreach ($langs as $key => $lang)
                <div  class="tab-pane fade {{ $activeTab === $key ? 'show active' : '' }} " id="{{ $key }}"
                    role="tabpanel" aria-labelledby="{{ $key }}-tab">
                    <input  type="text" class="form-control" placeholder="Name ({{ $key }})"
                        wire:model="multilangsData.{{ $key }}.name">
                    @error('multilangsData.' . $key . '.name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <input type="text" class="form-control" placeholder="Description ({{ $key }})"
                        wire:model="multilangsData.{{ $key }}.description">
                    @error('multilangsData.' . $key . '.description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            @endforeach
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Ціна</label>
            <input type="float" wire:model="price" class="form-control" id="price">
            @error('price')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="selectedCategories" class="form-label">Категорії</label>
            <select wire:model="selectedCategories" class="form-control" id="selectedCategories" multiple>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->translateOrDefault(app()->getLocale())->name }}
                    </option>
                @endforeach
            </select>
            @error('selectedCategories')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="images" class="form-label">Зображення</label>
            <input type="file" wire:model="images" class="form-control" id="images" multiple>
            @error('images')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div>
            @if ($images)
                <ul wire:sortable="reorder" class="w-100 list-group list-group-horizontal flex-wrap">
                    @foreach ($images as $photo)
                        <li  class="list-group-item" wire:sortable.item='{{ $photo->getClientOriginalName() }}'
                            key='{{ $photo->getClientOriginalName() }}' class="p-2">
                            <div style="width: 220px; height: 120px; overflow: hidden;">
                                <img style="object-fit: contain; width: 100%; height: 100%"
                                    id="{{ $photo->getClientOriginalName() }}" src="{{ $photo->temporaryUrl() }}"
                                    alt="{{ $photo->getClientOriginalName() }}">
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
        <div class="mb-3">
            <label for="bannerImage" class="form-label">Банерна картинка</label>
            <input type="file" wire:model="bannerImage" class="form-control" id="bannerImage">
            @error('bannerImage')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit">Submit</button>
    </form>
</div>




{{-- <div>
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link{{ $activeTab === 'en' ? ' active' : '' }}" id="en-tab"
                    wire:click="changeTab('en')" data-bs-toggle="tab" data-bs-target="#en" type="button" role="tab"
                    aria-controls="en" aria-selected="false">EN</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link{{ $activeTab === 'uk' ? ' active' : '' }}" wire:click="changeTab('uk')"
                    id="uk-tab" data-bs-toggle="tab" data-bs-target="#uk" type="button" role="tab"
                    aria-controls="uk" aria-selected="true">UK</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link{{ $activeTab === 'pl' ? ' active' : '' }}" wire:click="changeTab('pl')"
                    id="pl-tab" data-bs-toggle="tab" data-bs-target="#pl" type="button" role="tab"
                    aria-controls="pl" aria-selected="false">PL</button>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <form wire:submit.prevent="updateOrCreate" enctype="multipart/form-data">
                @csrf

                @foreach ($langs as $lang)
                    <fieldset class="tab-pane fade{{ $activeTab === $lang ? ' show active' : '' }} {{$activeTab !== $lang ? 'hidden-tab-lang' : ''}}" id="{{ $lang }}"
                        role="tabpanel" aria-labelledby="{{ $lang }}-tab">

                        <div class="mb-3">
                            <label for="data.{{ $lang }}.name" class="form-label">Назва
                                ({{ $lang }})</label>
                            <input type="text" wire:model="data.{{ $lang }}.name" class="form-control"
                                id="data.{{ $lang }}.name">
                            @error("data.{$lang}.name")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="data.{{ $lang }}.description" class="form-label">Опис
                                ({{ $lang }})</label>
                            <textarea wire:model="data.{{ $lang }}.description" class="form-control"
                                id="data.{{ $lang }}.description"></textarea>
                            @error("data.{$lang}.description")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </fieldset>
                @endforeach
                <div>
                    @if ($images)
                        <ul wire:sortable="reorder" class="w-100 list-group list-group-horizontal flex-wrap">
                            @foreach ($images as $language => $photos)
                                <li class="list-group-item" wire:sortable.item='{{ $photo->getClientOriginalName() }}'
                                    key='{{ $photo->getClientOriginalName() }}' class="p-2">
                                    @foreach ($photos as $photo)
                                        <div style="width: 220px; height: 120px; overflow: hidden;">
                                            <img style="object-fit: contain; width: 100%; height: 100%"
                                                id="{{ $photo->getClientOriginalName() }}"
                                                src="{{ $photo->temporaryUrl() }}"
                                                alt="{{ $photo->getClientOriginalName() }}">
                                        </div>
                                    @endforeach
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
    
                <div class="mb-3">
                    <label for="bannerImage" class="form-label">Банерна картинка</label>
                    <input type="file" wire:model="bannerImage" class="form-control" id="bannerImage">
                    @error('bannerImage')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Створити</button>
            </form>
        </div>
    </div>
</div>
<style>
    .hidden-tab-lang{
        width: 0px;
        height: 0px;
        overflow: hidden;
    }
</style> --}}
{{-- <div>
    <div class="container">
        <form wire:submit.prevent="updateOrCreate" enctype="multipart/form-data">
            @csrf

            <ul class="nav nav-tabs">
                @foreach ($data as $language)
                    <li class="nav-item">
                        <a class="nav-link{{ $activeTab === $language ? ' active' : '' }}"
                            wire:click="changeTab('{{ $language }}')" href="#">{{ $language }}</a>
                    </li>
                @endforeach
            </ul>

            @foreach ($data as $language)
                <div wire:key="{{ $language }}" class="tab-content{{ $activeTab === $language ? ' active' : '' }}">
                    <div class="mb-3">
                        <label for="name_{{ $language }}" class="form-label">Назва ({{ $language }})</label>
                        <input type="text" wire:model="data.{{ $language }}.name" class="form-control"
                            id="name_{{ $language }}">
                        @error("data.{$language}.name")
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="price_{{ $language }}" class="form-label">Ціна</label>
                        <input type="number" wire:model="price" class="form-control" id="price_{{ $language }}">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description_{{ $language }}" class="form-label">Опис ({{ $language }})</label>
                        <textarea wire:model="data.{{ $language }}.description" class="form-control"
                            id="description_{{ $language }}"></textarea>
                        @error("data.{$language}.description")
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="selectedCategories_{{ $language }}"
                            class="form-label">Категорії ({{ $language }})</label>
                        <select wire:model="selectedCategories" class="form-control"
                            id="selectedCategories_{{ $language }}" multiple>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('selectedCategories')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="images_{{ $language }}" class="form-label">Зображення ({{ $language }})</label>
                        <input type="file" wire:model="images" class="form-control" id="images_{{ $language }}"
                            multiple>
                        @error('images')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            @endforeach

            <div>
                @if ($images)
                    <ul wire:sortable="reorder" class="w-100 list-group list-group-horizontal flex-wrap">
                        @foreach ($images as $language => $photos)
                            <li class="list-group-item" wire:sortable.item='{{ $photo->getClientOriginalName() }}'
                                key='{{ $photo->getClientOriginalName() }}' class="p-2">
                                @foreach ($photos as $photo)
                                    <div style="width: 220px; height: 120px; overflow: hidden;">
                                        <img style="object-fit: contain; width: 100%; height: 100%"
                                            id="{{ $photo->getClientOriginalName() }}"
                                            src="{{ $photo->temporaryUrl() }}"
                                            alt="{{ $photo->getClientOriginalName() }}">
                                    </div>
                                @endforeach
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <div class="mb-3">
                <label for="bannerImage" class="form-label">Банерна картинка</label>
                <input type="file" wire:model="bannerImage" class="form-control" id="bannerImage">
                @error('bannerImage')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Створити</button>
        </form>
    </div>
</div> --}}
