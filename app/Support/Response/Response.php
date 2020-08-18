<?php

namespace App\Support\Response;

interface Response
{
    /**
     * Response constructor.
     *
     * @param array $data
     */
    public function __construct(array $data = []);

    /**
     * Render the response data.
     *
     * @return mixed
     */
    public function render();
}