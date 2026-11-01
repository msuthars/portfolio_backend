@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="card">
    <h1>Welcome, {{ auth()->user()->name }}</h1>
    <p>Content pages (Quests, Tags, Guilds) will go here.</p>
</div>
@endsection
