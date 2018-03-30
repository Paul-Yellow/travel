<?php

namespace App\Http\Controllers;
use App\Repositories\Response;
use App\Repositories\Parameters;
abstract class ApiController extends Controller
{
    protected $response;
    protected $parameters;
    public function __construct(Response $response, Parameters $parameters)
    {
        $this->response = $response;
        $this->parameters = $parameters;
    }
}
