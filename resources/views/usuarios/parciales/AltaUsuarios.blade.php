<form action="{{ route('AltaUsuarios') }}" method="POST" class="space-y-4" id="frm_usuarios">
    @csrf

    <div class="border border-gray-600 p-4 rounded-lg">
        <h3 class="text-lg font-semibold mb-2">Información Personal</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm mb-2">Nombre</label>
                <input type="text" name="user_nombre" class="w-full rounded p-2 text-black" required>
            </div>
            <div>
                <label class="block text-sm mb-2">Apellido Paterno</label>
                <input type="text" name="user_paterno" class="w-full rounded p-2 text-black" required>

            </div>
            <div>
                <label class="block text-sm mb-2">Apellido Materno</label>
                <input type="text" name="user_materno" class="w-full rounded p-2 text-black">
            </div>
        </div>
    </div>

    <div class="border border-gray-600 p-4 rounded-lg">
        <h3 class="text-lg font-semibold mb-2">Credenciales</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm mb-2">Nombre de Usuario</label>
                <input type="text" name="username" class="w-full rounded p-2 text-black" required>
            </div>
            <div>
                <label class="block text-sm mb-2">Correo Electrónico</label>
                <input type="email" name="email" class="w-full rounded p-2 text-black" required>
            </div>
            <div>
                <label class="block text-sm mb-2">Contraseña</label>
                <input type="password" name="password" class="w-full rounded p-2 text-black" required>
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
        <i class="fas fa-user-plus"></i> Crear Usuario
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
