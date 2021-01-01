<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Services\BusinessService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\BusinessRequest;
use App\Http\Resources\BusinessResource;
use App\Http\Resources\BusinessCollection;

class BusinessController extends Controller
{
    private $businessService;

    public function __construct(BusinessService $service)
    {
        $this->businessService = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): BusinessCollection
    {
        return $this->businessService->fetchBusinesses();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BusinessRequest $request): BusinessResource
    {
        return $this->businessService->addBusiness($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Business $business): BusinessResource
    {
        return $this->businessService->fetchBusiness($business);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        BusinessRequest $request,
        Business $business
    ): BusinessResource {

        return $this->businessService->updateBusiness($request, $business);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Business $business): JsonResponse
    {
        return $this->businessService->deleteBusiness($business);
    }
}
