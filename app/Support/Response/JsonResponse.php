<?php

namespace App\Support\Response;

class JsonResponse implements Response
{
    /**
     * Render the response data.
     *
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function render(array $data = [])
    {
        return response()->json($data);
    }
}