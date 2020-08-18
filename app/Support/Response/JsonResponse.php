<?php

namespace App\Support\Response;

class JsonResponse implements Response
{
    /**
     * @var array
     */
    private $response;

    /**
     * JsonResponse constructor.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->response = $data;
    }

    public function __invoke()
    {
        $this->render();
    }

    /**
     * Render the response data.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function render()
    {
        return response()->json($this->response);
    }
}