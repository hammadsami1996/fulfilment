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
