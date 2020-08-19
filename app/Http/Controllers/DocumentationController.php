<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentationController extends Controller
{
    /**
     * Get documentation link.
     *
     * @return array
     */
    public function index()
    {
        $openapi = require base_path('openapi/documentation.php');

        return $openapi->toArray();
    }

}
