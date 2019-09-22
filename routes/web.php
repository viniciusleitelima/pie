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
    return view('welcome');
});

Route::get('/teste', function (){
})->middleware('auth');
/* rotas de instituicao */
Route::get('/instituicoes','InstituicaoController@listar');

Route::get('/instituicao/cadastro','InstituicaoController@cadastro');
Route::post('/instituicao/salvar','InstituicaoController@salvar');

Route::get('/instituicao/editar/{id}','InstituicaoController@editar');
Route::post('/instituicao/update/{id}','InstituicaoController@update');

Route::get('/instituicao/apagar/{id}','InstituicaoController@apagar');
/* fim rotas instituicao*/

/* rotas curso */
Route::get('/cursos','CursoController@listar');

Route::get('/curso/cadastro','CursoController@cadastro');
Route::post('/curso/salvar','CursoController@salvar');

Route::get('/curso/editar/{id}','CursoController@editar');
Route::post('/curso/update/{id}','CursoController@update');

Route::get('/curso/apagar/{id}','CursoController@apagar');

/* fim rotas curso */

/* rotas aluno */
Route::get('/alunos','AlunoController@listar');

Route::get('/aluno/cadastro','AlunoController@cadastro');
Route::post('/aluno/salvar','AlunoController@salvar');

Route::get('/aluno/editar/{id}','AlunoController@editar');
Route::post('/aluno/update/{id}','AlunoController@update');

Route::get('/aluno/apagar/{id}','AlunoController@apagar');

/* fim rotas aluno */

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
