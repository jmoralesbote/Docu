<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsuariosController extends Controller
{
    
    public function indexAltaUsuarios(){
        
        return view('Usuarios.indexAltaUsuarios');
    }

    public function AltaUsuarios(Request $request){
        
        $username = $request->input('username');
        $correo = $request->input('email');

        try {
            if (User::where('username', $username)->exists()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'El nombre de usuario ya está registrado.',
                ], 400); // Devuelve 400 para errores de validación
            }

            if (User::where('email', $correo)->exists()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'El correo electrónico ya está registrado.',
                ], 400); // Devuelve 400 para errores de validación
            }

        $data = new User;

        $data->username = $request->username;
        $data->user_nombre = $request->user_nombre;
        $data->user_paterno = $request->user_paterno;
        $data->user_materno = $request->user_materno;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);

        $data->save();        

        /* $role = Role::find($request->id_role);
        if ($role) {
            $data->assignRole($role->name);
        } */

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
        /* dd($usuarios); */
        return view('Usuarios.indexEditarUsuarios')->with(compact('usuarios'));
    }

    public function EditarUsuarios(Request $data){
        try{
            $idusuario = $data->input('idusuario');
            $usuario = User::findOrFail($idusuario);
    
            $usuario->username = $data->input('username');
            $usuario->user_nombre = $data->input('user_nombre');
            $usuario->user_paterno = $data->input('user_paterno');
            $usuario->user_materno = $data->input('user_materno');
            $usuario->email = $data->input('email');
            if ($data->filled('password')) {
                $usuario->password = Hash::make($data->password);
            }

            $usuario->save();
        
            return response()->json(['message' => 'Usuario actualizado exitosamente.'], 200);

        }catch (QueryException $e) {
            // Manejo de errores de la base de datos
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

