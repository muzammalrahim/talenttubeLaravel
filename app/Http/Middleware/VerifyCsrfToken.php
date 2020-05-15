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
        'ajax/geo_states',
        'ajax/geo_cities',
        'ajax/changeUserStatusText',
        'ajax/update_about_field',
        'ajax/uploadUserGallery',
        'ajax/uploadVideo',
        'notifyPayment',
    ];
}
