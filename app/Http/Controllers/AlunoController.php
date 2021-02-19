<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Aluno;
use \App\Curso;
use \App\Disciplina;

class AlunoController extends Controller
{
    public function index()
    {
        $cursos = Curso::with(['disciplina'])->get();
        $alunos = Aluno::with(['disciplina','curso'])->get();
        return view('aluno.index',compact(['alunos','cursos']));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {

        $curso = Curso::find($request->curso_id);
        if(isset($curso)){
            $aluno = new Aluno();
            $aluno->nome = $request->nome;
            $aluno->email = $request->nome;
            $aluno->curso()->associate($curso);
            $aluno->save();
            return json_encode($aluno);
        }

        return response('Curso não encontrado', 404);
    }

    public function show($id)
    {

        $aluno = Aluno::find($id);
        if (isset($aluno)) {
            return json_encode($aluno);
        }

        return response('Aluno não encontrado', 404);
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
        $aluno = Aluno::find($id);
        $curso = Curso::find($request->curso_id);
        if(isset($aluno)){
            $aluno->nome = $request->nome;
            $aluno->email = $request->nome;
            $aluno->curso()->associate($curso);
            $aluno->save();
            return json_encode($aluno);
        }

        return response('Aluno não encontrado', 404);
    }

    public function destroy($id)
    {

        $aluno = Aluno::find($id);
        if (isset($aluno)) {
            $aluno->delete();
            return response('OK', 200);
        }
        return response('Aluno não encontrado', 404);
    }


}
