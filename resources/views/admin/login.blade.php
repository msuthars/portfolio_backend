@extends('layouts.admin')

@section('title', 'Log in')

@section('content')
<div class="card">
    <h1>Log in</h1>

    <form method="POST" action="{{ route('admin.login') }}">
        @csrf

        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
        @error('email') <p class="error">{{ $message }}</p> @enderror

        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>

        <label><input type="checkbox" name="remember"> Remember me</label>

        <button class="btn" type="submit">Log in</button>
    </form>
</div>
@endsection
