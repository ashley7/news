<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    protected $except = [
        'news.index',
        'news.show',
        'news.store',
        'news.edit',
        'home',
        '/number_of_articals',
    ];
}
