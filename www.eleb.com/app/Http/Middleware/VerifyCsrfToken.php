<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        'api/regist',
        '/api/loginCheck',
        '/api/add_address',
        '/api/edit_address',
        '/api/add_cart',
        '/api/add_order',
        '/api/changePassword',
        '/api/forgetPassword',
    ];
}
