<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class AccessLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $nivel = 0;
        //$nivel = 1;
        //$nivel = 2;

        $rota = $request->route()->getName();
        Log::debug($rota);


        if ($nivel == 0) {
            if ($rota == "curso.index"||$rota == "professor.index"||$rota == "disciplina.index"||$rota == "aluno.index") {
                return redirect('restrito');
            }
        }
        elseif ($nivel == 1) {
            if ($rota == "curso.index" || $rota == "disciplina.index") {
                return redirect('restrito');
            }
        }
        return $next($request);
    }
}
