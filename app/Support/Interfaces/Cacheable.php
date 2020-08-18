<?php

namespace App\Support\Interfaces;

interface Cacheable
{
    /**
     * @param string $key
     * @param mixed $value
     * @return mixed
     */
    public function set(string $key, $value);

    /**
     * @param string $key
     * @return mixed
     */
    public function forget(string $key);
}