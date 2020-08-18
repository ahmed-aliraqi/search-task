<?php

namespace App\Http\Controllers;

use App\Support\Github\GithubFactory;
use App\Http\Requests\SearchRequest;
use Illuminate\Support\Facades\Cache;
use App\Support\Response\JsonResponse;

class SearchController extends Controller
{
    /**
     * Handle searching from github service.
     *
     * @param \App\Http\Requests\SearchRequest $request
     * @throws \Exception
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(SearchRequest $request)
    {
        $service = GithubFactory::make($request->type);

        return $service
            ->search($request->text)
            ->response(new JsonResponse);
    }

    /**
     * Clear the search cache.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function clearCache()
    {
        Cache::flush();

        return response()->json([
            'message' => __('The cache has been cleared successfully'),
        ]);
    }
}
