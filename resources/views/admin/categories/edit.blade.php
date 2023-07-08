@extends('layouts.app')

@section('content')
<form action="{{ route('admin.categories.update', $category) }}" method="POST">
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
        <label for="name" class="form-label">Назва</label>
        <input type="text" name="name" class="form-control" id="name" value="{{ $category->translateOrDefault(app()->getLocale())->name }}">
    </div>

    <button type="submit" class="btn btn-primary">Оновити</button>
</form>
@endsection