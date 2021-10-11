<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});
*/

use App\Http\Controllers\EventController;


/*
*
* --- rotas CRUD events ---
*
*/

/* --- rota principal --- */
Route::get('/', [EventController::class, 'index']);
/* --- rota para pagina de criacao do evento --- */
Route::get('/events/create', [EventController::class, 'create'])->middleware('auth');
/* --- rota para exibir evento --- */
Route::get('/events/{id}', [EventController::class, 'show']);
/* --- rota para salvar evento --- */
Route::post('/events', [EventController::class, 'store']);
/* --- rota para deletar evento --- */
Route::delete('/events/{id}', [EventController::class, 'destroy'])->middleware('auth');
/* --- rota para pagina de edicao do evento --- */
Route::get('/events/edit/{id}', [EventController::class, 'edit'])->middleware('auth');
/* --- rota para editar evento --- */
Route::put('/events/update/{id}', [EventController::class, 'update'])->middleware('auth');


/*
*
* --- rotas de autenticação
*
*/

/* --- rota de autenticação do login --- */
Route::get('/dashboard', [EventController::class, 'dashboard'])->middleware('auth');

/*
*
* --- rotas de inscrição 
*
*/

/* --- rota de inscricao no evento --- */
Route::post('/events/join/{id}', [EventController::class, 'joinEvent'])->middleware('auth');
/* --- rota de desinscricao no evento --- */
Route::delete('/events/leave/{id}', [EventController::class, 'leaveEvent'])->middleware('auth');
