<?php

namespace Illuminate\Support\Facades;

/**
 * Backwards-compatible Input facade for legacy code.
 *
 * Laravel removed the dedicated Input facade in favor of Request. This class
 * keeps older controllers and Blade partials working while delegating all
 * calls to the current request instance.
 */
class Input extends Request
{
    // Intentionally empty.
}
