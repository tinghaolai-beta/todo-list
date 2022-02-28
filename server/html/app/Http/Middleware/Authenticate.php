<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return string|void|null
     * @throws \Exception
     */
    protected function redirectTo($request)
    {
        if (Auth::guard('web')->guest()) {
            throw new \Exception('not login');
        }
    }
}
