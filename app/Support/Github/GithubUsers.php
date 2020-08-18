<?php

namespace App\Support\Github;

use Illuminate\Support\Facades\Http;

class GithubUsers implements GithubService
{
    /**
     * @param string $text
     * @return array
     */
    public function search($text = '')
    {
        $response = Http::get('https://api.github.com/search/users?q='.$text);

        return $response->json();
    }
}