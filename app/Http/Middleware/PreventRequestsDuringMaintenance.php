<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware;

/**
 * Middleware that controls access to the application when it is in
 * maintenance mode. This stub relies on the parent class to handle
 * responses during maintenance periods.
 */
class PreventRequestsDuringMaintenance extends Middleware
{
    /**
     * The URIs that should be reachable while in maintenance mode.
     *
     * @var array<int, string>
     */
    protected $except = [];
}