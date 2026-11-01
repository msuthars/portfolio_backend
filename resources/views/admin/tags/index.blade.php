@extends('layouts.admin')

@section('title', 'Tags')

@section('content')
<div class="page-head">
    <h1>Tags</h1>
    <a class="btn" href="{{ route('admin.tags.create') }}">+ Add tag</a>
</div>

<table>
    <thead>
        <tr><th>Name</th><th>Used in</th><th></th></tr>
    </thead>
    <tbody>
        @forelse ($tags as $tag)
            <tr>
                <td>{{ $tag->name }}</td>
                <td>{{ $tag->quests_count }} quests</td>
                <td class="actions">
                    <a href="{{ route('admin.tags.edit', $tag) }}">Edit</a>
                    <form method="POST" action="{{ route('admin.tags.destroy', $tag) }}"
                          onsubmit="return confirm('Delete this tag?')">
                        @csrf
                        @method('DELETE')
                        <button class="link-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="3">No tags yet.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
