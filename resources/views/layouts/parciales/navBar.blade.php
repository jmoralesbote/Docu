<header class="bg-purple-700 border-b border-purple-800 px-6 py-4 flex justify-between items-center text-white">
    <!-- Botón hamburguesa solo en móvil -->
    <button id="btn-sidebar-toggle" class="md:hidden mr-3 focus:outline-none">
        <i class="fas fa-bars fa-lg"></i>
    </button>

    <div class="flex-1 flex items-center justify-end gap-3">
        <span class="text-sm flex items-center gap-1">
            👤 {{ Auth::user()->user_nombre ?? 'Invitado' }}
        </span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-white hover:text-gray-200 text-sm" type="submit">
                <i class="fas fa-sign-out-alt"></i> Salir
            </button>
        </form>
    </div>
</header>
