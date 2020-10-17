<?php

namespace App\Http\Middleware;

use Closure;
use DevDr\ApiCrudGenerator\Controllers\BaseApiController;

class CheckAuth extends BaseApiController
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
        $users = $request->get('users');
        $token_explode = explode('_', $users->auth_token);
        $token_timeout = $token_explode[1] + config('app.token_timeout');
        $current_time = time();
        if($current_time > $token_timeout){
            $this->_sendErrorResponse(401,'Your session has timed out');
        }
        return $next($request);
    }
}
