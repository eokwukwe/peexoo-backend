<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Services\BusinessService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BusinessActivationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(
        Business $business,
        BusinessService $service
    ): JsonResponse {
        return $service->toggleBusinessActivation($business);
    }
}
