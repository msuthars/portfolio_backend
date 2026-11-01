@extends('layouts.admin')

@section('title', 'Guilds')

@section('content')
<div class="page-head">
    <h1>Guilds</h1>
    <a class="btn" href="{{ route('admin.guilds.create') }}">+ Add guild</a>
</div>

<table>
    <thead>
        <tr><th>Name</th><th>Used in</th><th></th></tr>
    </thead>
    <tbody>
        @forelse ($guilds as $guild)
            <tr>
                <td>{{ $guild->name }}</td>
                <td>{{ $guild->quests_count }} quests</td>
                <td class="actions">
                    <a href="{{ route('admin.guilds.edit', $guild) }}">Edit</a>
                    <form method="POST" action="{{ route('admin.guilds.destroy', $guild) }}"
                          onsubmit="return confirm('Delete this guild?')">
                        @csrf
                        @method('DELETE')
                        <button class="link-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="3">No guilds yet.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection

