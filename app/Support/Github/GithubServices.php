<?php

namespace App\Support\Github;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Support\Response\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

abstract class GithubServices
{
    /**
     * The base endpoint of github search api.
     *
     * @var string
     */
    protected $endPoint = 'https://api.github.com/search';

    /**
     * @var string|null
     */
    protected $searchText;

    /**
     * Determine whether the cache is enabled.
     *
     * @var bool
     */
    protected $cacheEnabled = true;

    /**
     * The type of search service.
     * supported values: "users", "issues", "repositories"
     *
     * @return string
     */
    abstract function getSearchType();

    /**
     * The url of search api.
     *
     * @return string
     */
    protected function url()
    {
        return trim($this->endPoint, '/').'/'.$this->getSearchType();
    }

    /**
     * Set the given search text.
     *
     * @param string $entry
     * @return $this
     */
    public function search($entry = '')
    {
        $this->searchText = $entry;

        return $this;
    }

    /**
     * Get fresh search results from github api.
     *
     * @return array
     */
    protected function getFreshResults()
    {
        $response = Http::get($this->url(), [
            'q' => $this->searchText,
        ]);

        if ($this->cacheEnabled) {
            $this->cacheResults($response->json());
        }

        return $response->json();
    }

    /**
     * Get the cached search results.
     *
     * @return array
     */
    protected function getCachedResults()
    {
        return Cache::get($this->getCacheKey(), []);
    }

    /**
     * Get the cached search results.
     *
     * @param $response
     * @return void
     */
    protected function cacheResults($response)
    {
        Cache::put(
            $this->getCacheKey(),
            $response,
            $this->getLifetime()
        );
    }

    /**
     * Get the cached search results.
     *
     * @return array
     */
    public function getResults()
    {
        if ($this->resultsWasCached()) {
            return $this->getCachedResults();
        }

        return $this->getFreshResults();
    }

    /**
     * Disable response caching.
     *
     * @return $this
     */
    public function withoutCaching()
    {
        $this->cacheEnabled = false;

        return $this;
    }

    /**
     * Determine whether the search response is cached.
     *
     * @return bool
     */
    public function resultsWasCached()
    {
        return $this->cacheEnabled && Cache::has($this->getCacheKey());
    }

    /**
     * The key name of the search cache.
     *
     * @return string
     */
    protected function getCacheKey()
    {
        $type = $this->getSearchType() ?: '';

        $search = Str::slug($this->searchText);

        return "github-{$type}-{$search}";
    }

    /**
     * The cache expiration time.
     *
     * @return \Carbon\Carbon
     */
    protected function getLifetime()
    {
        return Carbon::now()->addHours(2);
    }

    /**
     * Response the search results.
     *
     * @param \App\Support\Response\Response $response
     * @return \Illuminate\Http\JsonResponse
     */
    public function response(Response $response)
    {
        return $response->render($this->getResults());
    }
}