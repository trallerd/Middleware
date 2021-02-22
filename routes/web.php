<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home.index');
})->name("home");
Route::get('/restrito', function () {
    return view('restrito.index');
})->name("restrito");
Route::resource('curso', 'CursoController');
Route::resource('professor', 'ProfessorController');
Route::resource('disciplina', 'DisciplinaController');
Route::resource('aluno', 'AlunoController');

