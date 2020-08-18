<?php

namespace App\Support\Github;

class GithubRepositories extends GithubServices
{
    /**
     * The type of search service.
     * supported values: "users", "issues", "repositories"
     *
     * @return string
     */
    function getSearchType()
    {
        return 'repositories';
    }
}