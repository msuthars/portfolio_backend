@extends('layouts.admin')

@section('title', $guild->exists ? 'Edit guild' : 'Add guild')

@section('content')
<div class="card">
    <h1>{{ $guild->exists ? 'Edit guild' : 'Add guild' }}</h1>

    <form method="POST" action="{{ $guild->exists ? route('admin.guilds.update', $guild) : route('admin.guilds.store') }}">
        @csrf
        @if ($guild->exists)
            @method('PUT')
        @endif

        <label for="name">Name</label>
        <input id="name" type="text" name="name" value="{{ old('name', $guild->name) }}" required maxlength="50">
        @error('name') <p class="error">{{ $message }}</p> @enderror

        <label for="slug">Slug</label>
        <input id="slug" type="text" name="slug" value="{{ old('slug', $guild->slug) }}" required maxlength="50">
        <p class="hint">Example: bright-solution, banking-dms</p>
        @error('slug') <p class="error">{{ $message }}</p> @enderror

        <label for="period">Period</label>
        <input id="period" type="text" name="period" value="{{ old('period', $guild->period) }}" required maxlength="50">
        <p class="hint">Example: 2023-2024, 2024-2025</p>
        @error('period') <p class="error">{{ $message }}</p> @enderror

        <label for="weight">Weight</label>
        <input id="weight" type="number" name="weight" min="0" value="{{ old('weight', $guild->weight ?? 0) }}" required>
        <p class="hint">Guilds are sorted by weight in the quest list.</p>
        @error('weight') <p class="error">{{ $message }}</p> @enderror

        <button class="btn" type="submit">Save</button>
        <a href="{{ route('admin.guilds.index') }}">Cancel</a>
    </form>
</div>
@endsection
