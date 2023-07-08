@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="card mb-3">
                    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
                        <!-- Слайди -->
                        <div class="carousel-inner">
                            @foreach ($product->images as $key => $image)
                                <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                    <img src="{{ $image->path }}" alt="Slide {{ $key + 1 }}">
                                </div>
                            @endforeach
                        </div>

                        <!-- Навігація -->
                        <ol class="carousel-indicators">
                            @foreach ($product->images as $key => $image)
                                <li data-bs-target="#myCarousel" data-bs-slide-to="{{ $key }}"
                                    class="{{ $key === 0 ? 'active' : '' }}"></li>
                            @endforeach
                        </ol>

                        <!-- Кнопки попереднього та наступного слайдів -->
                        <a class="carousel-control-prev" href="#myCarousel" role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#myCarousel" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </a>
                    </div>


                    <div class="card-body">
                        <h5 class="card-title">{{ $product->translateOrDefault(app()->getLocale())->name }}</h5>
                        <p class="card-text">{{ $product->translateOrDefault(app()->getLocale())->description }}</p>
                        <p class="card-text">@lang('views/products/show.price'): {{ $product->price }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">@lang('views/products/show.categories')</h5>
                        <ul class="list-unstyled mb-0">
                            @foreach ($product->categories as $category)
                                <li class="mb-1">
                                    <a href="{{ route('categories.show', $category->id) }}"
                                        class="text-decoration-none">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title">@lang('views/products/show.properties')</h5>
                        <ul class="list-unstyled mb-0">
                            @foreach ($product->properties as $property)
                                <li class="mb-1">
                                    <strong>{{ $property->title }}:</strong> {{ $property->pivot->value }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="characteristic-wrap">
                    <h2>Variations:</h2>
                    
                    <livewire:product-show :product="$product" />
                </div>




            </div>
        </div>
        <div class="mt-3">
            <form action="{{ route('basket.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product" value="{{ $product->id }}">
                <button type="submit" class="btn btn-primary btn-block">@lang('views/products/show.addToBasket')</button>
            </form>
        </div>
    </div>
@endsection
