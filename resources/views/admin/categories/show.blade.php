@extends('layouts.app')

@section('content')
<div class="text-center fs-2">
    детально про категорію: {{ $category->translateOrDefault(app()->getLocale())->name}}
</div>
<div class="category-details">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Мова</th>
                    <th scope="col">Назва</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($category->translations as $item)
                    <tr>
                        <td>{{ $item->locale }}</td>
                        <td>{{ $category->translateOrDefault($item->locale)->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



    <div class="products-list">
        <h3 class="section-title">Продукти</h3>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Зображення</th>
                        <th scope="col">Назва</th>
                        <th scope="col">Ціна</th>
                        <th scope="col">Опис</th>
                        <th scope="col">Дії</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category->products as $product)
                        <tr>
                            <td>
                                <img class="rounded-top img-fluid" style="max-height: auto; width: 120px;"
                                    src="{{ asset('storage/images/' . $product->bannerImage->path) }}" alt="Product Image">
                            </td>
                            <td>{{ $product->translateOrDefault(app()->getLocale())->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->translateOrDefault(app()->getLocale())->description }}</td>
                            <td>
                                <a href="{{ route('admin.products.show', $product) }}" class="btn btn-primary">Деталі</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    
    </div>
@endsection
