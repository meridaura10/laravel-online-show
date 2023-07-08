<div class="col">
    <div class="card shadow-sm">
        <div class="h-100 w-100" style="max-height: 200px;">
            {{-- <img class="rounded-top img-fluid" style="object-fit: cover;width: 100%;max-height: 200px" src="{{  $product->bannerImage->path }}" alt="Product Image"> --}}
        </div>
        <div class="card-body">
            <div>
                <p class="card-text">@lang('views/products/product.name') {{$product->translateOrDefault(app()->getLocale())->name}}</p>
            </div>
            <p class="card-text">@lang('views/products/product.description'): {{$product->translateOrDefault(app()->getLocale())->description}}</p>
            <p class="card-text">@lang('views/products/product.price'): {{$product->price}}</p>
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group d-flex gap-1">
                    <a href="{{route('products.show', compact('product'))}}">
                        <button type="button" class="btn  btn-sm btn-outline-secondary">@lang('views/products/product.view')</button>
                    </a>
                </div>
                <small class="text-muted">{{$product->created_at}}</small>
            </div>
        </div>
    </div>
</div>
