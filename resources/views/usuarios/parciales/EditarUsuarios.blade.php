<form action="{{ route('EditarUsuarios') }}" method="POST" class="space-y-4" id="frm_usuarios">
    @csrf
    <input type="hidden" name="idusuario" id="idusuario" value="{{ $usuarios->id }}">
    <div class="border border-gray-600 p-4 rounded-lg">
        <h3 class="text-lg font-semibold mb-2">Información Personal</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="user_nombre" class="block text-sm mb-2">Nombre</label>
                <input type="text" name="user_nombre" id="user_nombre" class="w-full rounded p-2 text-black"
                    value="{{ $usuarios->user_nombre }}" required>
            </div>
            <div>
                <label for="user_paterno" class="block text-sm mb-2">Apellido Paterno</label>
                <input type="text" name="user_paterno" id="user_paterno" class="w-full rounded p-2 text-black"
                    value="{{ $usuarios->user_paterno}}" required>
            </div>
            <div>
                <label for="user_materno" class="block text-sm mb-2">Apellido Materno</label>
                <input type="text" name="user_materno" id="user_materno" class="w-full rounded p-2 text-black"
                value="{{ $usuarios->user_materno}}">
            </div>
        </div>
    </div>

    <div class="border border-gray-600 p-4 rounded-lg">
        <h3 class="text-lg font-semibold mb-2">Credenciales</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="username" class="block text-sm mb-2">Nombre de Usuario</label>
                <input type="text" name="username" id="username" class="w-full rounded p-2 text-black" 
                value="{{ $usuarios->username}}" required>
            </div>
            <div>
                <label for="email" class="block text-sm mb-2">Correo Electrónico</label>
                <input type="email" name="email" id="email" class="w-full rounded p-2 text-black"
                value="{{ $usuarios->email}}" required>
            </div>
            <div>
                <label for="password" class="block text-sm mb-2">Contraseña</label>
                <input type="password" name="password" id="password" class="w-full rounded p-2 text-black" required>
            </div>
        </div>
    </div>

    <div class="flex justify-end space-x-4 mt-6">
        <button
            type="button"
            id="btn-cancelar"
            class="flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-5 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 ease-in-out"
        >
            <i class="fas fa-times-circle"></i> Cancelar
        </button>

        <button
            type="button"
            id="btn-guardar"
            class="flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-5 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 ease-in-out"
        >
            <i class="fas fa-user-plus"></i> Actualizar Usuario
        </button>
    </div>
</form>

<div id="spinner-global" style="display: none;"
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="sk-chase">
        <div class="sk-chase-dot"></div>
        <div class="sk-chase-dot"></div>
        <div class="sk-chase-dot"></div>
        <div class="sk-chase-dot"></div>
        <div class="sk-chase-dot"></div>
        <div class="sk-chase-dot"></div>
    </div>
</div>
