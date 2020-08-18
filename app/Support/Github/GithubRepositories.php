<?php

namespace App\Support\Github;

use Illuminate\Support\Facades\Http;

class GithubRepositories implements GithubService
{
    /**
     * @param string $text
     * @return array
     */
    public function search($text = '')
    {
        $response = Http::get('https://api.github.com/search/repositories?q='.$text);

        return $response->json();
    }
}