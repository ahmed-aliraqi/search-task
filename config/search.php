<?php

return [
    /*
    | Mapping the github search types.
    | Should be implements "GithubService" interface.
    |
    */
    'types-mapping' => [
        'users' => App\Support\Github\GithubUsers::class,
        'issues' => App\Support\Github\GithubIssues::class,
        'repositories' => App\Support\Github\GithubRepositories::class,
    ],
];