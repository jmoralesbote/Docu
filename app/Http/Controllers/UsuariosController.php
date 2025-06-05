<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class UsuariosController extends Controller
{
    public function indexAltaUsuarios(){
        return view('Usuarios.indexAltaUsuarios');
    }

    public function AltaUsuarios(Request $request){
        // Validaciones de backend
        $request->validate([
            'user_nombre'   => 'required|string|max:100|regex:/^[A-Za-zÁÉÍÓÚÑáéíóúñ\s]+$/',
            'user_paterno'  => 'required|string|max:50|regex:/^[A-Za-zÁÉÍÓÚÑáéíóúñ\s]+$/',
            'user_materno'  => 'nullable|string|max:50|regex:/^[A-Za-zÁÉÍÓÚÑáéíóúñ\s]+$/',
            'username'      => 'required|string|max:15|alpha_num|unique:users,username',
            'email'         => 'required|string|email|max:100|unique:users,email',
            'password'      => [
                'required',
                'string',
                'min:6',
                'max:50',
                'regex:/[A-Z]/', // al menos una mayúscula
                'regex:/[a-z]/', // al menos una minúscula
                'regex:/\d/',    // al menos un número
            ],
        ], [
            'user_nombre.regex'  => 'El nombre solo puede contener letras y espacios.',
            'user_paterno.regex' => 'El apellido paterno solo puede contener letras y espacios.',
            'user_materno.regex' => 'El apellido materno solo puede contener letras y espacios.',
            'username.alpha_num' => 'El nombre de usuario solo puede contener letras y números.',
            'password.regex'     => 'La contraseña debe contener al menos una mayúscula, una minúscula y un número.',
        ]);

        try {
            $data = new User;
            $data->username = $request->username;
            $data->user_nombre = $request->user_nombre;
            $data->user_paterno = $request->user_paterno;
            $data->user_materno = $request->user_materno;
            $data->email = $request->email;
            $data->password = bcrypt($request->password);

            $data->save();

            return response()->json(['message' => 'Usuario registrado exitosamente.'], 200);
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Ocurrió un error inesperado al guardar los datos.',
            ], 500);
        }
    }

    public function indexEditarUsuarios($idusuario){
        $usuarios = User::findOrFail($idusuario);
        return view('Usuarios.indexEditarUsuarios')->with(compact('usuarios'));
    }

    public function EditarUsuarios(Request $request){
        // Validaciones de backend
        $request->validate([
            'user_nombre'   => 'required|string|max:100|regex:/^[A-Za-zÁÉÍÓÚÑáéíóúñ\s]+$/',
            'user_paterno'  => 'required|string|max:50|regex:/^[A-Za-zÁÉÍÓÚÑáéíóúñ\s]+$/',
            'user_materno'  => 'nullable|string|max:50|regex:/^[A-Za-zÁÉÍÓÚÑáéíóúñ\s]+$/',
            'username'      => 'required|string|max:15|alpha_num|unique:users,username,' . $request->idusuario,
            'email'         => 'required|string|email|max:100|unique:users,email,' . $request->idusuario,
            'password'      => [
                'nullable',
                'string',
                'min:6',
                'max:50',
                'regex:/[A-Z]/', // al menos una mayúscula
                'regex:/[a-z]/', // al menos una minúscula
                'regex:/\d/',    // al menos un número
            ],
        ], [
            'user_nombre.regex'  => 'El nombre solo puede contener letras y espacios.',
            'user_paterno.regex' => 'El apellido paterno solo puede contener letras y espacios.',
            'user_materno.regex' => 'El apellido materno solo puede contener letras y espacios.',
            'username.alpha_num' => 'El nombre de usuario solo puede contener letras y números.',
            'password.regex'     => 'La contraseña debe contener al menos una mayúscula, una minúscula y un número.',
        ]);

        try{
            $idusuario = $request->input('idusuario');
            $usuario = User::findOrFail($idusuario);

            $usuario->username = $request->input('username');
            $usuario->user_nombre = $request->input('user_nombre');
            $usuario->user_paterno = $request->input('user_paterno');
            $usuario->user_materno = $request->input('user_materno');
            $usuario->email = $request->input('email');
            if ($request->filled('password')) {
                $usuario->password = Hash::make($request->password);
            }

            $usuario->save();

            return response()->json(['message' => 'Usuario actualizado exitosamente.'], 200);

        }catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Ocurrió un error inesperado al guardar los datos.',
            ], 500);
        }
    }

    public function indexListarUsuarios(){
        return view('Usuarios.indexListarUsuarios');
    }
}

