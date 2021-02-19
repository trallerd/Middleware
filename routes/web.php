<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home.index');
});
Route::resource('curso', 'CursoController');
Route::resource('professor', 'ProfessorController');
Route::resource('disciplina', 'DisciplinaController');
Route::resource('aluno', 'AlunoController');
Route::resource('matricula/', 'MatriculaController');
