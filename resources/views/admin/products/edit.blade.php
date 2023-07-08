@extends('layouts.app')

@section('content')
    <div class="container m-3">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Редагування продукта</div>
                    <div class="card-body">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>    
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                                    <div class="form-group">
                                        <label for="locale">Оберіть мову:</label>
                                        <select name="locale" class="form-control" id="locale">
                                            <option value="en">English</option>
                                            <option value="uk">ukraine</option>
                                            <option value="pl">polsk</option>
                                        </select>
                                    </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Назва продукта</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Назва продукта" value="{{ $product->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Ціна</label>
                                <input type="number" step="0.01" name="price" class="form-control" id="price" placeholder="Ціна" value="{{ $product->price }}">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Опис</label>
                                <textarea name="description" class="form-control" id="description" placeholder="Опис">{{ $product->description }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Зображення</label>
                                <input type="file" name="image" class="form-control" id="image">
                                <img src="{{ asset('storage/images/' . $product->image) }}" alt="Product Image" class="img-thumbnail mt-2" style="max-width: 200px">
                            </div>
                            <div class="form-group">
                                @foreach ($categories as $category)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="categories[]" id="category_{{ $category->id }}" value="{{ $category->id }}" {{ in_array($category->id, $product->categories->pluck('id')->toArray()) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="category_{{ $category->id }}">{{ $category->translateOrDefault(app()->getLocale())->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <button  type="submit" class="btn mt-2 btn-primary">Оновити</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
