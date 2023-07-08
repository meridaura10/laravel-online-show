<div class="container">
    <h1>Список продуктів</h1>

    <div class="row mb-3">
        <div class="col-auto">
            <div class="input-group">
                <span class="input-group-text">Кількість на сторінці:</span>
                <select class="form-select" wire:model="limit">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="30">30</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
        </div>
        <div class="col-auto">
            <div class="input-group">
                <span class="input-group-text">Пошук:</span>
                <input type="text" class="form-control" wire:change="search" wire:model.debounce.500ms="search">
            </div>
        </div>

        <div class="col-auto">
            <div class="input-group">
                <span class="input-group-text">фільтрувати за категоріями:</span>
                <select class="form-select" multiple wire:model="selectedCategories">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>


    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="selectAll"
                             wire:model="isSelectAll"  wire:change="selectAll">
                        <label class="form-check-label" for="selectAll"></label>
                    </div>
                </th>
                <th wire:click="sort('id')" class="cursor-pointer">
                    ID
                    @if ($sortBy === 'id')
                        @if ($sortDirection === 'asc')
                            <i class="bi  bi-caret-up-fill"></i>
                        @else
                            <i class="bi  bi-caret-down-fill"></i>
                        @endif
                    @endif
                </th>
                <th wire:click="sort('name')" class="cursor-pointer">
                    Назва
                    @if ($sortBy === 'name')
                        @if ($sortDirection === 'asc')
                            <i class="bi bi-caret-up-fill"></i>
                        @else
                            <i class="bi bi-caret-down-fill"></i>
                        @endif
                    @endif
                </th>
                <th wire:click="sort('description')" class="cursor-pointer">
                    Опис
                    @if ($sortBy === 'description')
                        @if ($sortDirection === 'asc')
                            <i class="bi bi-caret-up-fill"></i>
                        @else
                            <i class="bi bi-caret-down-fill"></i>
                        @endif
                    @endif
                </th>
                <th wire:click="sort('price')" class="cursor-pointer">
                    Ціна
                    @if ($sortBy === 'price')
                        @if ($sortDirection === 'asc')
                            <i class="bi bi-caret-up-fill"></i>
                        @else
                            <i class="bi bi-caret-down-fill"></i>
                        @endif
                    @endif
                </th>
                <th wire:click="sort('created_at')" class="cursor-pointer">
                    Дата створення
                    @if ($sortBy === 'created_at')
                        @if ($sortDirection === 'asc')
                            <i class="bi bi-caret-up-fill"></i>
                        @else
                            <i class="bi bi-caret-down-fill"></i>
                        @endif
                    @endif
                </th>
                <th wire:click="sort('updated_at')" class="cursor-pointer">
                    Дата оновлення
                    @if ($sortBy === 'updated_at')
                        @if ($sortDirection === 'asc')
                            <i class="bi bi-caret-up-fill"></i>
                        @else
                            <i class="bi bi-caret-down-fill"></i>
                        @endif
                    @endif
                </th>
                <th>Картинка</th>
                <th>Дії</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" wire:model="selectedProducts"
                                   value="{{$product}}" id="product_{{ $product->id }}">
                            <label class="form-check-label" for="product_{{ $product->id }}"></label>
                        </div>
                    </td>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->translateOrDefault(app()->getLocale())->name}}</td>
                    <td>{{ $product->translateOrDefault(app()->getLocale())->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->created_at }}</td>
                    <td>{{ $product->updated_at }}</td>
                    <td>
                        <img src="{{ asset('storage/images/' . $product->image) }}" alt="Product Image"
                             class="img-fluid" style="width: 50px; height: 50px;">
                    </td>
                    <td>
                        <a href="{{route('admin.products.show',$product)}}"><button class="btn btn-outline-primary">show</button></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>
</div>

