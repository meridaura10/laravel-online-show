<div class="d-flex" style="width: 100%; max-width:1500px;margin: 0 auto;">
    <div class="w-20 p-4">
        <h4>Filter</h4>
        <form wire:submit.prevent="applyFilters">
            <div class="mb-3">
                <label for="minPrice">Min Price</label>
                <input wire:model.deffer="minPrice" id="minPrice" type="text" class="form-control" placeholder="Enter min price" />
            </div>
            <div class="mb-3">
                <label for="maxPrice">Max Price</label>
                <input wire:model="maxPrice" id="maxPrice" type="text" class="form-control" placeholder="Enter max price" />
            </div>
            <div class="mb-3">
                <label for="selectCategories">Select Categories</label>
                <select wire:model="selectedCategories" id="selectCategories" class="form-control" multiple>
                    <option wire:click='selectedCategoriesClear'>All Categories</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->translateOrDefault(app()->getLocale())->name }}</option>
                    @endforeach
                </select>
            </div>
            {{-- <button type="submit" class="btn btn-primary">Apply Filters</button> --}}
        </form>
    </div>
    <div class="album w-100 max-w-80 py-4 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach ($products as $product)
                    @include('products.product', ['product' => $product])
                @endforeach
            </div>
            <div class="d-flex p-3 mt-4 justify-content-center">
                {{-- {{ $products->links() }} --}}
            </div>
        </div>
    </div>
</div>
