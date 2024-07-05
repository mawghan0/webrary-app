<?php
// app/Http/Middleware/AuthenticateWithJson.php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthenticateWithJson extends Middleware
{
    protected function unauthenticated($request, array $guards)
    {
        throw new HttpResponseException(
            response()->json(['message' => 'Unauthorized'], 401)
        );
    }
}
