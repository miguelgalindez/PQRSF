<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    protected $auth;

    public function __construct(Guard $auth){
        $this->auth=$auth;
    }

    public function handle($request, Closure $next)
    {
        $rolUsuario=$this->auth->user()->rol;
        if($rolUsuario == "Administrador"){
            return $next($request);    
        }
        else{
            $request->session()->flush();
            // responder con una vista que entregue la opcion de probar con otro usuario (Si le da clic a ese boton hacer un return redirect()->guest('https://accounts.google.com/logout')) y la opcion de salir del area administrativa pero dejando la sesion de Google iniciada
            return response('Forbidden.', 403);
        }
        
    }
}
