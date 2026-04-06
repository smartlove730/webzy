<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Authentication Routes…
// Only enable login, logout, password reset routes. Disable registration for security.
Auth::routes(['register' => false]);