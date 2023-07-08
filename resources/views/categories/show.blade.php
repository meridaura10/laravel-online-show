@extends('layouts.app')

@section('content')
    <div class="m-2">
        <div class="container">
           <div class="p-2">
               @lang('views/categories/show.productsOfThisCategory'): <span class="fs-5 fw-bold">{{$category->translateOrDefault(app()->getLocale())->name}}</span>
           </div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach ($products as $product)
                    @include('products.product',['product'=>$product])
                @endforeach
            </div>
            <div class="d-flex p-3 mt-4 justify-content-center">
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection
