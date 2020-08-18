<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class CacheResponse
{
    /**
     * Cache the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $key = $this->getCacheKey($request);

        if (Cache::has($key)) {
            return Cache::get($key);
        }

        $response = $next($request);

        if ($response->isSuccessful()) {
            Cache::put($key, $response, 60 * 60 * 60 * 2); // expired after 2 hours
        }

        return $response;
    }

    /**
     * Get the cache key name.
     *
     * @param $request
     * @return string
     */
    private function getCacheKey($request)
    {
        return 'url-'.Str::slug($request->fullUrl());
    }
}
