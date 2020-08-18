<?php

namespace App\Support\Github;

class GithubUsers extends GithubServices
{
    /**
     * The type of search service.
     * supported values: "users", "issues", "repositories"
     *
     * @return string
     */
    function getSearchType()
    {
        return 'users';
    }
}