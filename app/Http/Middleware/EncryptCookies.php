<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

/**
 * Encrypts all cookies for the application. Extends Laravel's built‑in
 * EncryptCookies middleware which handles encryption and decryption of
 * cookies transparently.
 */
class EncryptCookies extends Middleware
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array<int, string>
     */
    protected $except = [
        // Add cookie names here to exclude them from encryption
    ];
}