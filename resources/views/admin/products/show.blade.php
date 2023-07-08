@extends('layouts.app')

@section('content')
  <div class="container">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Деталі продукту</h1>
            </div>
            <div class="card-body">
                <h3>{{ $product->translateOrDefault(app()->getLocale())->name }}</h3>
                <p>{{ $product->translateOrDefault(app()->getLocale())->description }}</p>
                <p>Ціна: {{ $product->price }}</p>
                <p>Валюта: {{ $product->currency }}</p>
                <p>Категорії:</p>
                <ul>
                    @foreach ($product->categories as $category)
                        <li>{{ $category->translateOrDefault(app()->getLocale())->name }}</li>
                    @endforeach
                </ul>
                <p>Дата створення: {{ $product->created_at }}</p>
                <p>Дата оновлення: {{ $product->updated_at }}</p>

                @foreach ($product->images()->where('type', 'banner')->get() as $image)
                    <div class="h-100 w-100" style="max-height: 200px;">
                        <img class="rounded-top img-fluid" style="object-fit: contain;width: 100%;max-height: 200px; max-width: 300px" src="{{ asset('storage/images/' . $image->path) }}" alt="Product Image">
                    </div>
                @endforeach

                <div id="carouselExampleIndicators" class="carousel slide mt-4" data-bs-ride="carousel" style="max-width: 500px;">
                    <ol class="carousel-indicators">
                        @foreach ($product->images()->where('type', 'slider')->get() as $key => $image)
                            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $key }}" @if ($key === 0) class="active" @endif></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        
                        @foreach ($product->images()->where('type', 'slider')->get() as $key => $image)
                            <div class="carousel-item @if ($key === 0) active @endif">
                                <img src="{{ asset('storage/images/' . $image->path) }}" class="d-block w-100" alt="Product Image" style="max-height: 300px;">
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </a>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary">Редагувати</a>
                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Ви впевнені, що хочете видалити цей продукт?')">Видалити</button>
                </form>
            </div>
        </div>
    </div> 
@endsection

