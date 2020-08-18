# Github Search Api Task

### Task Description
> Write an "Search" Backend API endpoint which eventually collect the data from Github & stores it in REDIS.
 >
 > Create two API Endpoints:
 >
 > "/api/search"
 > Receives a POST request with search type(users or repositories or issues) & search text(mandatory).
 > The results will be fetched from the GitHub API & cache it for atleast 2 hours.
 > GitHub Search API Docs
 > "/api/clear-cache" : Clear Backend Caching

### Design Patterns
> Three design patterns were used in this task:
- Template Method
- Strategy
- Factory

### Usage
> You can use search service and cache results from controller:

```php
use App\Support\Response\JsonResponse;

$github = GithubFactory::make('users');

return $github
    ->search('ahmed-aliraqi')
    ->response(new JsonResponse);
```
> By default the search results will be cached, if you want to disable response caching you should use `withoutCaching()` method:

```php
use App\Support\Response\JsonResponse;

$github = GithubFactory::make('users');

return $github
    ->search('ahmed-aliraqi')
    ->withoutCaching()
    ->response(new JsonResponse);
```
> The `GithubServices` support 3 types `users`, `repositories` and `issues`.
> The type instances was mapped in the `search` config file:
```php
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
``` 
> You can specified the `lifetime` of the cache in specific service by overriding `getLifetime()` method. By default the `lifetime` value is 2 hours.
```php
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

    /**
     * The cache expiration time.
     *
     * @return \Carbon\Carbon
     */
    protected function getLifetime()
    {
        return now()->addDay();
    }
}
```

