<aside class="w-64 bg-gray-900 border-r-2 border-purple-800 min-h-screen p-4 overflow-y-auto scrollbar-thin scrollbar-thumb-purple-700 scrollbar-track-gray-800">
    <div class="text-2xl font-bold text-purple-400 mb-8 tracking-wide flex items-center gap-2">
        <span>📚</span> DocuControl
    </div>
    <nav>
        <ul class="space-y-2 text-gray-100">

            <li class="mb-2">
                <a href="{{ route('home') }}"
                   class="flex items-center gap-2 px-4 py-2 rounded-lg transition-all duration-200 hover:bg-purple-700 hover:text-white {{ request()->is('dashboard') ? 'bg-purple-700 text-white font-semibold' : '' }}">
                    <i class="fas fa-home w-5"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="mb-2">
                <div class="text-xs uppercase text-purple-400 font-bold px-4 mb-1 mt-4 tracking-wider">Gestión</div>
            </li>

            <li x-data="{ open: false }" class="has-submenu">
                <a href="#" @click.prevent="open = !open"
                   class="flex justify-between items-center px-4 py-2 rounded-lg hover:bg-purple-700 transition-all duration-200 {{ Request::is('usuarios*') || Request::is('indexUsuarios*') ? 'bg-purple-700 text-white font-semibold' : '' }}">
                    <span class="flex items-center gap-2">
                        <i class="fas fa-users w-5"></i> Usuarios
                    </span>
                    <i :class="{'rotate-180': open}" class="fas fa-chevron-down text-sm transition-transform duration-300"></i>
                </a>
                <ul x-show="open"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 -translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 -translate-y-2"
                    x-cloak
                    class="submenu ml-4 mt-1 space-y-1 border-l-4 border-purple-700 bg-gray-800/90 shadow-inner">
                    <li>
                        <a href="{{ route('indexListarUsuarios') }}"
                           class="flex items-center gap-2 px-3 py-1 rounded hover:bg-purple-600 transition-all duration-200 {{ Request::is('indexListarUsuarios*') ? 'bg-purple-600 text-white font-semibold' : '' }}">
                            <i class="fas fa-list w-4"></i> Listar Usuarios
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('indexAltaUsuarios') }}"
                           class="flex items-center gap-2 px-3 py-1 rounded hover:bg-purple-600 transition-all duration-200 {{ Request::is('indexAltaUsuarios*') ? 'bg-purple-600 text-white font-semibold' : '' }}">
                            <i class="fas fa-user-plus w-4"></i> Alta Usuarios
                        </a>
                    </li>
                </ul>
            </li>

            <li x-data="{ open: false }" class="has-submenu">
                <a href="#" @click.prevent="open = !open"
                   class="flex justify-between items-center px-4 py-2 rounded-lg hover:bg-purple-700 transition-all duration-200 {{ Request::is('documentos*') || Request::is('indexDocumentos*') ? 'bg-purple-700 text-white font-semibold' : '' }}">
                    <span class="flex items-center gap-2">
                        <i class="fas fa-file-alt w-5"></i> Documentos
                    </span>
                    <i :class="{'rotate-180': open}" class="fas fa-chevron-down text-sm transition-transform duration-300"></i>
                </a>
                <ul x-show="open"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 -translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 -translate-y-2"
                    x-cloak
                    class="submenu ml-4 mt-1 space-y-1 border-l-4 border-purple-700 bg-gray-800/90 shadow-inner">
                    <li>
                        <a href="{{ route('indexListarDocumentos') }}"
                           class="flex items-center gap-2 px-3 py-1 rounded hover:bg-purple-600 transition-all duration-200 {{ Request::is('indexListarDocumentos*') ? 'bg-purple-600 text-white font-semibold' : '' }}">
                            <i class="fas fa-list w-4"></i> Listar Documentos
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('indexAltaDocumentos') }}"
                           class="flex items-center gap-2 px-3 py-1 rounded hover:bg-purple-600 transition-all duration-200 {{ Request::is('indexAltaDocumentos*') ? 'bg-purple-600 text-white font-semibold' : '' }}">
                            <i class="fas fa-plus w-4"></i> Alta Documentos
                        </a>
                    </li>
                </ul>
            </li>

            <li x-data="{ open: false }" class="has-submenu">
                <a href="#" @click.prevent="open = !open"
                   class="flex justify-between items-center px-4 py-2 rounded-lg hover:bg-purple-700 transition-all duration-200 {{ Request::is('indexAltaSolicitud*') || Request::is('indexListarSolicitud*') ? 'bg-purple-700 text-white font-semibold' : '' }}">
                    <span class="flex items-center gap-2">
                        <i class="fas fa-file-signature w-5"></i> Solicitudes
                    </span>
                    <i :class="{'rotate-180': open}" class="fas fa-chevron-down text-sm transition-transform duration-300"></i>
                </a>
                <ul x-show="open"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 -translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 -translate-y-2"
                    x-cloak
                    class="submenu ml-4 mt-1 space-y-1 border-l-4 border-purple-700 bg-gray-800/90 shadow-inner">
                    <li>
                        <a href="{{ route('indexListarSolicitud') }}"
                           class="flex items-center gap-2 px-3 py-1 rounded hover:bg-purple-600 transition-all duration-200 {{ Request::is('indexListarSolicitud*') ? 'bg-purple-600 text-white font-semibold' : '' }}">
                            <i class="fas fa-list w-4"></i> Listar Solicitudes
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('indexAltaSolicitud') }}"
                           class="flex items-center gap-2 px-3 py-1 rounded hover:bg-purple-600 transition-all duration-200 {{ Request::is('indexAltaSolicitud*') ? 'bg-purple-600 text-white font-semibold' : '' }}">
                            <i class="fas fa-plus w-4"></i> Alta Solicitud
                        </a>
                    </li>
                </ul>
            </li>

            <li x-data="{ open: false }" class="has-submenu">
                <a href="#" @click.prevent="open = !open"
                   class="flex justify-between items-center px-4 py-2 rounded-lg hover:bg-purple-700 transition-all duration-200 {{ Request::is('indexListarEntrega*') ? 'bg-purple-700 text-white font-semibold' : '' }}">
                    <span class="flex items-center gap-2">
                        <i class="fas fa-box-open w-5"></i> Entregas
                    </span>
                    <i :class="{'rotate-180': open}" class="fas fa-chevron-down text-sm transition-transform duration-300"></i>
                </a>
                <ul x-show="open"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 -translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 -translate-y-2"
                    x-cloak
                    class="submenu ml-4 mt-1 space-y-1 border-l-4 border-purple-700 bg-gray-800/90 shadow-inner">
                    <li>
                        <a href="{{ route('indexListarEntrega') }}"
                           class="flex items-center gap-2 px-3 py-1 rounded hover:bg-purple-600 transition-all duration-200 {{ Request::is('indexListarEntrega*') ? 'bg-purple-600 text-white font-semibold' : '' }}">
                            <i class="fas fa-list w-4"></i> Listar Entregas
                        </a>
                    </li>
                </ul>
            </li>

            
            
        </ul>
    </nav>
</aside>