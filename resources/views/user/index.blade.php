@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Профіль користувача</h1>
    <p>Ім'я: {{ $user->name }}</p>
    <p>Email: {{ $user->email }}</p>
    <!-- Додаткові дані користувача -->
</div>
@endsection
