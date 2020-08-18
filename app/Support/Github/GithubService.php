<?php

namespace App\Support\Github;

interface GithubService
{
    /**
     * @param string $text
     * @return array
     */
    public function search($text = '');
}