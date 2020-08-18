<?php

namespace App\Support\Response;

interface Response
{
    /**
     * Render the response data.
     *
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function render(array $data = []);
}