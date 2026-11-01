@extends('layouts.admin')

@section('title', 'Quests')

@section('content')
<div class="page-head">
    <h1>Quests</h1>
    <a class="btn" href="{{ route('admin.quests.create') }}">+ Add quest</a>
</div>

<table>
    <thead>
        <tr><th>Title</th><th>Guild</th><th>Type</th><th>Tags</th><th>XP</th><th></th></tr>
    </thead>
    <tbody>
        @forelse ($quests as $quest)
            <tr>
                <td>{{ $quest->title }} @if ($quest->active) <strong>● active</strong> @endif</td>
                <td>{{ $quest->guild->name }}</td>
                <td>{{ $quest->type }}</td>
                <td>{{ $quest->tags->pluck('name')->implode(', ') }}</td>
                <td>{{ $quest->reward }}</td>
                <td class="actions">
                    <a href="{{ route('admin.quests.edit', $quest) }}">Edit</a>
                    <form method="POST" action="{{ route('admin.quests.destroy', $quest) }}"
                          onsubmit="return confirm('Delete this quest?')">
                        @csrf
                        @method('DELETE')
                        <button class="link-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6">No quests yet. <a href="{{ route('admin.guilds.create') }}">Add a guild</a> first.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
