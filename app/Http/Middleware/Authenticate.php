<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\key;


class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param \closure(\ILLuminate\http\request); (\ILLuminate\http\Response)
     * @return \ILLuminate\Http\Response/\ILLuminate\Http\RedirectResponse
     *
     */
    public function handle(Request $request, Closure $next)
    {
        $jwt = $request->bearerToken();

        if ($jwt= 'null' || $jwt =''){
            return response()->json([
                'msg' => 'Akses ditolak, token todak memenuhi'
            ],401);
        } else {

            $jwtDecoded = JWT::decode($jwt, new key(env('JWT_SECRET_KEY'), 'HS256'));

            if($jwtDecoded->role = 'admin') {
                return $next(request);

            }
            return response()->json([
                'msg' => 'Akses ditolak, token tidak memenuhi'
            ]),401
        }
            
    }
}
