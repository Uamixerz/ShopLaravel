<?php

namespace App\Http\Controllers\HomeLabel;
use App\Http\Controllers\Controller;
use App\Services\HomeLabel\Service;

class BaseController extends Controller
{
    public $service;
    public function __construct(Service $serviceGet)
    {
        $this->service = $serviceGet;
    }
}
