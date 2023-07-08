@extends('layouts.app')

@section('content')
    <div class="container m-3 m">
        <form action="{{ route('admin.categories.store') }}" method="POST">
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
            <div class="mb-3">
                <label for="category-name" class="form-label">Назва категорії</label>
                <input type="text" class="form-control" id="category-name" name="name" placeholder="Введіть назву категорії">
            </div>
            <button type="submit" class="btn btn-primary">Створити категорію</button>
        </form>
    </div>
@endsection
