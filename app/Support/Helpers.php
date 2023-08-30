<?php

use Illuminate\Models\DB;

if (!function_exists('counter')) {
    /**
     * Counter class helper
     *
     * @return App\Models\Counter
     */
    function counter()
    {
        return new App\Models\Counter;
    }
}

// app/Helpers/settings.php

if (!function_exists('Settings')) {
    function Settings()
    {
        return new \App\Support\Settings(); // Adjust the namespace according to your settings class
    }
}


if (!function_exists('api')) {
    /**
     * Json response for API
     *
     * @param array $response
     * @param integer $code
     * @return App\Support\Counter
     */
    function api($response, $code = 200)
    {
        return response()->json($response, $code);
    }
}
