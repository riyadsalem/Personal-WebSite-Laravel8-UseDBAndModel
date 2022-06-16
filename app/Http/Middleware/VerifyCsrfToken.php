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
        // هدول مثال على الروابط الي ما بدي يشملهم شرط ال csrf وهلروابط هم عشوائيات
    //    'https://etharshrouf.com/responseCredit',//just this link
     //   'https://etharshrouf.com/responseCredit/*',//this link and parameters. 
       ];
}
