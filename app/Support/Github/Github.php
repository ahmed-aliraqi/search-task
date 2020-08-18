<?php

namespace App\Support\Github;

class Github
{
    /**
     * @param $type
     * @throws \Exception
     * @return \App\Support\Github\GithubService
     */
    public static function make($type)
    {
        if (! in_array($type, array_keys(config('search.types-mapping')))) {
            throw new \Exception("The type \"{$type}\" is not support");
        }

        $service = config('search.types-mapping.'.$type);

        return new $service;
    }
}