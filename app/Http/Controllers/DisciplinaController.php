<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Disciplina;
use \App\Curso;
use \App\Professor;

class DisciplinaController extends Controller
{
    public function index()
    {
        $professor = Professor::all();
        $cursos = Curso::with(['disciplina'])->get();
        $disciplinas = Disciplina::with(['professor','curso'])->get();
        return view('disciplina.index', compact(['disciplinas','cursos','professor']));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {

        $curso = Curso::find($request->input('curso_id'));
        $professor = Curso::find($request->input('professor_id'));

        if (isset($curso) && isset($professor)) {
            $d = new Disciplina();
            $d->nome = $request->nome;
            $d->professor()->associate($professor);
            $d->curso()->associate($curso);
            $d->save();
            return json_encode($d);
        }

        return response('Curso e/ou Professor não encontrado', 404);

        
    }

    public function show($id)
    {

        $disciplinas = Disciplina::find($id);
        if (isset($disciplinas)) {
            return json_encode($disciplinas);
        }

        return response('Disciplina não encontrado', 404);
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {

        $disciplina = Disciplina::find($id);
        $curso = Curso::find($request->input('curso_id'));
        $professor = Curso::find($request->input('professor_id'));


        if (isset($disciplina)) {
            $disciplina->nome = $request->nome;
            $disciplina->professor()->associate($professor);
            $disciplina->curso()->associate($curso);
            $disciplina->save();
            return json_encode($disciplina);
        }

        return response('Diciplina não encontrado', 404);
    }

    public function destroy($id)
    {

        $disciplina = Disciplina::find($id);
        if (isset($disciplina)) {
            $disciplina->delete();
            return response('OK', 200);
        }
        return response('Disciplina não encontrado', 404);
    }


}
