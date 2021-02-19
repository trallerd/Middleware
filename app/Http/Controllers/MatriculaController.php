<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Matricula;
use \App\Aluno;
use \App\Disciplina;

class MatriculaController extends Controller
{
    public function index(Request $request)
    {
        $aluno = Aluno::with('curso','disciplina')->where('id', $request->aluno_id)->get()->first();
        $disciplinas = Disciplina::where('curso_id',$aluno->curso_id)->get();
        $matricula = Matricula::with(['aluno', 'disciplina'])->get();
        return view('matricula.index', compact(['matricula','aluno','disciplinas']));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {

        $aluno = Aluno::find($request->aluno_id);
        $disciplina = Disciplina::find($request->disciplina_id);

        if (isset($aluno) && isset($disciplina)) {
            $matricula = new Matricula();
            $matricula->aluno()->associate($aluno);
            $matricula->disciplina()->associate($disciplina);
            $matricula->save();


            return json_encode($matricula);
        }

        return response('Disciplina não encontrado', 404);
    }

    public function show($id)
    {

        $matricula = Matricula::find($id);
        if (isset($matricula)) {
            return json_encode($matricula);
        }

        return response('Matricula não encontrado', 404);
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {

        $matricula = Matricula::find($id);
        $aluno = Aluno::find($request->aluno_id);
        $disciplina = Disciplina::find($request->disciplina_id);
        $flag = $aluno->disciplina->find($disciplina->id);

        if (isset($aluno) && isset($disciplina) && isset($flag)){
            $matricula->aluno()->associate($aluno);
            $matricula->disciplina()->associate($disciplina);
            $matricula->save();


            return json_encode($matricula);
        
        }

        return response('Matricula não encontrado', 404);
    }

    public function destroy($id)
    {

        $matricula = Matricula::find($id);
        if (isset($matricula)) {
            $matricula->delete();
            return response('OK', 200);
        }
        return response('Matricula não encontrado', 404);
    }

   
}