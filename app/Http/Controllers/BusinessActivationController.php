<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Services\BusinessService;
use Illuminate\Http\JsonResponse;

class BusinessActivationController extends Controller
{
    /**
     * Activate or deactivate a business listing.
     */
    public function __invoke(
        Business $business,
        BusinessService $service
    ): JsonResponse {
        return $service->toggleBusinessActivation($business);
    }
}
