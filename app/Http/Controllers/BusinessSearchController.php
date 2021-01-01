<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BusinessService;
use App\Http\Resources\BusinessCollection;

class BusinessSearchController extends Controller
{
    /**
     * Search business by name and description
     */
    public function __invoke(
        Request $request,
        BusinessService $service
    ): BusinessCollection {

        return $service->searchBusiness($request);
    }
}
