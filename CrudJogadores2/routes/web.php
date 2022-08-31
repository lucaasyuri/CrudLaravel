<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamsController;
use App\Http\Controllers\PlayersController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(); //rota pra login, troca de senha do usuario, etc...

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//rota apenas para quem estiver logado | grupo de rotas manuseado por um middleware | controle pra ver se o ususario ta logado ou não
//se o usuário tentar acessar essas rotas e não estiver logado, vai ser redirecionado para o 'login'
Route::middleware(['auth'])->group(function (){

    // Group-Teams
    Route::prefix('teams')->group(function (){

        Route::get('', [TeamsController::class, 'index'])->name('teams-index');
        //index

        Route::get('/create', [TeamsController::class, 'create'])->name('teams-create');
        //chamando tela de criação (create)

        Route::post('/store', [TeamsController::class, 'store'])->name('teams-store');
        //salvando dados do formulário

        Route::get('/{id}/edit', [TeamsController::class, 'edit'])->where('id', '[0-9]+')->name('teams-edit');
        //chamando tela de edição (edit)
        //where('o que quero validar', 'validação')
        //[0-9]: apenas números | +: números maiores que 9 como 15, 20, 25...

        Route::put('/{id}/update', [TeamsController::class, 'update'])->where('id', '[0-9]+')->name('teams-update');
        //put: rota de edição
        //where('o que quero validar', 'validação')
        //[0-9]: apenas números | +: números maiores que 9 como 15, 20, 25...
        //salvando alteração (edição dos dados)

        Route::delete('{id}', [TeamsController::class, 'destroy'])->where('id', '[0-9]+')->name('teams-destroy');
        //deletando registros
        //where('o que quero validar', 'validação')
        //[0-9]: apenas números | +: números maiores que 9 como 15, 20, 25...

    });

        // Group-Players
        Route::prefix('players')->group(function (){

            Route::get('', [PlayersController::class, 'index'])->name('players-index');
            //index
    
            Route::get('/create', [PlayersController::class, 'create'])->name('players-create');
            //chamando tela de criação (create)
    
            Route::post('/store', [PlayersController::class, 'store'])->name('players-store');
            //salvando dados do formulário
    
            Route::get('/{id}/edit', [PlayersController::class, 'edit'])->where('id', '[0-9]+')->name('players-edit');
            //chamando tela de edição (edit)
            //where('o que quero validar', 'validação')
            //[0-9]: apenas números | +: números maiores que 9 como 15, 20, 25...
    
            Route::put('/{id}/update', [PlayersController::class, 'update'])->where('id', '[0-9]+')->name('players-update');
            //put: rota de edição
            //where('o que quero validar', 'validação')
            //[0-9]: apenas números | +: números maiores que 9 como 15, 20, 25...
            //salvando alteração (edição dos dados)
    
            Route::delete('{id}', [PlayersController::class, 'destroy'])->where('id', '[0-9]+')->name('players-destroy');
            //deletando registros
            //where('o que quero validar', 'validação')
            //[0-9]: apenas números | +: números maiores que 9 como 15, 20, 25...
    
        });

});
