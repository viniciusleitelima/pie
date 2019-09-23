<?php

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
    return view('auth/login');
});

Route::get('/teste', function (){
})->middleware('auth');
/* rotas de instituicao */
Route::get('/instituicoes','InstituicaoController@listar');

Route::get('/instituicao/cadastro','InstituicaoController@cadastro', function (){
})->middleware('auth');
Route::post('/instituicao/salvar','InstituicaoController@salvar', function (){
})->middleware('auth');

Route::get('/instituicao/editar/{id}','InstituicaoController@editar', function (){
})->middleware('auth');
Route::post('/instituicao/update/{id}','InstituicaoController@update', function (){
})->middleware('auth');

Route::get('/instituicao/ver_cursos/{id}','InstituicaoController@verCursos', function (){
})->middleware('auth');

Route::get('/instituicao/cadastrar_cursos/{id}','InstituicaoController@cadastrarCursos', function (){
})->middleware('auth');
Route::get('/instituicao/alterar_curso/{id}/{status}','InstituicaoController@alterarCurso', function (){
})->middleware('auth');

Route::get('/instituicao/alterar_status/{id}/{status}','InstituicaoController@alterarStatus', function (){
})->middleware('auth');

Route::post('/instituicao/salvarCurso/{id}', ["as" => 'selecionar.curso', 'uses' => "InstituicaoController@salvarCurso"], function (){
})->middleware('auth');


Route::get('/instituicao/apagar/{id}','InstituicaoController@apagar', function (){
})->middleware('auth');
/* fim rotas instituicao*/

/* rotas curso */
Route::get('/cursos','CursoController@listar', function (){
})->middleware('auth');

Route::get('/curso/cadastro','CursoController@cadastro', function (){
})->middleware('auth');
Route::post('/curso/salvar','CursoController@salvar', function (){
})->middleware('auth');

Route::get('/curso/editar/{id}','CursoController@editar', function (){
})->middleware('auth');
Route::post('/curso/update/{id}','CursoController@update', function (){
})->middleware('auth');

Route::get('/curso/apagar/{id}','CursoController@apagar', function (){
})->middleware('auth');

/* fim rotas curso */

/* rotas aluno */
Route::get('/alunos','AlunoController@listar', function (){
})->middleware('auth');

Route::get('/aluno/cadastro','AlunoController@cadastro', function (){
})->middleware('auth');
Route::post('/aluno/salvar','AlunoController@salvar', function (){
})->middleware('auth');

Route::get('/aluno/editar/{id}','AlunoController@editar', function (){
})->middleware('auth');
Route::post('/aluno/update/{id}','AlunoController@update', function (){
})->middleware('auth');


Route::get('/aluno/alterar_status/{id}/{status}','AlunoController@alterarStatus', function (){
})->middleware('auth');

Route::get('/aluno/apagar/{id}','AlunoController@apagar', function (){
})->middleware('auth');

/* fim rotas aluno */

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
