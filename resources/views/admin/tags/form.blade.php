@extends('layouts.admin')

@section('title', $tag->exists ? 'Edit tag' : 'Add tag')

@section('content')
<div class="card">
    <h1>{{ $tag->exists ? 'Edit tag' : 'Add tag' }}</h1>

    <form method="POST" action="{{ $tag->exists ? route('admin.tags.update', $tag) : route('admin.tags.store') }}">
        @csrf
        @if ($tag->exists)
            @method('PUT')
        @endif

        <label for="name">Name</label>
        <input id="name" type="text" name="name" value="{{ old('name', $tag->name) }}" required maxlength="50">
        @error('name') <p class="error">{{ $message }}</p> @enderror

        <button class="btn" type="submit">Save</button>
        <a href="{{ route('admin.tags.index') }}">Cancel</a>
    </form>
</div>
@endsection