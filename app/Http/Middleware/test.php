<?php

namespace App\Http\Middleware;

class test

    public function handle($request, Closure $next, $guard = null)
    {
        var_dump($request);exit;

        return null;
    }
}
