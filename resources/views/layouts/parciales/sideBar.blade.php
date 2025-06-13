<aside class="w-64 bg-gray-900 border-r border-gray-700 min-h-screen p-4 hidden md:block">
    <div class="text-2xl font-bold text-purple-400 mb-6">📚 DocuControl</div>
    <nav>
        <ul class="space-y-2 text-gray-100">

            <li>
                <a href="{{ route('home') }}"
                   class="block px-4 py-2 rounded hover:bg-purple-600 {{ request()->is('dashboard') ? 'bg-purple-600' : '' }}">
                    🏠 Dashboard
                </a>
            </li>

            <li class="has-submenu">
                <a href="#" onclick="toggleSubMenu(event)"
                   class="flex justify-between items-center px-4 py-2 rounded hover:bg-purple-600 {{ Request::is('usuarios*') || Request::is('indexUsuarios*') ? 'bg-purple-600' : '' }}">
                    👥 Usuarios
                    <i class="fas fa-chevron-down text-sm transition-transform"></i>
                </a>
                <ul class="submenu ml-4 mt-1 hidden space-y-1">
                    <li>
                        <a href="{{ route('indexListarUsuarios') }}"
                           class="block px-3 py-1 rounded hover:bg-purple-600 {{ Request::is('indexListarUsuarios*') ? 'bg-purple-600' : '' }}">
                            📋 Listar Usuarios
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('indexAltaUsuarios') }}"
                           class="block px-3 py-1 rounded hover:bg-purple-600 {{ Request::is('indexAltaUsuarios*') ? 'bg-purple-600' : '' }}">
                            ➕ Alta Usuarios
                        </a>
                    </li>
                </ul>
            </li>

            <li class="has-submenu">
                <a href="#" onclick="toggleSubMenu(event)"
                   class="flex justify-between items-center px-4 py-2 rounded hover:bg-purple-600 {{ Request::is('documentos*') || Request::is('indexDocumentos*') ? 'bg-purple-600' : '' }}">
                    📄 Documentos
                    <i class="fas fa-chevron-down text-sm transition-transform"></i>
                </a>
                <ul class="submenu ml-4 mt-1 hidden space-y-1">
                    <li>
                        <a href="{{ route('indexListarDocumentos') }}"
                           class="block px-3 py-1 rounded hover:bg-purple-600 {{ Request::is('indexListarDocumentos*') ? 'bg-purple-600' : '' }}">
                            📋 Listar Documentos
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('indexAltaDocumentos') }}"
                           class="block px-3 py-1 rounded hover:bg-purple-600 {{ Request::is('indexAltaDocumentos*') ? 'bg-purple-600' : '' }}">
                            ➕ Alta Documentos
                        </a>
                    </li>
                </ul>
            </li>

            <li class="has-submenu">
                <a href="#" onclick="toggleSubMenu(event)"
                   class="flex justify-between items-center px-4 py-2 rounded hover:bg-purple-600 {{ Request::is('indexAltaSolicitud*') || Request::is('indexListarSolicitud*') ? 'bg-purple-600' : '' }}">
                    📝 Solicitudes
                    <i class="fas fa-chevron-down text-sm transition-transform"></i>
                </a>
                <ul class="submenu ml-4 mt-1 hidden space-y-1">
                    <li>
                        <a href="{{ route('indexListarSolicitud') }}"
                           class="block px-3 py-1 rounded hover:bg-purple-600 {{ Request::is('indexListarSolicitud*') ? 'bg-purple-600' : '' }}">
                            📋 Listar Solicitudes
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('indexAltaSolicitud') }}"
                           class="block px-3 py-1 rounded hover:bg-purple-600 {{ Request::is('indexAltaSolicitud*') ? 'bg-purple-600' : '' }}">
                            ➕ Alta Solicitud
                        </a>
                    </li>
                </ul>
            </li>

            <li class="has-submenu">
                <a href="#" onclick="toggleSubMenu(event)"
                   class="flex justify-between items-center px-4 py-2 rounded hover:bg-purple-600 {{ Request::is('indexListarEntrega*') ? 'bg-purple-600' : '' }}">
                    📦 Entregas
                    <i class="fas fa-chevron-down text-sm transition-transform"></i>
                </a>
                <ul class="submenu ml-4 mt-1 hidden space-y-1">
                    <li>
                        <a href="{{ route('indexListarEntrega') }}"
                           class="block px-3 py-1 rounded hover:bg-purple-600 {{ Request::is('indexListarEntrega*') ? 'bg-purple-600' : '' }}">
                            📋 Listar Entregas
                        </a>
                    </li>
                </ul>
            </li>

            
            
        </ul>
    </nav>
</aside>

<script>
    function toggleSubMenu(event) {
        event.preventDefault();
        const link = event.currentTarget;
        const submenu = link.nextElementSibling;

        if (submenu && submenu.classList.contains('submenu')) {
            submenu.classList.toggle('hidden');
            const icon = link.querySelector('i');
            if (icon) icon.classList.toggle('rotate-180');
        }
    }
</script>
