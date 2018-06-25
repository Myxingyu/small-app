<?php

namespace App\Http\Middleware\extra;

use App\Http\service\Token;
use Closure;

class CheckExclusiveScope
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     * @throws \App\Exceptions\ForbiddenException
     * @throws \App\Exceptions\TokenException
     */
    public function handle($request, Closure $next)
    {
        Token::needExclusiveScope();
        return $next($request);
    }
}
