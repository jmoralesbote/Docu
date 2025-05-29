<header class="bg-purple-700 border-b border-purple-800 px-6 py-4 flex justify-between items-center text-white">
    <div class="text-lg font-semibold">@yield('title', 'Sección')</div>
    <div class="flex items-center gap-3">
        <span class="text-sm hidden sm:inline">👤 {{ Auth::user()->user_nombre ?? 'Invitado' }}</span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-white hover:text-gray-200 text-sm" type="submit">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>
</header>
