<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AssignmentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('admin/login',[AuthController::class, 'login']);

Route::group(['middleware' => 'jwt.verify','prefix' => 'admin'], function() {
    
    Route::get('me',[AuthController::class, 'me']);
    Route::get('logout',[AuthController::class, 'logout']);
    
    /* 
    * EndPoint para: Cadastro de novo Usuário
    * {{url_base }}/usuarios/cadastrar
    */
    Route::post('usuarios/cadastrar',[UserController::class, 'store']);
    
    /* EndPoint para: Listar Tarefas
     * {{url_base }}/tarefas
     */
    Route::get('tarefas', [TaskController::class, 'index']);
    
    /* EndPoint para: Consultar dados de uma tarefa específica
     * {{url_base }}/tarefas/{id}
     */
    Route::get('tarefas/{id}', [TaskController::class, 'show']);
    
    /* EndPoint para: Remover uma tarefa
     * {{url_base }}/cliente/{id}
     */
    Route::delete('tarefas/deletar/{id}', [TaskController::class, 'destroy']);

    /* EndPoint para: Cadastro de nova Tarefa
     * {{url_base }}/tarefas/cadastrar
     */
    Route::post('tarefas/cadastrar', [TaskController::class, 'store']);
    
    /* EndPoint para: Edição de um cliente já existente
     * {{url_base }}/tarefas/editar/{id}
     */
    Route::put('tarefas/editar/{id}',[TaskController::class, 'update']);
    
    /* 
    * EndPoint para: Atribuir uma tarefa a um determinado usuário
    * {{url_base }}/atribuicoes/cadastrar
    */
    Route::post('atribuicoes/cadastrar',[AssignmentController::class, 'store']);
    
    /* EndPoint para: Listar Atribuições
     * {{url_base }}/atribuicoes/listar-atribuicoes/{cod_user}/{status_task}
     */
    Route::get('atribuicoes/listar-atribuicoes/{cod_user?}/{status_task?}', [AssignmentController::class, 'index']);
    
});
