<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') — Portfolio</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    @auth
          <nav class="admin-nav">
              <a href="{{ route('admin.dashboard') }}">Dashboard</a>
              <a href="{{ route('admin.quests.index') }}">Quests</a>
              <a href="{{ route('admin.guilds.index') }}">Guilds</a>
              <a href="{{ route('admin.tags.index') }}">Tags</a>
              <form method="POST" action="{{ route('admin.logout') }}" class="push-right">
                  @csrf
                  <button type="submit">Log out ({{ auth()->user()->name }})</button>
              </form>
          </nav>
      @endauth

      <main class="admin-main">
          @if (session('status'))
              <div class="flash">{{ session('status') }}</div>
          @endif
          @if (session('error'))
              <div class="flash flash-error">{{ session('error') }}</div>
          @endif

          @yield('content')
      </main>
</body>
</html>
