<?php

namespace App\Support;

use Illuminate\Support\Facades\DB;

class Settings
{
    public function getMany($keys)
    {
        $output = [];

        foreach ($keys as $type => $key) {
            $output[$key] = $this->get($key);
        }

        return $output;
    }
    /**
     * Get value for the provided key
     *
     * @param string $key
     * @return value or null
     */
    public function get($key)
    {
        $found = $this->db()
            ->where('key', $key)
            ->first();

        return optional($found)->value;
    }

    /**
     * Get new database instance
     *
     * @return DB
     */
    protected function db()
    {
        return DB::table('settings');
    }

    public function setMany($array)
    {
        foreach ($array as $key => $value) {
            $this->db()->where('key', $key)->update(['value' => $value]);
        }
    }
    /**
     * Update the value of key with null
     *
     * @param string $key
     * @return boolean
     */
    public function forget($key)
    {
        return $this->set($key, null);
    }

    /**
     * Update the value of the provided key
     *
     * @param string $key
     * @param string $value
     * @return boolean
     */
    public function set($key, $value)
    {
        return $this->db()->where('key', $key)->update(['value' => $value]);
    }
}
