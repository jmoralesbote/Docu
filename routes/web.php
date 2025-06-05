<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\DocumentosController;
use App\Http\Controllers\TipoDocumentosController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
});
 */
Route::get('/', function () {
    // Si está autenticado, lo mandas a la vista 'inicio'
    if (Auth::check()) {
        return view('inicio'); // Tu dashboard personalizado
    }
    // Si NO está autenticado, lo mandas al login
    return redirect()->route('login');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/indexAltaUsuarios', [UsuariosController::class, 'indexAltaUsuarios'])->name('indexAltaUsuarios');
    Route::post('/AltaUsuarios', [UsuariosController::class, 'AltaUsuarios'])->name('AltaUsuarios');
    Route::get('/indexEditarUsuarios/{idusuario}', [UsuariosController::class, 'indexEditarUsuarios'])->name('indexEditarUsuarios');
    Route::post('/EditarUsuarios', [UsuariosController::class, 'EditarUsuarios'])->name('EditarUsuarios');
    Route::get('/indexListarUsuarios', [UsuariosController::class, 'indexListarUsuarios'])->name('indexListarUsuarios');
    
    //RUTAS DE CONTROL DE DOCUMENTOS
    Route::get('/indexAltaDocumentos', [DocumentosController::class, 'indexAltaDocumentos'])->name('indexAltaDocumentos');
    Route::post('/AltaDocumentos', [DocumentosController::class, 'AltaDocumentos'])->name('AltaDocumentos');
    Route::get('/indexEditarDocumentos/{id}', [DocumentosController::class, 'indexEditarDocumentos'])->name('indexEditarDocumentos');
    Route::post('/EditarDocumentos', [DocumentosController::class, 'EditarDocumentos'])->name('EditarDocumentos');
    Route::get('/indexListarDocumentos', [DocumentosController::class, 'indexListarDocumentos'])->name('indexListarDocumentos');
    Route::get('/indexDetalleDocumentos/{id}', [DocumentosController::class, 'indexDetalleDocumentos'])->name('indexDetalleDocumentos');

    Route::get('/catalogo-tipos-documento', [TipoDocumentosController::class, 'catalogoTiposDocumento'])->name('TipoDocumento');

    Route::get('/documentos/descargar/{id}', [DocumentosController::class, 'descargar'])->name('documentos.descargar');
});

require __DIR__.'/auth.php';

//RUTAS DE CONTROL DE USUARIOS