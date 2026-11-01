@extends('layouts.admin')

@section('title', $quest->exists ? 'Edit quest' : 'Add quest')

@section('content')
<div class="card">
    <h1>{{ $quest->exists ? 'Edit quest' : 'Add quest' }}</h1>

    <form method="POST" action="{{ $quest->exists ? route('admin.quests.update', $quest) : route('admin.quests.store') }}">
        @csrf
        @if ($quest->exists)
            @method('PUT')
        @endif

        <label for="title">Title</label>
        <input id="title" type="text" name="title" value="{{ old('title', $quest->title) }}" required>
        @error('title') <p class="error">{{ $message }}</p> @enderror

        <label for="slug">Slug</label>
        <input id="slug" type="text" name="slug" value="{{ old('slug', $quest->slug) }}" required>
        <p class="hint">Used as the quest id in React, e.g. banking-dms</p>
        @error('slug') <p class="error">{{ $message }}</p> @enderror

        <label for="guild_id">Guild</label>
        <select id="guild_id" name="guild_id" required>
            <option value="">— Choose —</option>
            @foreach ($guilds as $guild)
                <option value="{{ $guild->id }}" @selected(old('guild_id', $quest->guild_id) == $guild->id)>{{ $guild->name }}</option>
            @endforeach
        </select>
        @error('guild_id') <p class="error">{{ $message }}</p> @enderror

        <label for="type">Type</label>
        <select id="type" name="type" required>
            @foreach ($types as $type)
                <option @selected(old('type', $quest->type) === $type)>{{ $type }}</option>
            @endforeach
        </select>
        @error('type') <p class="error">{{ $message }}</p> @enderror

        <label for="summary">Summary</label>
        <textarea id="summary" name="summary" required>{{ old('summary', $quest->summary) }}</textarea>
        @error('summary') <p class="error">{{ $message }}</p> @enderror

        <label for="mission">Mission</label>
        <textarea id="mission" name="mission" required>{{ old('mission', $quest->mission) }}</textarea>
        @error('mission') <p class="error">{{ $message }}</p> @enderror

        <label for="systems">Systems</label>
        <textarea id="systems" name="systems">{{ old('systems', implode("\n", $quest->systems ?? [])) }}</textarea>
        <p class="hint">One per line.</p>
        @error('systems') <p class="error">{{ $message }}</p> @enderror

        <label for="tags">Tags</label>
        <input id="tags" type="text" name="tags" value="{{ old('tags', $quest->tags->pluck('name')->implode(', ')) }}">
        <p class="hint">Comma-separated, in display order. New tags are created automatically.</p>
        @error('tags') <p class="error">{{ $message }}</p> @enderror

        <label for="reward">Reward (XP)</label>
        <input id="reward" type="number" name="reward" min="0" value="{{ old('reward', $quest->reward ?? 0) }}" required>
        @error('reward') <p class="error">{{ $message }}</p> @enderror

        <label for="weight">Weight</label>
        <input id="weight" type="number" name="weight" min="0" value="{{ old('weight', $quest->weight ?? 0) }}" required>
        <p class="hint">Lower numbers are listed first.</p>
        @error('weight') <p class="error">{{ $message }}</p> @enderror

        <label><input type="checkbox" name="active" value="1" @checked(old('active', $quest->active))> Currently active quest</label>

        <button class="btn" type="submit">Save</button>
        <a href="{{ route('admin.quests.index') }}">Cancel</a>
    </form>
</div>
@endsection
